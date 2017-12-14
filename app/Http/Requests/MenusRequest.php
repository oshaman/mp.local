<?php

namespace Fresh\Medpravda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('UPDATE_ARTICLES');
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
                'cats' => 'array',
                'ua_cats' => 'array',
            ];

            if ($this->request->has('cats')) {
                foreach ($this->request->get('cats') as $key => $val) {
                    $rules['cats.' . $key] = ['numeric', 'nullable'];
                }

            }

            if ($this->request->has('ua_cats')) {
                foreach ($this->request->get('ua_cats') as $key => $val) {
                    $rules['ua_cats.' . $key] = ['numeric', 'nullable'];
                }

            }

            return $rules;

        }
        return [
            //
        ];
    }

    public function messages()
    {
        return [
            'cats.*.*' => 'Недопустимые символы в поле Категории пациентов',
            'ua_cats.*.*' => 'Недопустимые символы в поле Категории врачей',
        ];
    }
}
