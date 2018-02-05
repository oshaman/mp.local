<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\MedtagsRepository;
use Illuminate\Http\Request;
use Gate;

class MedtagController extends AdminController
{
    /**
     * MedtagController constructor.
     * @param MedtagsRepository $rep
     */
    public function __construct(MedtagsRepository $rep)
    {
        $this->tag_rep = $rep;
        $this->template = 'admin.admin';
    }

    /**
     * @param TagsRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function store(Request $request)
    {
        if (Gate::denies('TAGS_ADMIN')) {
            abort(404);
        }

        if ($request->isMethod('post')) {

            $result = $this->tag_rep->addTag($request);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error']);
            }
            return back()->with(['status' => 'Данные обновлены.']);

        }

        $tags = $this->tag_rep->get(['alias', 'id'], false, 25);

        $this->content = view('admin.main.tags.content')->with('tags', $tags)->render();
        $this->title = 'TAGS';
        $this->mark = 'main_admin';

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
        return redirect()->route('med_tags_admin')->with($result);

    }
}
