<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\AnalogSeo;
use Fresh\Medpravda\Classification;
use Fresh\Medpravda\Fabricator;
use Fresh\Medpravda\FaqSeo;
use Fresh\Medpravda\Form;
use Fresh\Medpravda\Image as Slider;
use Fresh\Medpravda\Innname;
use Fresh\Medpravda\Medicine;
use Fresh\Medpravda\MedicineTitle;
use Fresh\Medpravda\Pharmagroup;
use Fresh\Medpravda\Substance;
use Fresh\Medpravda\Umedicine;
use Cache;
use Image;
use Config;
use Validator;
use File;
use DB;

class MedicineRepository extends Repository
{
    protected $inname;
    protected $form;
    protected $classification;
    protected $pharmagroup;
    protected $fabricator;
    protected $substance;

    public function __construct(
        Medicine $medicine,
        Innname $innname,
        Form $form,
        Classification $classification,
        Pharmagroup $pharmagroup,
        Fabricator $fabricator,
        Substance $substance
    )
    {
        $this->model = $medicine;
        $this->inname = $innname;
        $this->form = $form;
        $this->classification = $classification;
        $this->pharmagroup = $pharmagroup;
        $this->fabricator = $fabricator;
        $this->substance = $substance;
    }

    /**
     * @param $request
     */
    public function createMedicine($request)
    {
        $input = $request->except('_token', 'slider');

        // SEO handle
        if (!empty($input['seo_title'] || !empty($input['seo_keywords']) || !empty($input['seo_description']) || !empty($input['seo_text'])
            || !empty($input['og_image']) || !empty($input['og_title']) || !empty($input['og_description']))) {
            $obj = new \stdClass;
            $obj->seo_title = $input['seo_title'] ?? '';
            $obj->seo_keywords = $input['seo_keywords'] ?? '';
            $obj->seo_description = $input['seo_description'] ?? '';
            $obj->seo_text = $input['seo_text'] ?? '';
            $obj->og_image = $input['og_image'] ?? '';
            $obj->og_title = $input['og_title'] ?? '';
            $obj->og_description = $input['og_description'] ?? '';
            $input['seo'] = json_encode($obj);
        }
        // SEO handle
        //General=====================================>
        $general['fabricator_id'] = $input['fabricator_name_id'] ?? 10000;
        $general['innname_id'] = $input['innname_id'] ?? 10000;
        $general['pharmagroup_id'] = $input['pharmagroup_name_id'] ?? 10000;
        $general['classification_id'] = $input['classification_id'] ?? 10000;
        $general['form_id'] = $input['form_id'] ?? 1;
        $general['approved'] = $input['approved'] ?? 0;
        $general['alias'] = $input['alias'];
        $general['title'] = $input['title'];


        DB::transaction(function () use ($general) {
            DB::table('medicines')->insert($general);
            $model = Medicine::where(['alias' => $general['alias']])->first();
            $general['id'] = $model['id'];
            DB::table('umedicines')->insert($general);
            DB::table('amedicines')->insert($general);
            DB::table('uamedicines')->insert($general);
        });

        $model = Medicine::where(['alias' => $input['alias']])->first();
        $umodel = Umedicine::where(['alias' => $input['alias']])->first();

        if (isset($model) && isset($umodel) && isset($input['substance_id']) && count(array_filter($input['substance_id'])) > 0) {
            DB::transaction(function () use ($input, $model, $umodel) {
                $model->substance()->attach($input['substance_id']);
                $umodel->substance()->attach($input['substance_id']);
            });
        }
        //General=====================================>

        $input = array_map(function ($n) {
            $re = '/&nbsp;/';
            $n = preg_replace($re, ' ', $n);
            return $n;
        }, $input);

        $input = array_map(function ($n) {
            $re = '/ style="[^"]+"/';
            $n = preg_replace($re, '', $n);
            return $n;
        }, $input);

        try {
            $updated = $model->fill($input)->update();
        } catch (Exception $e) {
            \Log::info('Ошибка записи препарата: ', $e->getMessage());
            return ['error' => 'Ошибка записи препарата'];
        }

        if (!empty($updated)) {
            //Slider
            $slider_path = [];
            if ($request->hasFile('slider')) {
                $i = 0;
                foreach ($request->file('slider') as $slider) {
                    $slider_path[$i]['alt'] = $input['imgalt'][$i];
                    $slider_path[$i]['title'] = $input['imgtitle'][$i];
                    $slider_path[$i]['path'] = $this->sliderImg($slider, $model->alias);
                    $i++;
                }

            }

            // slider imgs
            if (!empty($slider_path)) {
                try {

                    $model->image()->createMany($slider_path);
                } catch (Exception $e) {
                    \Log::info('Ошибка записи фотографий слайдера: ', $e->getMessage());
                    $error[] = ['slider' => 'Ошибка записи фотографий слайдера'];
                }
            }
            //Slider
        }
//        dd($result);
        return ['status' => 'Препарат добавлен', 'alias' => $model->alias];
    }

    /**
     * @param $request
     * @param $medicine
     * @return array
     */
    public function updateMedicine($request, $medicine)
    {
        $model = $this->one($medicine);

        if (empty($model)) {
            return ['error' => 'Ошибка изменения препарата.'];
        }

        $input = $request->except('_token', 'slider');

        // SEO handle
        if (!empty($input['seo_title'] || !empty($input['seo_keywords']) || !empty($input['seo_description']) || !empty($input['seo_text'])
            || !empty($input['og_image']) || !empty($input['og_title']) || !empty($input['og_description']))) {
            $obj = new \stdClass;
            $obj->seo_title = $input['seo_title'] ?? '';
            $obj->seo_keywords = $input['seo_keywords'] ?? '';
            $obj->seo_description = $input['seo_description'] ?? '';
            $obj->seo_text = $input['seo_text'] ?? '';
            $obj->og_image = $input['og_image'] ?? '';
            $obj->og_title = $input['og_title'] ?? '';
            $obj->og_description = $input['og_description'] ?? '';
            $input['seo'] = json_encode($obj);
        }
        // SEO handle

        //General=====================================>
        if ($model->classification_id != $input['classification_id']) {
            DB::transaction(function () use ($input, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['classification_id' => $input['classification_id']]);
                DB::table('medicines')->where('alias', $model->alias)->update(['classification_id' => $input['classification_id']]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['classification_id' => $input['classification_id']]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['classification_id' => $input['classification_id']]);
            });
        }
        array_forget($input, 'classification_id');

        if ($model->pharmagroup_name_id != $input['pharmagroup_name_id']) {
            DB::transaction(function () use ($input, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['pharmagroup_id' => $input['pharmagroup_name_id']]);
                DB::table('medicines')->where('alias', $model->alias)->update(['pharmagroup_id' => $input['pharmagroup_name_id']]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['pharmagroup_id' => $input['pharmagroup_name_id']]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['pharmagroup_id' => $input['pharmagroup_name_id']]);
            });
        }
        array_forget($input, 'pharmagroup_name_id');

        if ($model->fabricator_name_id != $input['fabricator_name_id']) {
            DB::transaction(function () use ($input, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['fabricator_id' => $input['fabricator_name_id']]);
                DB::table('medicines')->where('alias', $model->alias)->update(['fabricator_id' => $input['fabricator_name_id']]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['fabricator_id' => $input['fabricator_name_id']]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['fabricator_id' => $input['fabricator_name_id']]);
            });
        }
        array_forget($input, 'fabricator_name_id');

        if ($model->innname_id != $input['innname_id']) {
            DB::transaction(function () use ($input, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['innname_id' => $input['innname_id']]);
                DB::table('medicines')->where('alias', $model->alias)->update(['innname_id' => $input['innname_id']]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['innname_id' => $input['innname_id']]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['innname_id' => $input['innname_id']]);
            });
        }
        array_forget($input, 'innname_id');

        if ($model->form_id != $input['form_id']) {
            DB::transaction(function () use ($input, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['form_id' => $input['form_id']]);
                DB::table('medicines')->where('alias', $model->alias)->update(['form_id' => $input['form_id']]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['form_id' => $input['form_id']]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['form_id' => $input['form_id']]);
            });
        }
        array_forget($input, 'form_id');

        if ($model->backcolor != $input['backcolor']) {
            DB::transaction(function () use ($input, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['backcolor' => $input['backcolor']]);
                DB::table('medicines')->where('alias', $model->alias)->update(['backcolor' => $input['backcolor']]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['backcolor' => $input['backcolor']]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['backcolor' => $input['backcolor']]);
            });
        }
        array_forget($input, 'backcolor');

        if ($model->alias != $input['alias']) {
            $newalias = $input['alias'];
            $oldalias = $model->alias;
            DB::transaction(function () use ($newalias, $oldalias) {
                DB::table('umedicines')->where('alias', $oldalias)->update(['alias' => $newalias]);
                DB::table('medicines')->where('alias', $oldalias)->update(['alias' => $newalias]);
            });
            $model = $this->one($newalias);
        }
        array_forget($input, 'alias');

        $approved = !empty($input['approved']) ? 1 : 0;

        if ($model->approved != $approved) {
            DB::transaction(function () use ($approved, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['approved' => $approved]);
                DB::table('medicines')->where('alias', $model->alias)->update(['approved' => $approved]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['approved' => $approved]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['approved' => $approved]);
            });
        }
        array_forget($input, 'approved');


        $certified = !empty($input['certified']) ? 1 : 0;

        if ($model->certified != $certified) {
            DB::transaction(function () use ($certified, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['certified' => $certified]);
                DB::table('medicines')->where('alias', $model->alias)->update(['certified' => $certified]);
                DB::table('amedicines')->where('alias', $model->alias)->update(['certified' => $certified]);
                DB::table('uamedicines')->where('alias', $model->alias)->update(['certified' => $certified]);
            });
        }
        array_forget($input, 'certified');

        if (isset($input['substance_id']) && count($input['substance_id']) > 0) {
            DB::transaction(function () use ($input, $model) {
                $model->substance()->sync($input['substance_id']);
                $umodel = Umedicine::firstOrCreate(['alias' => $model->alias]);
                $umodel->substance()->sync($input['substance_id']);
            });
        }
        array_forget($input, 'approved');
        //General=====================================>

        $input = array_map(function ($n) {
            $re = '/&nbsp;/';
            $n = preg_replace($re, ' ', $n);
            return $n;
        }, $input);

        $input = array_map(function ($n) {
            $re = '/ style="[^"]+"/';
            $n = preg_replace($re, '', $n);
            return $n;
        }, $input);

        $updated = $model->fill($input)->save();


        if (!empty($updated)) {
            //Slider
            $slider_path = [];
            if ($request->hasFile('slider')) {
                $i = 0;
                foreach ($request->file('slider') as $slider) {
                    $slider_path[$i]['alt'] = $input['imgalt'][$i];
                    $slider_path[$i]['title'] = $input['imgtitle'][$i];
                    $slider_path[$i]['path'] = $this->sliderImg($slider, $model->alias);
                    $i++;
                }

            }

            // slider imgs
            if (!empty($slider_path)) {
                try {

                    $model->image()->createMany($slider_path);
                } catch (Exception $e) {
                    \Log::info('Ошибка записи фотографий слайдера: ', $e->getMessage());
                    $error[] = ['slider' => 'Ошибка записи фотографий слайдера'];
                }
            }
            //Slider
        }
        \Log::info('Препарат отредактирован - ' . $model->alias);
        $this->putTitles();
        Cache::store('file')->forget('off-medicine-' . $model->alias);
        Cache::store('file')->forget('medicine-' . $model->alias);
        Cache::store('file')->forget('medicine-ua-' . $model->alias);
        Cache::store('file')->forget('off-medicine-ua-' . $model->alias);
        Cache::forget('alpha-' . substr($model->title, 0, 1));
        Cache::forget('alphabet');
        Cache::forget('second-alphabet-' . substr($model->title, 0, 2));
        $error = [];
        return ['status' => 'Препарат обновлен', $error];
    }

    /**
     * @param File $image
     * @param $alias
     * @return bool|string
     */
    public function sliderImg($image, $alias)
    {
        if ($image->isValid()) {

            $img = Image::make($image);
            $mime = $img->mime();

            switch ($mime) {
                case 'image/png':
                    $extention = '.png';
                    break;
                default:
                    $extention = '.jpeg';
            }

            $path = substr($alias, 0, 64) . '-slider-' . str_random(2) . time() . $extention;

            $img->resize(config('settings.medicine_img')['main']['width'],
                config('settings.medicine_img')['main']['height'],
                function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path() . '/asset/images/medicine/main/' . $path, 100);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function delSlider($id)
    {
        $slider = Slider::find($id);

        if (empty($slider)) {
            return ['error' => 'Ошибка удаления слайдера(model)'];
        }
        $name = $slider->path;
        try {
            $slider->delete();
        } catch (Exception $e) {
            return ['error' => 'Ошибка удаления слайдера'];
        }
        $this->deleteOldImages($name);

        return ['success' => 'Слайдер обновлен'];
    }

    /**
     * delete old main image
     * @param $path
     * @return true
     */
    public function deleteOldImages($name, $path = false)
    {
        if (File::exists(public_path('/asset/images/medicine/main/') . $name)) {
            File::delete(public_path('/asset/images/medicine/main/') . $name);
        }
        return true;
    }

    /**
     * @param $substances
     * @return mixed
     */
    public function getAnalogs($substances)
    {
        $ids = [];

        foreach ($substances as $substance) {
            $ids[] = $substance->id;
        }

        $medicines = $this->model->whereHas('substance', function ($query) use ($ids) {
            $query->whereIn('substance_id', $ids)->where([['approved', 1]]);
        })
            ->with(['substance', 'classification', 'form'])
//            ->take(3)
            ->get();

        $forms = [];
        foreach ($medicines as $medicine) {
            $forms[$medicine->form->alias] = $medicine->form->name;
        }
        $result['medicines'] = $medicines;
        $result['forms'] = $forms;
        return $result;
    }

    /**
     * @param $request
     * @return null
     */
    public function getCustom($request)
    {
        $result = null;
        switch ($request->source) {
            case 'innname':
                $result = $this->inname->select(['id', 'title', 'name'])
                    ->where('title', 'like', $request->value . '%')
                    ->orWhere('name', 'like', $request->value . '%')->get();
                if (null != $result && $result->isNotEmpty()) {
                    foreach ($result as $item) {
                        $res[$item->id] = $item->title . '(' . $item->name . ')';
                    }
                    $result = $res;
                }
                break;
            case 'form':
                $result = $this->form->select(['id', 'name'])
                    ->where('name', 'like', $request->value . '%')->orderBy('name')->get();
                if (null != $result && $result->isNotEmpty()) {
                    foreach ($result as $item) {
                        $res[$item->id] = $item->name;
                    }
                    $result = $res;
                }
                break;
            case 'classification':
                $result = $this->classification->select(['id', 'class'])
                    ->where('class', $request->value)->first();

                if (null != $result) {

                    $result->load('getChildren');
                    if ($result->getChildren->isNotEmpty()) {
                        foreach ($result->getChildren as $item) {
                            $res[$item->id] = $item->class;
                        }
                    }
                    $res[$result->id] = $result->class;
                    $result = $res;
                }
                break;
            case 'pharmagroup_name':
                $result = $this->pharmagroup->select(['id', 'title'])
                    ->where('title', 'like', $request->value . '%')->orderBy('title')->get();
                if (null != $result && $result->isNotEmpty()) {
                    foreach ($result as $item) {
                        $res[$item->id] = $item->title;
                    }
                    $result = $res;
                }
                break;
            case 'fabricator_name':
                $result = $this->fabricator->select(['id', 'title'])
                    ->where('title', 'like', '%' . $request->value . '%')->orderBy('title')->get();
                if (null != $result && $result->isNotEmpty()) {
                    foreach ($result as $item) {
                        $res[$item->id] = $item->title;
                    }
                    $result = $res;
                }
                break;
            default:
                $result = $this->substance->select(['id', 'title'])
                    ->where('title', 'like', '%' . $request->value . '%')->orderBy('title')->get();
                if (null != $result && $result->isNotEmpty()) {
                    foreach ($result as $item) {
                        $res[$item->id] = $item->title;
                    }
                    $result = $res;
                }
                break;
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function putTitles()
    {
        try {
            $array = MedicineTitle::select('title', 'utitle', 'alias')->get();
            $data = serialize($array->toArray());
            file_put_contents(public_path('asset/titles.txt'), $data);
        } catch (Exception $e) {
            \Log::info('Ошибка записи тайтлов - ' . $e->getMessage());
        }

        return true;
    }

    /**
     * @param $id
     * @param bool $loc
     * @return \stdClass
     */
    public function getSecondarySeo($id, $source, $loc = false)
    {
        if ('analog' == $source) {
            $seo = AnalogSeo::where('medicine_id', $id)->first();
        } else {
            $seo = FaqSeo::where('medicine_id', $id)->first();
        }

        $obj = new \stdClass;

        if (false == $loc) {
            $obj->seo_title = $seo['seo_title'] ?? '';
            $obj->seo_keywords = $seo['seo_keywords'] ?? '';
            $obj->seo_description = $seo['seo_description'] ?? '';
            $obj->seo_text = $seo['seo_text'] ?? '';
            $obj->og_image = $seo['og_image'] ?? '';
            $obj->og_title = $seo['og_title'] ?? '';
            $obj->og_description = $seo['og_description'] ?? '';
        } else {
            $obj->seo_title = $seo['useo_title'] ?? '';
            $obj->seo_keywords = $seo['useo_keywords'] ?? '';
            $obj->seo_description = $seo['useo_description'] ?? '';
            $obj->seo_text = $seo['useo_text'] ?? '';
            $obj->og_image = $seo['uog_image'] ?? '';
            $obj->og_title = $seo['uog_title'] ?? '';
            $obj->og_description = $seo['uog_description'] ?? '';
        }
        return $obj;
    }
}