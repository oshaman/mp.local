<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\About;
use Validator;
use Image;
use Config;
use File;
use Cache;

class AboutRepository extends Repository
{
    /**
     * QuestionsRepository constructor.
     * @param About
     */
    public function __construct(About $adv)
    {
        $this->model = $adv;
    }

    /**
     * @param $request
     * @return array
     */
    public function updateAbout($request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:3,255',
            'text' => 'nullable|string',
            'alt' => 'nullable|string|between:,255',
            'imgtitle' => 'nullable|string|between:,255',
            'image' => 'sometimes|mimes:jpg,bmp,png,jpeg|max:5120',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->except('_token', 'image');


        if ('ru' == $data['loc']) {
            $id = 1;
            $loc = 'ru';
        } else {
            $id = 2;
            $loc = 'ua';
        }
        $this->model = $this->model->find($id);

        $this->model->title = $data['title'];

        $this->model->text = $data['text'];

        $this->model->alt = $data['alt'];

        $this->model->img_title = $data['imgtitle'];

        if ($request->hasFile('image')) {
            $old_img = $this->model->path ?? null;

            $path = $this->mainImg($request->file('image'), $this->transliterate($data['title']), $loc);

            if (false === $path) {
                $error[] = ['img' => 'Ошибка загрузки картинки'];
            } else {
                $this->model->path = $path;
            }
            if (!empty($old_img)) {
                $this->deleteOldImage($old_img, $loc);
            }
        }

        $res = $this->model->save();

        Cache::store('file')->forget('abouts_update_' . $this->model->id);

        Cache::store('file')->rememberForever('abouts_update_' . $this->model->id, function () {

            $u = $this->model->updated_at;
            return (string)$u;
        });



        if ($res) {
            return ['status' => 'Статья обновлена'];
        }
        $error[] = ['img' => 'Ошибка записи данных'];
    }

    /**
     * @param File $image
     * @param $alias
     * @param string $position
     * @return bool|string
     */
    public function mainImg($image, $alias, $loc)
    {
        if ($image->isValid()) {

            $path = substr($alias, 0, 64) . '-' . time() . '.jpeg';

            $img = Image::make($image);

            $img->save(public_path() . '/asset/images/about/' . $loc . '/' . $path, 100);;

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
    public function deleteOldImage($path, $loc)
    {
        if (File::exists(public_path('/asset/images/about/' . $loc . '/') . $path)) {
            File::delete(public_path('/asset/images/about/' . $loc . '/') . $path);
        }

        return true;
    }
}