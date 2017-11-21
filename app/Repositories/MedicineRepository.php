<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Image as Slider;
use Fresh\Medpravda\Medicine;
use Fresh\Medpravda\Umedicine;
use Image;
use Config;
use Validator;
use File;
use DB;

class MedicineRepository extends Repository
{
    public function __construct(Medicine $medicine)
    {
        $this->model = $medicine;
    }

    /**
     * @param $request
     */
    public function createMedicine($request)
    {
        dd($request->all());
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

//        dd($input);
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


        if ($model->alias != $input['alias']) {
            $newalias = $input['alias'];
            $oldalias = $model->alias;
            DB::transaction(function () use ($newalias, $oldalias) {
                DB::table('umedicines')->where('alias', $oldalias)->update(['alias' => $newalias]);
                DB::table('medicines')->where('alias', $oldalias)->update(['alias' => $newalias]);
            });
            $model = $this->one($newalias);
        }


        $approved = !empty($input['approved']) ? 1 : 0;

        if ($model->approved != $approved) {
            DB::transaction(function () use ($approved, $model) {
                DB::table('umedicines')->where('alias', $model->alias)->update(['approved' => $approved]);
                DB::table('medicines')->where('alias', $model->alias)->update(['approved' => $approved]);
            });
            array_forget($input, 'approved');
        }

//        dd($model);

        $updated = $model->fill($input)->save();
//        dd($input);

        if (!empty($updated)) {
            //Slider
            $slider_path = [];
            if ($request->hasFile('slider')) {
                $i = 0;
                foreach ($request->file('slider') as $slider) {
                    $slider_path[$i]['alt'] = $input['imgalt'][$i];
                    $slider_path[$i]['title'] = $input['imgtitle'][$i];
                    $slider_path[$i]['path'] = $this->sliderImg($slider, $input['alias']);
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

            $path = substr($alias, 0, 64) . '-slider-' . str_random(2) . time() . '.jpeg';

            $img = Image::make($image);

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
            $query->whereIn('substance_id', $ids);
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
}