<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Article;
use Fresh\Medpravda\UArticle;
use Gate;
use File;
use Image;
use Config;
use Validator;
use Cache;
use DB;

class ArticlesRepository extends Repository
{
    protected $uarticle;
    /**
     * ArticlesRepository constructor.
     * @param Article $rep
     */
    public function __construct(Article $rep, UArticle $uarticle)
    {
        $this->model = $rep;
        $this->uarticle = $uarticle;
    }

    /**
     * @param $request
     * @return Result array
     */
    public function addArticle($request)
    {
        $data = $request->except('_token');

        $article['title'] = $data['title'];

        $article['category_id'] = $data['category_id'];

        $article['alias'] = $data['alias'];

        if (!empty($data['confirmed'])) {
            $article['approved'] = 1;
        }

        if (!empty($data['imgalt'])) {
            $img_prop['imgalt'] = $data['imgalt'];
        } else {
            $img_prop['imgalt'] = null;
        }

        if (!empty($data['imgtitle'])) {
            $img_prop['imgtitle'] = $data['imgtitle'];
        } else {
            $img_prop['imgtitle'] = null;
        }

        if (!empty($data['outputtime'])) {
            $article['created_at'] = date('Y-m-d H:i:s', strtotime($data['outputtime']));
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
            $article['seo'] = json_encode($obj);
        }
        //        Content
        $article['content'] = $data['content'];

        $new = $this->model->firstOrCreate($article);
        $uarticle['id'] = $new->id;
        $uarticle['category_id'] = $new->category_id;
        $uarticle['alias'] = $new->alias;
        $ua = $this->uarticle->updateOrCreate($uarticle);
        $ua->save();
        $ua->image()->create(['path' => str_random(10) . 'mp.jpg', 'alt' => 'Med Pravda', 'title' => 'Med Pravda']);

        $error = [];
        if (!empty($new)) {
            // Main Image handle
            if ($request->hasFile('img')) {
                $path = $this->mainImg($request->file('img'), $article['alias']);

                if (false === $path) {
                    $error[] = ['img' => 'Ошибка загрузки картинки'];
                } else {
                    $img = $new->image()->create(['path' => $path, 'alt' => $img_prop['imgalt'], 'title' => $img_prop['imgtitle']]);
                }

                if (null == $img) {
                    $error[] = ['img' => 'Ошибка записи картинки'];
                }
            } else {
                try {
                    $new->image()->create(['path' => str_random(10) . 'mp.jpg', 'alt' => 'Med Pravda', 'title' => 'Med Pravda']);
                } catch (Exception $e) {
                    \Log::info('Ошибка обновления главного изображения статьи: ', $e->getMessage());
                    $error[] = ['img' => 'Ошибка обновления главного изображения статьи'];
                }
            }
            // Tags
            if (!empty($data['tags'])) {
                try {
                    $new->tags()->attach($data['tags']);
                } catch (Exception $e) {
                    \Log::info('Ошибка записи тегов: ', $e->getMessage());
                    $error[] = ['tag' => 'Ошибка записи тегов'];
                }
            }

            /*$cat = $new->category->alias;
            $this->clearArticlesCache(false, $cat);*/
            return ['status' => 'Статья добавлена', 'id' => $new->id];
        }
        return ['error' => $error];
    }

    /**
     * @param $request
     * @param Article $article
     * @return array - Result
     */
    public function updateArticle($request, $article)
    {
//        dd($request->all());
        $data = $request->except('_token', 'img');
        $article = $this->model->where('id', $article)->first();
        if (null == $article) return $error[] = ['error' => 'Ошибка получения данных'];
        $article->load('image');

        if ($data['title'] !== $article->title) {
            $new['title'] = $data['title'];
        }
        if ($data['alias'] !== $article->alias) {
            $new['alias'] = $data['alias'];
        }

        if ($data['category_id'] !== $article->category_id) {
            $new['category_id'] = $data['category_id'];
        }

        if (empty($article->image->alt) || $data['imgalt'] !== $article->image->alt) {
            $new['imgalt'] = $data['imgalt'];
        } else {
            $new['imgalt'] = $article->image->alt;
        }

        if (empty($data['tags'])) {
            $data['tags'] = null;
        }

        if (empty($article->image->title) || $data['imgtitle'] !== $article->image->title) {
            $new['imgtitle'] = $data['imgtitle'];
        } else {
            $new['imgtitle'] = $article->image->title;
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
        $new['content'] = $data['content'];
//        END Content

        $updated = $article->fill($new)->save();
        if ($updated) {
            $uarticle['id'] = $article->id;
            $uarticle['alias'] = $article->alias;
            $cat['category_id'] = $article->category_id;
            $this->uarticle->updateOrCreate($uarticle, $cat);
        }

        $error = '';
        if (!empty($updated)) {

            $old_img = $article->image->path ?? null;

            // Main Image handle
            if ($request->hasFile('img')) {
                $path = $this->mainImg($request->file('img'), $article->alias);

                if (false === $path) {
                    $error[] = ['img' => 'Ошибка загрузки картинки'];
                } else {
                    if (empty($old_img)) {
                        $img = $article->image()->create(['path' => $path, 'alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                    } else {
                        $img = $article->image()->update(['path' => $path, 'alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                    }
                }

                if (empty($img)) {
                    $error[] = ['img' => 'Ошибка записи картинки'];
                }
                //DELETE OLD IMAGE
                $this->deleteOldImage($old_img);
            } else {
                try {
                    $article->image()->update(['alt' => $new['imgalt'], 'title' => $new['imgtitle']]);
                } catch (Exception $e) {
                    \Log::info('Ошибка обновления главного изображения статьи: ', $e->getMessage());
                    $error[] = ['img' => 'Ошибка обновления главного изображения статьи'];
                }
            }

            try {
                $article->tags()->sync($data['tags']);
            } catch (Exception $e) {
                \Log::info('Ошибка записи тегов: ', $e->getMessage());
                $error[] = ['tag' => 'Ошибка записи тегов'];
            }


//            $this->clearArticlesCache($article->id);

            return ['status' => 'Статья обновлена', $error];
        }
        return ['error' => $error];
    }

    /**
     *
     * @param $article
     * @return Result array
     */
    public function deleteArticle($article)
    {
        // $article->comments()->delete();
        if (!empty($article->image->path)) {
            $old_img = $article->image->path;
        }

        $uarticle = UArticle::where('id', $article->id)->first();
        if (!empty($uarticle->image->path)) {
            $uold_img = $uarticle->image->path;
        }

//        dd($article);

        if ($article->delete()) {

            if (!empty($old_img)) {
                $this->deleteOldImage($old_img);
            }

            if (File::exists(public_path('/asset/images/articles/ua/main/') . $uold_img)) {
                File::delete(public_path('/asset/images/articles/ua/main/') . $uold_img);
            }
            if (File::exists(public_path('/asset/images/articles/ua/middle/') . $uold_img)) {
                File::delete(public_path('/asset/images/articles/ua/middle/') . $uold_img);
            }
            if (File::exists(public_path('/asset/images/articles/ua/small/') . $uold_img)) {
                File::delete(public_path('/asset/images/articles/ua/small/') . $uold_img);
            }

//            $this->clearArticlesCache();

            return ['status' => 'Статья удалена'];
        }

    }

    /**
     * delete old main image
     * @param $path
     * @return true
     */
    public function deleteOldImage($path)
    {
        if (File::exists(public_path('/asset/images/articles/ru/main/') . $path)) {
            File::delete(public_path('/asset/images/articles/ru/main/') . $path);
        }
        if (File::exists(public_path('/asset/images/articles/ru/middle/') . $path)) {
            File::delete(public_path('/asset/images/articles/ru/middle/') . $path);
        }
        if (File::exists(public_path('/asset/images/articles/ru/small/') . $path)) {
            File::delete(public_path('/asset/images/articles/ru/small/') . $path);
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
            })->save(public_path() . '/asset/images/articles/ru/main/' . $path, 100);
            $img->fit(Config::get('settings.articles_img')['middle']['width'], Config::get('settings.articles_img')['middle']['height'])
                ->save(public_path() . '/asset/images/articles/ru/middle/' . $path, 100);
            $img->fit(Config::get('settings.articles_img')['small']['width'], Config::get('settings.articles_img')['small']['height'])
                ->save(public_path() . '/asset/images/articles/ru/small/' . $path, 100);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * @param $tag
     * @return articles collection
     */
    public function getByTag($tag, $own)
    {
        $articles = $this->model->whereHas('tags', function ($q) use ($tag) {
            $q->where('tag_id', $tag)->select('title', 'alias');
        });

        $articles->with(['image', 'category'])->where('own', $own);

        return $this->check($articles->paginate(Config::get('settings.paginate_tags')));

    }


    /**
     * Clear
     */
    protected function clearArticlesCache($id = false)
    {
        Cache::forget('patientSidebar');
        Cache::forget('docsArticleSidebar');
        Cache::forget('docsSidebar');
        Cache::forget('docsArticles');
        Cache::forget('main');
        Cache::forget('eventSidebar');
        Cache::forget('event_content');
        Cache::forget('articles_last');
        Cache::forget('docs_articles_last');
        Cache::forget('blogs_sidebar');
        !empty($id) ? Cache::store('file')->forget('docs_article-' . $id) : null;
        !empty($id) ? Cache::store('file')->forget('patients_article-' . $id) : null;
        !empty($cat) ? Cache::forget('docs_cats' . $cat) : null;
        !empty($cat) ? Cache::forget('articles_cats' . $cat) : null;
    }


}
