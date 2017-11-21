<?php

namespace Fresh\Medpravda\Http\Controllers\Admin;

use Fresh\Medpravda\Http\Requests\MedicineRequest;
use Fresh\Medpravda\Repositories\MedicineRepository;
use Fresh\Medpravda\Repositories\UmedicineRepository;
use Gate;
use Illuminate\Http\Request;
use Validator;

class MedicineController extends AdminController
{
    protected $ru_rep;
    protected $ua_rep;

    public function __construct(MedicineRepository $medicineRepository, UmedicineRepository $ua_rep)
    {
        $this->ru_rep = $medicineRepository;
        $this->ua_rep = $ua_rep;
        $this->jss = '
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                <script src="' . asset('js/translate.js') . '"></script>
            ';
    }


    public function index(MedicineRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        $data = $request->except('_token');
        if (!empty($data['param'])) {
            $data['value'] = $data['value'] ?? null;
            switch ($data['param']) {
                case 1:
                    $drugs[] = $this->ru_rep->one($data['value']);
                    break;
                case 2:
                    $drugs = $this->ru_rep->get(['title', 'id', 'alias'], false, 25, ['title' => $data['value']]);
                    if ($drugs) $drugs->appends(['param' => $data['param']])->links();
                    break;
                default:
                    $drugs = $this->ru_rep->get(['alias', 'title', 'id'], false, 25, ['approved' => 0]);
                    if ($drugs) $drugs->appends(['param' => $data['param']])->links();
            }
        } else {
            $drugs = $this->ru_rep->get(['alias', 'title', 'id'], false, 25, ['approved' => 1]);
        }

        $this->title = 'Преператы';
        $this->template = 'admin.admin';

        $this->content = view('admin.medicine.content')->with('drugs', $drugs)->render();

        return $this->renderOutput();
    }

    /**
     * @param MedicineRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function create(MedicineRequest $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
//            dd($request);

            $result = $this->ru_rep->createMedicine($request);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->route('edit', ['spec' => 'ru', 'medicine' => $result['alias']])->with($result);

        }

        $this->title = 'Создание препарата';

        $this->template = 'admin.admin';
        $this->tiny = true;
        $this->content = view('admin.medicine.create')->render();

        return $this->renderOutput();
    }

    /**
     * @param $medicine
     */
    public function del($medicine)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        echo $medicine;
    }

    /**
     * @param MedicineRequest $request
     * @param $spec
     * @param $medicine
     * @return $this|\Illuminate\Http\RedirectResponse|mixed
     */
    public function edit(MedicineRequest $request, $spec, $medicine)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        if ($request->isMethod('post')) {
//            dd($request);

            $result = $this->{$spec . '_rep'}->updateMedicine($request, $medicine);

            if (is_array($result) && !empty($result['error'])) {
                return back()->withErrors($result);
            }
            return redirect()->back()->with($result);

        }

        $this->title = 'Редактирование препарата:';
        $this->template = 'admin.admin';
        $this->tiny = true;

        $drug = $this->{$spec . '_rep'}->one($medicine);
        if (empty($drug)) {
            abort(404);
        }

        $drug->seo = $this->{$spec . '_rep'}->convertSeo($drug->seo);
        $drug->load('image');
        $drug->load('classification');
        $drug->load('fabricator_name');
        $drug->load('form');
        $drug->load('innname');
        $drug->load('pharmagroup');
//dd($drug);

        $this->content = view('admin.medicine.edit')->with(['drug' => $drug, 'spec' => $spec])->render();

        return $this->renderOutput();

    }

    /**
     * @param $spec
     * @param $medicine
     * @return mixed
     */
    public function faq($spec, $medicine)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        $this->title = 'Редактирование частых вопросов';
        $this->template = 'admin.admin';
        $this->tiny = true;

        $drug = $this->{$spec . '_rep'}->one($medicine);
        if (empty($drug)) {
            abort(404);
        }

//        dd($drug);
        $this->content = view('admin.medicine.faq')->with(['drug' => $drug, 'spec' => $spec])->render();

        return $this->renderOutput();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function slider(Request $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }
        $validator = Validator::make($request->all(), [
            'slider_id' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return \Response::json(['error' => $validator->errors()->all()]);
        }

        switch ($request->get('spec')) {
            case 'ua':
                $spec = 'ua';
                break;
            case 'aua':
                $spec = 'aua';
                break;
            case 'aru':
                $spec = 'aru';
                break;
            default:
                $spec = 'ru';
        }

        $result = $this->{$spec . '_rep'}->delSlider($request->get('slider_id'));

        return \Response::json($result);
    }

    public function getCustom(Request $request)
    {
        if (Gate::denies('UPDATE_MEDICINE')) {
            abort(404);
        }

        $request->validate([
            'value' => ['string', 'between:1,255', 'regex:#^[a-zA-zа-яА-ЯёЁїі0-9\-\s\,\.]+$#u'],
            'source' => 'required',
        ]);

        $result = 'success';

        return \Response::json(['success' => $result]);

    }
}
