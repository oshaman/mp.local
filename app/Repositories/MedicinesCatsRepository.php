<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\MedicinesCat;
use Image;
use File;

class MedicinesCatsRepository extends Repository
{
    /**
     * MedicinesCatsRepository constructor.
     * @param MedicinesCat $cats
     */
    public function __construct(MedicinesCat $cats)
    {
        $this->model = $cats;
    }

    public function updateCat($request, $cat)
    {
//        dd($cat);
        $old_img = $cat->path ?? null;

//                dd($this->model);
        $data = $request->except('img', '_token');

        if ($request->hasFile('img')) {
            $path = $this->mainImg($request->file('img'), $this->transliterate($data['title']));

            if (false === $path) {
                $error[] = ['img' => 'Ошибка загрузки картинки'];
            } else {
                $data['path'] = $path;
            }
            if (!empty($old_img)) {
                $this->deleteOldImage($old_img);
            }
        }




        try {
            $result = $cat->fill($data)->save();
        } catch (Exception $e) {
            $result = ['error' => 'Ошибка записи'];
            \Log::info('Ошибка записи категории препарата: ' . $e->getMessage());
        }

        if (true === $result) {
            $result = ['status' => 'Данные обновлены'];
        }

        return $result;
    }

    /**
     * @param File $image
     * @param $alias
     * @return bool|string
     */
    public function mainImg($image, $alias)
    {
        if ($image->isValid()) {

            $path = substr($alias, 0, 64) . '-' . time() . '.png';

            $img = Image::make($image);

            $img->save(public_path() . '/asset/images/showcase' . '/' . $path, 100);;

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
        if (File::exists(public_path('/asset/images/showcase' . '/') . $path)) {
            File::delete(public_path('/asset/images/showcase' . '/') . $path);
        }

        return true;
    }
}