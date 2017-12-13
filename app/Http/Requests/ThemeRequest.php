<?php

namespace Fresh\Medpravda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemeRequest extends FormRequest
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

        $validator->sometimes('img', 'required|mimes:jpg,bmp,png,jpeg|max:5120', function ($input) {

            if ($this->route()->named('themes_add') && $this->isMethod('post')) {
                return true;
            }

            return false;
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
                'description' => 'required|string|between:3,255',
                'title' => 'required|string|between:3,255',
                'link' => 'required|url|between:3,255',

                'img' => 'mimes:jpg,bmp,png,jpeg|max:5120',
                'alt' => 'nullable|string|between:,255',
                'imgtitle' => 'nullable|string|between:,255',
                'approved' => 'boolean|nullable',
                'priority' => ['numeric', 'max:255', 'nullable'],
                'loc' => ['required', 'digits_between:1,2'],

            ];
            return $rules;
        } else {
            $rules = [
                'value' => ['nullable', 'string', 'between:1,255', 'regex:#^[a-zA-zа-яА-ЯёЁ0-9\-\s\,\:\?\!\.]+$#u'],
            ];
            return $rules;
        }
    }
}
