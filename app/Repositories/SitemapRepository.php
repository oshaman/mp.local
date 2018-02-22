<?php

namespace Fresh\Medpravda\Repositories;

use App;
use Fresh\Medpravda\About;
use Fresh\Medpravda\Adv;
use Fresh\Medpravda\Amedicinemap;
use Fresh\Medpravda\Category;
use Fresh\Medpravda\Classification;
use Fresh\Medpravda\Fabricator;
use Fresh\Medpravda\Innname;
use Fresh\Medpravda\Medicinemap;
use Fresh\Medpravda\Pharmagroup;
use Fresh\Medpravda\Substance;
use Fresh\Medpravda\Tag;
use Fresh\Medpravda\Uamedicinemap;
use Fresh\Medpravda\UArticle;
use Fresh\Medpravda\Umedicine;
use Fresh\Medpravda\Umedicinemap;
use URL;
use Cache;
use DB;
use Fresh\Medpravda\Article;

class SitemapRepository
{
    /**
     *
     */
    public function getMedicines()
    {
        ini_set('max_execution_time', 360);


        //    medicines
        $sitemap_medicine = App::make("sitemap");
        $sitemap_analog = App::make("sitemap");
        $sitemap_faq = App::make("sitemap");

        Medicinemap::with('image')
            ->chunk(500, function ($medicines) use ($sitemap_medicine, $sitemap_analog, $sitemap_faq) {
                foreach ($medicines as $medicine) {
                    // get all images for the current post
                    $images = array();

                    if (!empty($medicine->image && $medicine->image->isNotEmpty())) {
                        foreach ($medicine->image as $image) {
                            $images[] = array(
                                'url' => asset('/asset/images/medicine/main') . '/' . $image->path,
                                'title' => $image->title,
                                'caption' => $image->alt
                            );
                        }
                    }

                    $sitemap_medicine->add(URL::to('/preparat/' . $medicine->alias . '/official'),
                        $medicine->updated_at, '1.0', 'daily', $images);

                    $sitemap_analog->add(URL::to('/preparat/' . $medicine->alias . '/analog'),
                        $medicine->updated_at, '1.0', 'daily');
                    $sitemap_faq->add(URL::to('/preparat/' . $medicine->alias . '/faq'),
                        $medicine->updated_at, '1.0', 'daily');
                }
            });

        $sitemap_medicine->store('xml', 'sitemap-medicine');
        $sitemap_analog->store('xml', 'sitemap-medicine-analog');
        $sitemap_faq->store('xml', 'sitemap-medicine-faq');

        $sitemap_medicine->model->resetItems();
        $sitemap_analog->model->resetItems();
        $sitemap_faq->model->resetItems();
        //        UA
        $sitemap_medicine_ua = App::make("sitemap");
        $sitemap_analog_ua = App::make("sitemap");
        $sitemap_faq_ua = App::make("sitemap");

        Umedicinemap::with('image')
            ->chunk(500, function ($medicines) use ($sitemap_medicine_ua, $sitemap_analog_ua, $sitemap_faq_ua) {
                foreach ($medicines as $medicine) {
                    $images = array();
                    if (!empty($medicine->image && $medicine->image->isNotEmpty())) {
                        foreach ($medicine->image as $image) {
                            $images[] = array(
                                'url' => asset('/asset/images/medicine/main_ukr') . '/' . $image->path,
                                'title' => $image->title,
                                'caption' => $image->alt
                            );
                        }
                    }

                    $sitemap_medicine_ua->add(URL::to('/ua/preparat/' . $medicine->alias . '/official'),
                        $medicine->updated_at, '1.0', 'daily', $images);
                    $sitemap_analog_ua->add(URL::to('/ua/preparat/' . $medicine->alias . '/analog'),
                        $medicine->updated_at, '1.0', 'daily');
                    $sitemap_faq_ua->add(URL::to('/ua/preparat/' . $medicine->alias . '/faq'),
                        $medicine->updated_at, '1.0', 'daily');
                }
            });

        $sitemap_medicine_ua->store('xml', 'sitemap-medicine-ua');
        $sitemap_analog_ua->store('xml', 'sitemap-medicine-analog-ua');
        $sitemap_faq_ua->store('xml', 'sitemap-medicine-faq-ua');

        $sitemap_medicine_ua->model->resetItems();
        $sitemap_analog_ua->model->resetItems();
        $sitemap_faq_ua->model->resetItems();
        //        Adaptive
        $sitemap_medicine_adaptive = App::make("sitemap");

        Amedicinemap::with('image')->chunk(500, function ($medicines) use ($sitemap_medicine_adaptive) {
            foreach ($medicines as $medicine) {
                $images = array();
                if (!empty($medicine->image && $medicine->image->isNotEmpty())) {
                    foreach ($medicine->image as $image) {
                        $images[] = array(
                            'url' => asset('/asset/images/medicine/main_a') . '/' . $image->path,
                            'title' => $image->title,
                            'caption' => $image->alt
                        );
                    }
                }

                $sitemap_medicine_adaptive->add(URL::to('/preparat/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily', $images);
            }
        });

        $sitemap_medicine_adaptive->store('xml', 'sitemap-medicine-adaptive');
        $sitemap_medicine_adaptive->model->resetItems();;
        //        UA Adaptive

        $sitemap_medicine_ua_adaptive = App::make("sitemap");

        Uamedicinemap::with('image')->chunk(500, function ($medicines) use ($sitemap_medicine_ua_adaptive) {
            foreach ($medicines as $medicine) {
                $images = array();
                if (!empty($medicine->image && $medicine->image->isNotEmpty())) {
                    foreach ($medicine->image as $image) {
                        $images[] = array(
                            'url' => asset('/asset/images/medicine/main_aukr') . '/' . $image->path,
                            'title' => $image->title,
                            'caption' => $image->alt
                        );
                    }
                }

                $sitemap_medicine_ua_adaptive->add(URL::to('/ua/preparat/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily', $images);
            }
        });

        $sitemap_medicine_ua_adaptive->store('xml', 'sitemap-medicine-ua-adaptive');
        $sitemap_medicine_ua_adaptive->model->resetItems();;
//    medicines
//        ATX
        $sitemap_atx = App::make("sitemap");
        $sitemap_atx_ua = App::make("sitemap");

        Classification::select('class')->chunk(500, function ($medicines) use ($sitemap_atx, $sitemap_atx_ua) {
            foreach ($medicines as $medicine) {

                $sitemap_atx->add(URL::to('/sort/atx/' . $medicine->class),
                    $medicine->updated_at, '1.0', 'daily');
                $sitemap_atx_ua->add(URL::to('/ua/sort/atx/' . $medicine->class),
                    $medicine->updated_at, '1.0', 'daily');
            }
        });

        $sitemap_atx->store('xml', 'sitemap-atx');
        $sitemap_atx_ua->store('xml', 'sitemap-atx-ua');

        $sitemap_atx->model->resetItems();;
        $sitemap_atx_ua->model->resetItems();;
//        ATX
//        Substance
        $sitemap_substance = App::make("sitemap");
        $sitemap_substance_ua = App::make("sitemap");

        Substance::select('alias')->chunk(500, function ($medicines) use ($sitemap_substance, $sitemap_substance_ua) {
            foreach ($medicines as $medicine) {

                $sitemap_substance->add(URL::to('/sort/veshestvo/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
                $sitemap_substance_ua->add(URL::to('/ua/sort/veshestvo/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
            }
        });

        $sitemap_substance->store('xml', 'sitemap-substance');
        $sitemap_substance_ua->store('xml', 'sitemap-substance-ua');

        $sitemap_substance->model->resetItems();;
        $sitemap_substance_ua->model->resetItems();;
//        Substance
//        MNN
        $sitemap_mnn = App::make("sitemap");
        $sitemap_mnn_ua = App::make("sitemap");

        Innname::select('alias')->chunk(500, function ($medicines) use ($sitemap_mnn, $sitemap_mnn_ua) {
            foreach ($medicines as $medicine) {

                $sitemap_mnn->add(URL::to('/sort/mnn/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
                $sitemap_mnn_ua->add(URL::to('/ua/sort/mnn/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
            }
        });

        $sitemap_mnn->store('xml', 'sitemap-mnn');
        $sitemap_mnn_ua->store('xml', 'sitemap-mnn-ua');

        $sitemap_mnn->model->resetItems();;
        $sitemap_mnn_ua->model->resetItems();;
//        MNN
//        pharmgroup
        $sitemap_pharmgroup = App::make("sitemap");
        $sitemap_pharmgroup_ua = App::make("sitemap");

        Pharmagroup::select('alias')->chunk(500, function ($medicines) use ($sitemap_pharmgroup, $sitemap_pharmgroup_ua) {
            foreach ($medicines as $medicine) {

                $sitemap_pharmgroup->add(URL::to('/sort/farm-gruppa/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
                $sitemap_pharmgroup_ua->add(URL::to('/ua/sort/farm-gruppa/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
            }
        });

        $sitemap_pharmgroup->store('xml', 'sitemap-pharmgroup');
        $sitemap_pharmgroup_ua->store('xml', 'sitemap-pharmgroup-ua');

        $sitemap_pharmgroup->model->resetItems();;
        $sitemap_pharmgroup_ua->model->resetItems();;
//        pharmgroup
//        fabricator
        $sitemap_fabricator = App::make("sitemap");
        $sitemap_fabricator_ua = App::make("sitemap");

        Fabricator::select('alias')->chunk(500, function ($medicines) use ($sitemap_fabricator, $sitemap_fabricator_ua) {
            foreach ($medicines as $medicine) {

                $sitemap_fabricator->add(URL::to('/sort/proizvoditel/N/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
                $sitemap_fabricator_ua->add(URL::to('/ua/sort/proizvoditel/N/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
            }
        });

        $sitemap_fabricator->store('xml', 'sitemap-fabricator');
        $sitemap_fabricator_ua->store('xml', 'sitemap-fabricator-ua');

        $sitemap_fabricator->model->resetItems();;
        $sitemap_fabricator_ua->model->resetItems();;
//        fabricator

    }

    /**
     *
     */
    public function index()
    {
        ini_set('max_execution_time', 360);

//    Articles
//        RU
        $sitemap_article = App::make("sitemap");
        $posts = Article::where('approved', 1)
            ->with('image')->orderBy('updated_at', 'desc')->get();
        foreach ($posts as $post) {
            // get all images for the current post
            $images = array();

            $images[] = array(
                'url' => asset('/asset/images/articles/ru/main') . '/' . $post->image->path,
                'title' => $post->image->title,
                'caption' => $post->image->alt
            );

            $sitemap_article->add(URL::to('fresh-articles/' . $post->alias), $post->updated_at, '1.0', 'daily', $images);

        }

        $sitemap_article->store('xml', 'sitemap-articles');
        $sitemap_article->model->resetItems();;
//        UA
        $sitemap_ua_article = App::make("sitemap");
        $posts_ua = UArticle::where('approved', 1)
            ->with('image')->orderBy('updated_at', 'desc')->get();

        foreach ($posts_ua as $post_ua) {
            // get all images for the current post
            $ua_images = array();

            $ua_images[] = array(
                'url' => asset('/asset/images/articles/ua/main') . '/' . $post_ua->image->path,
                'title' => $post_ua->image->title,
                'caption' => $post_ua->image->alt
            );

            $sitemap_ua_article->add(URL::to('ua/fresh-articles/' . $post_ua->alias), $post_ua->updated_at, '1.0', 'daily', $ua_images);

        }

        $sitemap_ua_article->store('xml', 'sitemap-articles-ua');
        $sitemap_ua_article->model->resetItems();;
//        Cats
        $sitemap_categories = App::make("sitemap");
        $sitemap_categories_ua = App::make("sitemap");

        Category::select('alias')->chunk(500, function ($medicines) use ($sitemap_categories, $sitemap_categories_ua) {
            foreach ($medicines as $medicine) {

                $sitemap_categories->add(URL::to('/fresh-articles/cat/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
                $sitemap_categories_ua->add(URL::to('/ua/fresh-articles/cat/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
            }
        });

        $sitemap_categories->store('xml', 'sitemap-categories');
        $sitemap_categories_ua->store('xml', 'sitemap-categories-ua');
//        Cats
//        Tags
        $sitemap_tags = App::make("sitemap");
        $sitemap_tags_ua = App::make("sitemap");

        Tag::select('alias')->chunk(500, function ($medicines) use ($sitemap_tags, $sitemap_tags_ua) {
            foreach ($medicines as $medicine) {

                $sitemap_tags->add(URL::to('/fresh-articles/teg/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
                $sitemap_tags_ua->add(URL::to('/ua/fresh-articles/teg/' . $medicine->alias),
                    $medicine->updated_at, '1.0', 'daily');
            }
        });

        $sitemap_tags->store('xml', 'sitemap-tags');
        $sitemap_tags_ua->store('xml', 'sitemap-tags-ua');
//        tags
//    Articles
//static =========================================>
        $sitemap_main = App::make("sitemap");

        $sitemap_main->add(URL::to('/'), date('Y-m-d 00:00:00'), '0.6', 'daily');
        $sitemap_main->add(URL::to('/ua'), date('Y-m-d 00:00:00'), '0.6', 'daily');
//        About
        $about_update = Cache::store('file')->rememberForever('abouts_update_1', function () {
            $date = About::select('updated_at')->where('id', 1)->first();
            return $date->updated_at;
        });;
        $sitemap_main->add(URL::to('onas'), $about_update, '0.8', 'monthly');

        $about_update_ua = Cache::store('file')->rememberForever('abouts_update_2', function () {
            $date = About::select('updated_at')->where('id', 2)->first();
            return $date->updated_at;
        });;
        $sitemap_main->add(URL::to('ua/onas'), $about_update_ua, '0.8', 'monthly');
//        About
//        ADV
        $adv = Cache::store('file')->rememberForever('adv', function () {
            $date = Adv::select('updated_at')->max('updated_at');
            return $date;
        });;
        $sitemap_main->add(URL::to('reklama'), $adv, '0.8', 'monthly');
        $sitemap_main->add(URL::to('ua/reklama'), $adv, '0.8', 'monthly');
//        ADV


        $sitemap_main->store('xml', 'sitemap-main');

//static =========================================>
//        MAIN
        $sitemap = App::make("sitemap");

        $sitemap->addSitemap(URL::to('sitemap-articles.xml'));
        $sitemap->addSitemap(URL::to('sitemap-articles-ua.xml'));
        $sitemap->addSitemap(URL::to('sitemap-categories.xml'));
        $sitemap->addSitemap(URL::to('sitemap-categories-ua.xml'));
        $sitemap->addSitemap(URL::to('sitemap-tags.xml'));
        $sitemap->addSitemap(URL::to('sitemap-tags-ua.xml'));

        $sitemap->addSitemap(URL::to('sitemap-medicine.xml'));
        $sitemap->addSitemap(URL::to('sitemap-medicine-ua.xml'));
        $sitemap->addSitemap(URL::to('sitemap-medicine-adaptive.xml'));
        $sitemap->addSitemap(URL::to('sitemap-medicine-ua-adaptive.xml'));
        $sitemap->addSitemap(URL::to('sitemap-medicine-analog.xml'));
        $sitemap->addSitemap(URL::to('sitemap-medicine-analog-ua.xml'));
        $sitemap->addSitemap(URL::to('sitemap-medicine-faq.xml'));
        $sitemap->addSitemap(URL::to('sitemap-medicine-faq-ua.xml'));

        $sitemap->addSitemap(URL::to('sitemap-atx.xml'));
        $sitemap->addSitemap(URL::to('sitemap-atx-ua.xml'));

        $sitemap->addSitemap(URL::to('sitemap-substance.xml'));
        $sitemap->addSitemap(URL::to('sitemap-substance-ua.xml'));

        $sitemap->addSitemap(URL::to('sitemap-mnn.xml'));
        $sitemap->addSitemap(URL::to('sitemap-mnn-ua.xml'));

        $sitemap->addSitemap(URL::to('sitemap-pharmgroup.xml'));
        $sitemap->addSitemap(URL::to('sitemap-pharmgroup-ua.xml'));

        $sitemap->addSitemap(URL::to('sitemap-fabricator.xml'));
        $sitemap->addSitemap(URL::to('sitemap-fabricator-ua.xml'));

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
}
