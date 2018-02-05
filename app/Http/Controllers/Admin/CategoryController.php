<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\CategoriesRepository;
use Fresh\Medpravda\Http\Requests\Cats;
use Gate;

class CategoryController extends AdminController
{

    protected $cat_rep;

    public function __construct(CategoriesRepository $rep)
    {
        $this->cat_rep = $rep;
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
        $this->mark = 'articles_admin';
    }

    public function show(Cats $request)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->cat_rep->addCat($request);

            if ($result) {
                return back()->with(['status' => 'Новая категория добавлена.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка добавления категории, повторите попытку позже.']);
            }

        }

        $this->template = 'admin.admin';
        $this->title = 'Редактирование категорий статей';

        $cats = $this->cat_rep->get(['title', 'utitle', 'id', 'alias'], false, true);
        $this->content = view('admin.cats.content')->with('categories', $cats);

        return $this->renderOutput();
    }

    public function edit(Cats $request, $cat)
    {
        if (Gate::denies('UPDATE_ARTICLES')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->cat_rep->updateCat($request, $cat);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error'])->withInput();
            }

            if ($result) {
                return redirect()->route('cats')->with(['status' => 'Категория обновлена.']);
            } else {
                return redirect()->back()->withErrors(['message' => 'Ошибка изменения категории, повторите попытку позже.']);
            }
        }

        $this->template = 'admin.admin';
        $this->title = 'Редактирование категории';

        $this->content = view('admin.cats.edit')->with('category', $cat);
        return $this->renderOutput();
    }

}
