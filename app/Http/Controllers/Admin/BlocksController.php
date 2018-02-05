<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Repositories\BlockRepository;
use Illuminate\Http\Request;
use Gate;

class BlocksController extends AdminController
{
    protected $rep;

    public function __construct(BlockRepository $blockRepository)
    {
        $this->rep = $blockRepository;
    }

    public function updateBlocks(Request $request, $block = null)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            $result = $this->rep->updateBlock($request, $block);

            if (is_array($result) && !empty($result['error'])) {
                return redirect()->back()->withErrors($result['error']);
            }
            return back()->with(['status' => 'Данные обновлены.']);
        }

        $this->title = 'Редактирование блоков главной страницы';

        $this->template = 'admin.admin';
        $this->mark = 'main_admin';
        $blocks = $this->rep->get();
        $this->content = view('admin.main.blocks')->with(['blocks' => $blocks])->render();
        return $this->renderOutput();
    }
}
