<?php

namespace Fresh\Medpravda\Http\Requests;

use Fresh\Medpravda\Medicine;
use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('UPDATE_MEDICINE');
    }

    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', ['required', 'max:255', 'regex:#^[\w-]#', 'unique:medicines,alias'], function ($input) {
//  bind article in RouteServiceProvider

            if ($this->route()->named('medicine_create') && $this->isMethod('post')) return true;
            if ($this->route()->hasParameter('medicine') && $this->isMethod('post')
                && $this->route()->hasParameter('spec') && ('ru' == $this->route()->parameter('spec'))) {
                $model = Medicine::where('alias', $this->route()->parameter('medicine'))->first();
                if (null === $model) return true;
                return $model->alias !== $input->alias;
            }

            if ($this->isMethod('post') && 'medicine_create' == $this->route()->getName()) {
                return true;
            }

            return !empty($input->alias);
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            $rules = [
//                'alias' => 'required',
                'title' => ['required', 'string', 'between:4,255'],
                'reg' => ['nullable', 'string', 'between:4,255'],
                'dose' => ['nullable', 'string', 'between:4,255'],

                'slider' => 'array',
                'slider.*' => 'mimes:jpg,png,jpeg|max:5120',

                'imgalt' => 'array',
                'imgalt.*' => 'string|nullable',
                'imgtitle' => 'array',
                'imgtitle.*' => 'string|nullable',


//                content
                'consist' => 'string|nullable|between:4,65530',
                'docs_form' => 'string|nullable|between:4,65530',
                'physicochemical_char' => 'string|nullable|between:4,65530',
                'fabricator' => 'string|nullable|between:4,65530',
                'addr_fabricator' => 'string|nullable|between:4,65530',
                'pharm_group' => 'string|nullable|between:4,16777214',
                'indications' => 'string|nullable|between:4,16777214',
                'pharm_prop' => 'string|nullable|between:4,16777214',
                'contraindications' => 'string|nullable|between:4,65530',
                'security' => 'string|nullable|between:4,65530',
                'application_features' => 'string|nullable|between:4,16777214',
                'pregnancy' => 'string|nullable|between:4,65530',
                'cars' => 'string|nullable|between:4,65530',
                'children' => 'string|nullable|between:4,65530',
                'app_mode' => 'string|nullable|between:4,16777214',
                'overdose' => 'string|nullable|between:4,65530',
                'side_effects' => 'string|nullable|between:4,16777214',
                'shelf_life' => 'string|nullable|between:4,65530',
                'saving' => 'string|nullable|between:4,65530',
                'packaging' => 'string|nullable|between:4,65530',
                'leave_cat' => 'string|nullable|between:4,65530',
                'interaction' => 'string|nullable|between:4,16777214',
                'additionally' => 'string|nullable|between:4,16777214',

//                content

                'seo_title' => 'string|nullable',
                'seo_keywords' => 'string|nullable',
                'seo_description' => 'string|nullable',
                'seo_text' => 'string|nullable',
                'og_image' => 'string|nullable',
                'og_title' => 'string|nullable',
                'og_description' => 'string|nullable',

                'approved' => 'boolean|nullable',
                'backcolor' => ['string', 'size:6', 'nullable'],
                'form_id' => 'digits_between:1,10|max:4294967295',
                'classification_id' => 'digits_between:1,10|max:4294967295',
                'pharmagroup_name_id' => 'digits_between:1,10|max:4294967295',
                'fabricator_name_id' => 'digits_between:1,10|max:4294967295',
                'innname_id' => 'digits_between:1,10|max:4294967295',
            ];

            if ($this->request->has('slider')) {
                foreach ($this->request->get('slider') as $key => $val) {
                    $rules['slider' . $key] = 'mimes:jpg,png,jpeg|max:5120';
                }
            }

            return $rules;

        } else {
            $rules = [
                'value' => ['nullable', 'string', 'between:1,255', 'regex:#^[a-zA-zа-яА-ЯёЁ0-9\(\)\-\s\,\:\?\!\.]+$#u'],
                'param' => 'nullable|digits:1',
            ];
            return $rules;
        }
    }

    public function messages()
    {
        return [
            'slider.*.*' => 'В полях СЛАЙДЕРА должны быть файлы в формате "jpg,bmp,png,jpeg" не более 5120 байт',
            'imgalt.*.*' => 'Ошибка при заполнении Alt картинки',
            'imgtitle.*.*' => 'Ошибка при заполнении Title картинки',

        ];
    }
}
