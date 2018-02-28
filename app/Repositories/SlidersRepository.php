<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Slider;
use Validator;
use Image;
use Config;
use File;

class SlidersRepository extends Repository
{

    /**
     * SlidersRepository constructor.
     * @param Slider
     */
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
    }

    public function updateSlider($request, $mainslider = null)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|between:3,24',
            'text' => 'nullable|string|between:3,196',
            'link' => 'nullable|string',

            'img' => 'sometimes|mimes:jpg,bmp,png,jpeg|max:5120',
            'alt' => 'nullable|string|between:,255',
            'title' => 'nullable|string|between:,255',
            'approved' => 'boolean|nullable',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        if (null !== $mainslider) {
            $this->model = $this->findById($mainslider);
        }

        $data = $request->except('_token', 'img');

        $this->model->description = $data['description'];

        $this->model->text = $data['text'];
        $this->model->link = $data['link'];

        $this->model->alt = $data['alt'];

        $this->model->title = $data['title'];

        if (!empty($data['approved'])) {
            $this->model->approved = 1;
        } else {
            $this->model->approved = 0;
        }

        $old_img = $this->model->path ?? null;

//                dd($this->model);


        if ($request->hasFile('img')) {
            $path = $this->mainImg($request->file('img'), $this->transliterate($data['description']));

            if (false === $path) {
                $error[] = ['img' => 'Ошибка загрузки картинки'];
            } else {
                $this->model->path = $path;
            }
            if (!empty($old_img)) {
                $this->deleteOldImage($old_img);
            }
        }

        $res = $this->model->save();
//        dd($res);
        if ($res) {
            return ['status' => 'Слайдер обновлен'];
        }
        $error[] = ['img' => 'Ошибка записи данных'];
    }

    /**
     * @param File $image
     * @param $alias
     * @return bool|string
     */
    public function mainImg($image, $alias)
    {
        if ($image->isValid()) {

            $path = substr($alias, 0, 64) . '-' . time() . '.jpeg';

            $img = Image::make($image);

            $img->fit(Config::get('settings.slider')['width'], Config::get('settings.slider')['height'])
                ->save(public_path() . '/asset/images/slider' . '/' . $path, 100);
//            $img->save(public_path() . '/asset/images/slider' . '/' . $path, 100);

            return $path;
        } else {
            return false;
        }
    }

    /**
     * delete old main image
     * @param $path
     * @return true
     */
    public function deleteOldImage($path)
    {
        if (File::exists(public_path('/asset/images/slider' . '/') . $path)) {
            File::delete(public_path('/asset/images/slider' . '/') . $path);
        }

        return true;
    }

}