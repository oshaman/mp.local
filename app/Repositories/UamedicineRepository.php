<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Uamedicine;
use Fresh\Medpravda\Uaimage as Slider;
use Image;
use Config;
use Validator;
use File;
use Cache;

class UamedicineRepository extends Repository
{
    /**
     * UamedicineRepository constructor.
     * @param Uamedicine $medicine
     */
    public function __construct(Uamedicine $medicine)
    {
        $this->model = $medicine;
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
        Cache::store('file')->forget('medicine-ua-' . $model->alias);

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

            $width = $img->width();
            $height = $img->height();

            if ($width > $height) {
                $width = config('settings.medicine_img')['main']['width'];
                $height = null;
            } else {
                $height = config('settings.medicine_img')['main']['height'];
                $width = null;
            }

            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path() . '/asset/images/medicine/main_aukr/' . $path, 100);
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
        if (File::exists(public_path('/asset/images/medicine/main_aukr/') . $name)) {
            File::delete(public_path('/asset/images/medicine/main_aukr/') . $name);
        }
        return true;
    }

}