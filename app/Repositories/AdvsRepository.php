<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Adv;
use Validator;
use Image;
use Config;

class AdvsRepository extends Repository
{

    /**
     * QuestionsRepository constructor.
     * @param Question $question
     * @param Uquestion $uquestion
     */
    public function __construct(Adv $adv)
    {
        $this->model = $adv;
    }

    public function updateAdv($request, $adv = null)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:3,255',
            'utitle' => 'required|string|between:3,255',
            'text' => 'nullable|string',
            'utext' => 'nullable|string',
            'imgalt' => 'nullable|string|between:3,255',
            'uimgalt' => 'nullable|string|between:3,255',
            'imgtitle' => 'nullable|string|between:3,255',
            'uimgtitle' => 'nullable|string|between:3,255',
            'image' => 'sometimes|mimes:jpg,bmp,png,jpeg|max:5120',
            'uimage' => 'sometimes|mimes:jpg,bmp,png,jpeg|max:5120',
            'confirmed' => 'boolean|nullable',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        if (null !== $adv) {
            $this->model = $this->findById($adv);
        }

        $data = $request->except('_token', 'image', 'uimage');

        $this->model->title = $data['title'];
        $this->model->utitle = $data['utitle'];

        $this->model->text = $data['text'];
        $this->model->utext = $data['utext'];

        $this->model->img_alt = $data['imgalt'];
        $this->model->uimg_alt = $data['uimgalt'];

        $this->model->img_title = $data['imgtitle'];
        $this->model->uimg_title = $data['uimgtitle'];

        if (!empty($data['confirmed'])) {
            $this->model->approved = 1;
            $old_img = $this->model->path;
            $old_uimg = $this->model->upath;
        } else {
            $this->model->approved = 0;
        }

        if ($request->hasFile('image')) {
            $path = $this->mainImg($request->file('image'), $this->transliterate($data['title']), 'ru');

            if (false === $path) {
                $error[] = ['img' => 'Ошибка загрузки картинки'];
            } else {
                $this->model->path = $path;
            }
            if (!empty($old_img)) {
                $this->deleteOldImage($old_img, 'ru');
            }
        }

        if ($request->hasFile('uimage')) {
            $upath = $this->mainImg($request->file('uimage'), $this->transliterate($data['utitle']), 'ua');

            if (false === $upath) {
                $error[] = ['img' => 'Ошибка загрузки картинки'];
            } else {
                $this->model->upath = $upath;
            }
            if (!empty($uold_img)) {
                $this->deleteOldImage($old_uimg, 'ua');
            }
        }

        $res = $this->model->save();
        dd($res);
        if ($res) {

        }
        return ['status' => 'Статья обновлена'];
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

            $img->resize(Config::get('settings.adv_img')['main']['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path() . '/asset/images/rk/' . $loc . '/' . $path, 100);
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
        if (File::exists(public_path('/asset/images/rk/' . $loc . '/') . $path)) {
            File::delete(public_path('/asset/images/rk/' . $loc . '/') . $path);
        }

        return true;
    }

}