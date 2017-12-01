<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Tag;
use Gate;

class TagsRepository extends Repository
{


    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * Create new Tag
     * @param $request
     * @return bool
     */
    public function addTag($request)
    {
        $data = $request->except('_token');

        $tag['name'] = $data['tag'];
        $tag['uname'] = $data['utag'];

        if (empty($data['alias'])) {
            $tag['alias'] = $this->transliterate($data['tag']);
        } else {
            $tag['alias'] = $this->transliterate($data['alias']);
        }
        if ($this->one($tag['alias'], FALSE)) {
            $request->merge(array('alias' => $tag['alias']));
            $request->flash();

            return ['error' => 'Псевдоним используется'];
        }

        $res = $this->model->fill($tag)->save();

        return $res;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updateTag($request, $tag)
    {
        if ($tag->name != $request->tag) {
            $tag->name = $request->tag;
        }

        if ($tag->uname != $request->utag) {
            $tag->uname = $request->utag;
        }

        if (empty($request->alias)) {
            $alias = $this->transliterate($request->tag);
            if ($alias != $tag->alias) {
                if ($this->one($alias)) {
                    $request->merge(array('alias' => $alias));
                    $request->flash();

                    return ['error' => 'Псевдоним используется'];
                }
                $tag->alias = $alias;
            }
        } else {
            $alias = $this->transliterate($request->alias);
            if ($alias != $tag->alias) {
                $tag->alias = $alias;
            }
        }
        $data = $request->except('_token', 'alias', 'name', 'uname');
        // SEO handle
        if (!empty($data['seo_title'] || !empty($data['seo_keywords']) || !empty($data['seo_description']) || !empty($data['seo_text'])
            || !empty($data['og_image']) || !empty($data['og_title']) || !empty($data['og_description']))) {
            $obj = new \stdClass;
            $obj->seo_title = $data['seo_title'] ?? '';
            $obj->seo_keywords = $data['seo_keywords'] ?? '';
            $obj->seo_description = $data['seo_description'] ?? '';
            $obj->seo_text = $data['seo_text'] ?? '';
            $obj->og_image = $data['og_image'] ?? '';
            $obj->og_title = $data['og_title'] ?? '';
            $obj->og_description = $data['og_description'] ?? '';
            $tag['seo'] = json_encode($obj);
        } else {
            $tag['seo'] = null;
        }

        if (!empty($data['useo_title'] || !empty($data['useo_keywords']) || !empty($data['useo_description']) || !empty($data['useo_text'])
            || !empty($data['uog_image']) || !empty($data['uog_title']) || !empty($data['uog_description']))) {
            $obj = new \stdClass;
            $obj->useo_title = $data['useo_title'] ?? '';
            $obj->useo_keywords = $data['useo_keywords'] ?? '';
            $obj->useo_description = $data['useo_description'] ?? '';
            $obj->useo_text = $data['useo_text'] ?? '';
            $obj->uog_image = $data['uog_image'] ?? '';
            $obj->uog_title = $data['uog_title'] ?? '';
            $obj->uog_description = $data['uog_description'] ?? '';
            $tag['useo'] = json_encode($obj);
        } else {
            $tag['useo'] = null;
        }
        // seo handle

        $res = $tag->save();
        return $res;
    }

    /**
     * @param $tag
     * @return array
     */
    public function deleteTag($tag)
    {
        if ($tag->delete()) {
            return ['status' => 'Тег удален'];
        }

    }

    /**
     *
     * @return tags array
     */
    public function tagSelect()
    {
        $tags = $this->model->select(['name', 'id'])->get();
        $lists = array();

        foreach ($tags as $tag) {
            $lists[$tag->id] = $tag->name;
        }
        return $lists;
    }
    /*
        public function getMainTags()
        {
            return $this->model->select(['name', 'alias'])->where(['approved'=>1])->skip(15)->take(15)->get();
        }*/

}

?>