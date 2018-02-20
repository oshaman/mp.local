<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Category;
use Fresh\Medpravda\Http\Requests\Article as Request;
use Fresh\Medpravda\Repositories\ArticlesRepository;
use Fresh\Medpravda\Repositories\CategoriesRepository;
use Fresh\Medpravda\Repositories\TagsRepository;
use Fresh\Medpravda\Repositories\UarticlesRepository;
use Fresh\Medpravda\Tag;
use Gate;

class ArticlesController extends AdminController
{
    protected $ru_rep;
    protected $ua_rep;

    public function __construct(ArticlesRepository $rep, UarticlesRepository $uarticlesRepository)
    {
        $this->template = 'admin.admin';
        $this->ru_rep = $rep;
        $this->ua_rep = $uarticlesRepository;
        $this->mark = 'articles_admin';
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $this->title = 'Редактирование статей';
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }
        /*==========================================================================================*/
        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 2:
                    $articles[] = $this->ru_rep->one($data['value']);
                    break;
                case 1:
                    $articles = $this->ru_rep->get('*', false, 25,
                        ['title' => $data['value']], false, ['category']);
                    break;
                case 3:
                    $articles = $this->ru_rep->get('*',
                        false, 25, ['approved' => 0], ['created_at', 'desc'], ['category']);
                    if ($articles) $articles->appends(['param' => $data['param']])->links();
                    break;
                default:
                    $articles = $this->ru_rep->get('*',
                        false, 25, ['approved' => 0], ['created_at', 'desc'], ['category']);
                    if ($articles) $articles->appends(['param' => $data['param']])->links();
            }
        } else {
            $articles = $this->ru_rep->get('*', false, 25, ['approved' => 1],
                ['created_at', 'desc'], ['category']);
        }

        $this->content = view('admin.articles.show')->with(['articles' => $articles])->render();

        return $this->renderOutput();

        /*==========================================================================================*/

    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function create(Request $request)
    {
        $this->title = 'Добавление статьи';

        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        $this->jss = '
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
        $this->tiny = true;

        if ($request->isMethod('post')) {

            $result = $this->ru_rep->addArticle($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->route('edit_article', ['spec' => 'ru', 'article' => $result['id']])->with($result);
        }

        $cats = new CategoriesRepository(new Category);
        $lists = $cats->catSelect();

        $tags = new TagsRepository(new Tag);
        $tag = $tags->tagSelect();

        $spec = 'ru';
        $articles = null;


        $this->content = view('admin.articles.add')
            ->with(['articles' => $articles, 'spec' => $spec, 'cats' => $lists, 'tags' => $tag])
            ->render();

        return $this->renderOutput();

    }

    /**
     * @param Request $request
     * @param $spec
     * @param $article
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(Request $request, $spec, $article)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

//        dd($article);

        if ($request->isMethod('post')) {

            $result = $this->{$spec . '_rep'}->updateArticle($request, $article);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withInput()->withErrors($result);
            }
            return redirect()->back()->with($result);
        }

        $this->title = 'Редактирование статьи:';
        $this->template = 'admin.admin';
        $this->tiny = true;

        $article = $this->{$spec . '_rep'}->findById($article);
        if (empty($article)) {
            abort(404);
        }

        $article->seo = $this->{$spec . '_rep'}->convertSeo($article->seo);
        $article->load('image');

//dd($article);
//  get categories
        $cats = new CategoriesRepository(new Category);
        $lists = $cats->catSelect();

        $tags = new TagsRepository(new Tag);
        $tag = $tags->tagSelect();

        $this->content = view('admin.articles.edit')
            ->with(['article' => $article, 'spec' => $spec, 'cats' => $lists, 'tags' => $tag])
            ->render();

        return $this->renderOutput();

    }

    /**
     * @param $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function del($article)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        $result = $this->ru_rep->deleteArticle($article);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('articles_admin')->with($result);
    }
}
