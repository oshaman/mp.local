<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Toptheme;
use Validator;
use Image;
use Config;
use File;
use Cache;

class ThemesRepository extends Repository
{

    /**
     * SlidersRepository constructor.
     * @param Slider
     */
    public function __construct(Toptheme $theme)
    {
        $this->model = $theme;
    }

    public function addTheme($request)
    {
        $data = $request->except('_token', 'img');

        $theme['title'] = $data['title'];

        $theme['description'] = $data['description'];
        $theme['link'] = $data['link'];
        if (2 == (int)$data['loc']) {
            $theme['loc'] = 'ua';
        } else {
            $theme['loc'] = 'ru';
        }

        if (!empty($data['priority'])) {
            $theme['priority'] = abs((int)$data['priority']);
        }

        if (!empty($data['approved'])) {
            $theme['approved'] = 1;
        }

        if (!empty($data['alt'])) {
            $theme['alt'] = $data['alt'];
        } else {
            $theme['alt'] = null;
        }

        if (!empty($data['imgtitle'])) {
            $theme['imgtitle'] = $data['imgtitle'];
        } else {
            $theme['imgtitle'] = null;
        }
//dd($theme);
        if ($request->hasFile('img')) {
            $path = $this->mainImg($request->file('img'), $this->transliterate($theme['title']));

            if (false === $path) {
                $error[] = ['img' => 'Ошибка загрузки картинки'];
            } else {
                $theme['path'] = $path;
                $new = $this->model->firstOrCreate($theme);

                if (!empty($new->id)) {
                    $this->clearThemesCache();
                    return ['status' => 'Тема добавлена', 'id' => $new->id];
                } else {
                    return $error[] = ['img' => 'Ошибка записи темы'];
                }
            }

        } else {
            return $error[] = ['img' => 'Ошибка загрузки картинки'];
        }
    }

    public function updateTheme($request, $theme)
    {

        $data = $request->except('_token', 'img');

        $theme['title'] = $data['title'];

        $theme['description'] = $data['description'];
        $theme['link'] = $data['link'];
        if (2 == (int)$data['loc']) {
            $theme['loc'] = 'ua';
        } else {
            $theme['loc'] = 'ru';
        }

        if (!empty($data['priority'])) {
            $theme['priority'] = abs((int)$data['priority']);
        }

        if (!empty($data['approved'])) {
            $theme['approved'] = 1;
        }

        if (!empty($data['alt'])) {
            $theme['alt'] = $data['alt'];
        } else {
            $theme['alt'] = null;
        }

        if (!empty($data['imgtitle'])) {
            $theme['imgtitle'] = $data['imgtitle'];
        } else {
            $theme['imgtitle'] = null;
        }
//dd($theme);
        if ($request->hasFile('img')) {
            $path = $this->mainImg($request->file('img'), $this->transliterate($theme['title']));

            if (false === $path) {
                $error[] = ['img' => 'Ошибка загрузки картинки'];
            } else {
                $this->deleteOldImage($theme->path);
                $theme['path'] = $path;
            }

        }
//        ==================================

        $res = $theme->save();
//        dd($res);
        if ($res) {
            return ['status' => 'Тема обновлена'];
        }
        $error[] = ['img' => 'Ошибка записи данных'];
    }

    /**
     * @param $theme
     * @return array
     */
    public function deleteTheme($theme)
    {
        $old_img = $theme->path;
        if ('ru' == $theme->loc) {
            $loc = false;
        } else {
            $loc = true;
        }

        if ($theme->delete()) {

            $this->deleteOldImage($old_img);

            $this->clearThemesCache($loc);

            return ['status' => 'Тема удалена'];
        }

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

            $img->fit(Config::get('settings.theme')['width'], Config::get('settings.theme')['height'])
                ->save(public_path() . '/asset/images/theme' . '/' . $path, 100);

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
        if (File::exists(public_path('/asset/images/theme' . '/') . $path)) {
            File::delete(public_path('/asset/images/theme' . '/') . $path);
        }

        return true;
    }

    public function clearThemesCache($loc = false)
    {
        if (false == $loc) {
            Cache::clear('main');
            Cache::clear('themes');
        } else {
            Cache::clear('ua-main');
            Cache::clear('ua-themes');
        }
    }

}