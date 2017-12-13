<?php

namespace Fresh\Medpravda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtxRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            $rules = [
                'atx' => ['nullable', 'string', 'between:1,7', 'alpha_num'],

                'seo_title' => 'string|nullable',
                'seo_keywords' => 'string|nullable',
                'seo_description' => 'string|nullable',
                'seo_text' => 'string|nullable',
                'og_image' => 'string|nullable',
                'og_title' => 'string|nullable',
                'og_description' => 'string|nullable',

                'useo_title' => 'string|nullable',
                'useo_keywords' => 'string|nullable',
                'useo_description' => 'string|nullable',
                'useo_text' => 'string|nullable',
                'uog_image' => 'string|nullable',
                'uog_title' => 'string|nullable',
                'uog_description' => 'string|nullable',

            ];
            return $rules;
        }

        return [
            //
        ];
    }
}
