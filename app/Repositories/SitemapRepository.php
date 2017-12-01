<?php

namespace Fresh\Medpravda\Repositories;

use App;
use URL;
use Cache;
use DB;
use Fresh\Medpravda\Article;

class SitemapRepository
{
    public function index()
    {
        // create new sitemap object
        $sitemap_article = App::make("sitemap");

//    Articles
        $posts = Article::where('approved', 1)
            ->with('image')->orderBy('updated_at', 'desc')->get();
        foreach ($posts as $post) {
            // get all images for the current post
            $images = array();

            $images[] = array(
                'url' => asset('\asset\images\articles\main\\') . $post->image->path,
                'title' => $post->image->title,
                'caption' => $post->image->alt
            );

            $sitemap_article->add(URL::to('statyi/' . $post->alias), $post->updated_at, '1.0', 'daily', $images);

        }

        $sitemap_article->store('xml', 'sitemap-articles');
//    Articles
//    medicines
        $sitemap_medicine = App::make("sitemap");
        $medicines = medicine::with('image')->orderBy('created_at', 'desc')->get();
        foreach ($medicines as $medicine) {
            // get all images for the current post
            $images = array();

            $images[] = array(
                'url' => asset('\asset\images\medicine\content\main\\') . $medicine->image->path,
                'title' => $medicine->medicine_img->title,
                'caption' => $medicine->medicine_img->alt
            );

            $sitemap_medicine->add(URL::to('doctor/medicine/' . $medicine->alias), $medicine->updated_at, '1.0', 'daily', $images);
        }
        $sitemap_medicine->store('xml', 'sitemap-medicine');
//    medicines

        $sitemap_main = App::make("sitemap");

        $horo_update = Horoscope::select('updated_at')->first();
        $sitemap_main->add(URL::to('/'), date('Y-m-d 00:00:00'), '0.6', 'daily');
        $sitemap_main->add(URL::to('catalog/kliniki'), date('Y-m-d 00:00:00'), '0.8', 'daily');
        $sitemap_main->add(URL::to('catalog/brendy'), date('Y-m-d 00:00:00'), '0.8', 'daily');
        $sitemap_main->add(URL::to('catalog/distributory'), date('Y-m-d 00:00:00'), '0.8', 'daily');
        $sitemap_main->add(URL::to('catalog/vrachi'), date('Y-m-d 00:00:00'), '0.8', 'daily');

        $statics = Static_page::select('updated_at', 'own')->get();
        foreach ($statics as $page) {
            $sitemap_main->add(route($page->own), $page->updated_at, '0.8', 'monthly');
        }

//        categories
        $cats = Menu::with('category')->get();

        foreach ($cats as $cat) {
            $sitemap_main->add(route('article_cat', $cat->category->alias), $cat->category->updated_at, '0.8', 'weekly');
        }
//        categories
        $sitemap_main->store('xml', 'sitemap-main');

        $sitemap = App::make("sitemap");

        $sitemap->addSitemap(URL::to('sitemap-articles.xml'));
        $sitemap->addSitemap(URL::to('sitemap-main.xml'));

        \Log::info('Sitemap updated - ' . date("d-m-Y H:i:s"));
        $sitemap->store('sitemapindex', 'sitemap');
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return DB::select('SELECT * FROM `cats_view`');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getPatientArticles()
    {
        return Article::select('title', 'alias', 'category_id')->where([['approved', 1], ['own', 'patient']])->orderBy('updated_at', 'desc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getDocsArticles()
    {
        return Article::select('title', 'alias', 'category_id')->where([['approved', 1], ['own', 'docs']])->orderBy('updated_at', 'desc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getBlogs()
    {
        return Blog::select('title', 'alias', 'category_id')->where([['approved', 1]])->orderBy('updated_at', 'desc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getBlogCats()
    {
        return BlogCategory::select('name', 'alias', 'id')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getDocs()
    {
        return Person::select('name', 'alias', 'lastname')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getEstablishments()
    {
        return Establishment::select('title', 'alias', 'category')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getEvents()
    {
        return Event::select('title', 'alias', 'cat_id')->where([['approved', 1]])->orderBy('updated_at', 'desc')->get();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getEventCats()
    {
        return Eventscategory::select('name', 'alias', 'id')->get();
    }
}
