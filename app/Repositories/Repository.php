<?php

namespace Fresh\Medpravda\Repositories;

use Config;

abstract class Repository
{

    protected $model = false;

    /**
     * @param string $select
     * @param bool $take
     * @param bool $pagination
     * @param bool $where
     * @param bool $order
     * @param bool $with
     * @return bool
     */
    public function get($select = '*', $take = false, $pagination = false, $where = false, $order = false, $with = false)
    {
        $builder = $this->model->select($select);

        if ($with) {
            $builder = $this->model->with($with);
        }

        if ($take) {
            $builder->take($take);
        }

        if ($where) {
            $builder->where($where);
        }

        if ($order) {
            $builder->orderBy($order[0], $order[1]);
        }

        if ($pagination) {
            if (true === $pagination) {
                $pagination = 14;
            }
            return $this->check($builder->paginate($pagination));
        }

        return $this->check($builder->get());
    }

    /**
     * @param $result
     * @return bool
     */
    protected function check($result)
    {

        if ($result->isEmpty()) {
            return FALSE;
        }

        $result->transform(function ($item) {

            /*if ($item->created_at) {
                $midnight = strtotime('today midnight');
                $created = strtotime($item->created_at);

                if ($created > $midnight) {
                    $item->created = date('H:i', $created);
                } else {
                    $item->created = date('d.m.Y', $created);
                }
            }*/

            if (is_string($item->seo) && is_object(json_decode($item->seo)) && (json_last_error() == JSON_ERROR_NONE)) {
                $item->seo = json_decode($item->seo);
            }

            return $item;

        });

        return $result;

    }

    /**
     * @param $alias
     * @param array $attr
     * @return mixed
     */
    public function one($alias, $attr = array())
    {
        $result = $this->model->where('alias', $alias)->first();

        return $result;
    }

    /**
     * @param $id
     * @param array $attr
     * @return mixed
     */
    public function findById($id, $attr = array())
    {
        $result = $this->model->where('id', $id)->first();

        return $result;
    }

    /**
     * @param $string
     * @return mixed|string
     */
    public function transliterate($string)
    {
        $str = mb_strtolower($string, 'UTF-8');

        $leter_array = array(
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
            'yu' => 'ю',
            'ya' => 'я',
        );

        foreach ($leter_array as $leter => $kyr) {
            $kyr = explode(',', $kyr);

            $str = str_replace($kyr, $leter, $str);
        }

        //  A-Za-z0-9-
        $str = preg_replace('/(\s|[^A-Za-z0-9\-_])+/', '-', $str);

        $str = trim($str, '-');

        return $str;
    }

    /**
     * @param $seo
     * @return mixed
     */
    public function convertSeo($seo)
    {
        if (is_string($seo) && is_object(json_decode($seo)) && (json_last_error() == JSON_ERROR_NONE)) {
            $seo = json_decode($seo);
        }
        return $seo;
    }

    /**
     * @param $date
     * @return false|string
     */
    public function convertDate($date)
    {
        $midnight = strtotime('today midnight');
        $created = strtotime($date);

        if ($created > $midnight) {
            $date = date('H:i', $created);
        } else {
            $date = date('d-m-Y H:i', $created);
        }
        return $date;
    }

    /**
     * @param $model
     * @param bool $loc
     * @return \stdClass
     */
    public function obtainSeo($model, $loc = false)
    {
        $model->load('seo');

        $obj = new \stdClass;

        if (false == $loc) {
            $obj->seo_title = $model->seo->seo_title ?? '';
            $obj->seo_keywords = $model->seo->seo_keywords ?? '';
            $obj->seo_description = $model->seo->seo_description ?? '';
            $obj->seo_text = $model->seo->seo_text ?? '';
            $obj->og_image = $model->seo->og_image ?? '';
            $obj->og_title = $model->seo->og_title ?? '';
            $obj->og_description = $model->seo->og_description ?? '';
        } else {
            $obj->seo_title = $model->seo->useo_title ?? '';
            $obj->seo_keywords = $model->seo->useo_keywords ?? '';
            $obj->seo_description = $model->useo->seo_description ?? '';
            $obj->seo_text = $model->seo->useo_text ?? '';
            $obj->og_image = $model->seo->uog_image ?? '';
            $obj->og_title = $model->seo->uog_title ?? '';
            $obj->og_description = $model->seo->uog_description ?? '';
        }
        return $obj;
    }
}

?>