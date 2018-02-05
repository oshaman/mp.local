<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\TagsRequest;
use Fresh\Medpravda\Repositories\TagsRepository;
use Gate;

class TagsController extends AdminController
{
    /**
     * TagsController constructor.
     * @param TagsRepository $rep
     */
    public function __construct(TagsRepository $rep)
    {
        $this->tag_rep = $rep;
        $this->template = 'admin.admin';
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
        $this->mark = 'articles_admin';
    }

    /**
     * @param TagsRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function store(TagsRequest $request)
    {
        if (Gate::denies('TAGS_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->tag_rep->addTag($request);

            if ($result) {
                return back()->with(['status' => 'Новый тэг добавлен.']);
            } else {

                return redirect()->back()->withErrors(['message' => 'Ошибка добавления тэга, повторите попытку позже.']);
            }

        }

        $tags = $this->tag_rep->get(['name', 'uname', 'id', 'alias', 'approved'], false, 25);

        $this->content = view('admin.tags.content')->with('tags', $tags)->render();
        $this->title = 'TAGS';

        return $this->renderOutput();
    }

    /**
     * Tag update
     * @param Request $request
     * @param $tag tag_id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function edit(TagsRequest $request, $tag)
    {
        if (Gate::denies('TAGS_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->tag_rep->updateTag($request, $tag);
            if ($result) {
                return redirect()->route('tags_admin')->with(['status' => 'Тэг обновлен.']);
            } else {

                return redirect()->back()->withErrors(['message' => 'Ошибка изменения тэга, повторите попытку позже.']);
            }
        }

        $tag->seo = $this->tag_rep->convertSeo($tag->seo);
        $tag->useo = $this->tag_rep->convertSeo($tag->useo);
//        dd($tag);
        $this->content = view('admin.tags.edit')->with('tag', $tag);
        return $this->renderOutput();
    }

    /**
     * @param $tag
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($tag)
    {
        if (Gate::denies('TAGS_ADMIN')) {
            abort(404);
        }

        $result = $this->tag_rep->deleteTag($tag);
        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }
        return redirect()->route('tags_admin')->with($result);

    }
}
