<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\UArticle;
use Gate;
use File;
use Image;
use Config;
use Validator;
use Cache;
use DB;

class UarticlesRepository extends Repository
{
    /**
     * ArticlesRepository constructor.
     * @param Article $rep
     */
    public function __construct(UArticle $uarticle)
    {
        $this->model = $uarticle;
    }

    /**
     * @param $request
     * @param Article $article
     * @return array - Result
     */
    public function updateArticle($request, $article)
    {
        $data = $request->except('_token', 'img');
        $article = $this->model->where('id', $article)->first();
        if (null == $article) return $error[] = ['error' => 'Ошибка получения данных'];
        $article->load('image');

        if ($data['title'] !== $article->title) {
            $new['title'] = $data['title'];
        }

        $new['description'] = $data['description'] ?? null;
        $new['priority'] = $data['priority'] ?? null;

        if (!empty($article->image->alt)) {
            if ($data['imgalt'] !== $article->image->alt) {
                $new['imgalt'] = $data['imgalt'];
            } else {
                $new['imgalt'] = $article->image->alt;
            }

            if ($data['imgtitle'] !== $article->image->title) {
                $new['imgtitle'] = $data['imgtitle'];
            } else {
                $new['imgtitle'] = $article->image->title;
            }
        } else {
            $new['imgalt'] = $data['imgalt'];
            $new['imgtitle'] = $data['imgtitle'];
        }

        if (!empty($data['outputtime'])) {
            $new['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
        }
        /*if (!empty($data['view'])) {
            $new['view'] = (int)$data['view'];
        }*/

        if (!empty($data['confirmed'])) {
            $new['approved'] = 1;
        } else {
            $new['approved'] = 0;
        }

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
            $new['seo'] = json_encode($obj);
        } else {
            $new['seo'] = null;
        }

        //        Content
        $re = '/(<em>|<strong>|<b>|<\/em>|<\/strong>|<\/b>|&nbsp;|&raquo;|&laquo;
                    |&ndash;|&mdash;|&shy;|<div[^>]+>|<\/div>|<span[^>]+>|<\/span>)/';
        $new['content'] = preg_replace($re, ' ', $data['content']);
//        END Content

        $updated = $article->fill($new)->save();

        $error = '';
        if (!empty($updated)) {

            $old_img = $article->image->path ?? null;
            // Main Image handle
            if ($request->hasFile('img')) {
                $path = $this->mainImg($request->file('img'), $article->alias);

                if (false === $path) {
                    $error[] = ['img' => 'Ошибка загрузки картинки'];
                } else {
                    if (0 != count($article->image)) {
                        $img = $article->image()->update(['path' => $path, 'alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                    } else {
                        $img = $article->image()->create(['path' => $path, 'alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                    }
                }

                if (empty($img)) {
                    $error[] = ['img' => 'Ошибка записи картинки'];
                }
                //DELETE OLD IMAGE
                if (null != $old_img) {
                    $this->deleteOldImage($old_img);
                }
            } else {
                try {
                    $article->image()->update(['alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                } catch (Exception $e) {
                    \Log::info('Ошибка обновления главного изображения статьи: ', $e->getMessage());
                    $error[] = ['img' => 'Ошибка обновления главного изображения статьи'];
                }
            }

            $this->clearArticlesCache($article->id);

            return ['status' => 'Статья обновлена', $error];
        }
        return ['error' => $error];
    }

    /**
     * delete old main image
     * @param $path
     * @return true
     */
    public function deleteOldImage($path)
    {
        if (File::exists(public_path('/asset/images/articles/ua/main/') . $path)) {
            File::delete(public_path('/asset/images/articles/ua/main/') . $path);
        }
        if (File::exists(public_path('/asset/images/articles/ua/middle/') . $path)) {
            File::delete(public_path('/asset/images/articles/ua/middle/') . $path);
        }
        if (File::exists(public_path('/asset/images/articles/ua/small/') . $path)) {
            File::delete(public_path('/asset/images/articles/ua/small/') . $path);
        }
        return true;
    }


    /**
     * @param File $image
     * @param $alias
     * @param string $position
     * @return bool|string
     */
    public function mainImg($image, $alias, $position = 'center')
    {
        if ($image->isValid()) {

            $path = substr($alias, 0, 64) . '-' . time() . '.jpeg';

            $img = Image::make($image);

            $img->resize(Config::get('settings.articles_img')['main']['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path() . '/asset/images/articles/ua/main/' . $path, 100);
            $img->fit(Config::get('settings.articles_img')['middle']['width'], Config::get('settings.articles_img')['middle']['height'])
                ->save(public_path() . '/asset/images/articles/ua/middle/' . $path, 100);
            $img->fit(Config::get('settings.articles_img')['small']['width'], Config::get('settings.articles_img')['small']['height'])
                ->save(public_path() . '/asset/images/articles/ua/small/' . $path, 100);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * @param $tag
     * @return articles collection
     */
    public function getByTag($tag)
    {
        $articles = $this->model->whereHas('tags', function ($q) use ($tag) {
            $q->where('tag_id', $tag)->select('title', 'alias');
        });

        $articles->with(['image', 'category'])->where('approved', 1);

        return $this->check($articles->paginate(9));

    }


    /**
     * Clear
     */
    protected function clearArticlesCache($id = false, $cat = false)
    {
        Cache::forget('ua-main');
//
//        !empty($id) ? Cache::store('file')->forget('docs_article-' . $id) : null;
//
//        !empty($cat) ? Cache::forget('articles_cats' . $cat) : null;
    }

    /**
     * @return mixed
     */
    public function getMain($cat, $takes)
    {
        $prems = $this->getPrems($cat);

        if ($prems->isNotEmpty()) {
            $ids = [];
            foreach ($prems as $prem) {
                $ids[] = $prem->id;
            }
        }


        $builder = $this->model->with('image');

        $where = [['category_id', $cat], ['approved', 1]];
        $builder->where($where);

        if (!empty($ids)) {
            $take = $takes - count($ids);
            $builder->whereNotIn('id', $ids);
        } else {
            $take = $takes;
        }

        $articles = $builder->take($take)->orderBy('created_at', 'desc')->get();

        $res = $prems->concat($articles);

        $res = $this->clearContent($res);
//                dd($res);
        return $res;

    }

    /**
     * @param $cat
     * @param int $take
     * @return mixed
     */
    public function getPrems($cat, $take = 8)
    {
        $where = [['category_id', $cat], ['priority', '>', 0], ['approved', 1]];
        $prems = $this->model->where($where)->take($take)->orderBy('priority', 'desc')->with(['image'])->get();
        return $prems;
    }

    public function clearContent($res)
    {
        $res = $res->transform(function ($item) {
            if ($item->content) {
                $item->content = strip_tags($item->content);
            }
            return $item;
        });
        return $res;
    }

}
