<?php

namespace Fresh\Medpravda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cats extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo();
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', 'required|unique:categories,alias|max:255|alpha_dash', function ($input) {
            if ($this->route()->hasParameter('cat') && $this->isMethod('post')) {
                $model = $this->route()->parameter('cat');
                if (null === $model) return true;

                return (($model->alias !== $input->alias) && !empty($input->alias));
            }

            return !empty($input->alias);
        });

        $validator->sometimes('title', 'unique:categories,title', function ($input) {
            if ($this->route()->hasParameter('cat') && $this->isMethod('post')) {
                $model = $this->route()->parameter('cat');

                if (null === $model) return true;
                return ((mb_strtolower($model->title) !== mb_strtolower($input->title)) && !empty($input->title));
            }

            return empty($input->title);
        });
        $validator->sometimes('utitle', 'unique:categories,utitle', function ($input) {
            if ($this->route()->hasParameter('cat') && $this->isMethod('post')) {
                $model = $this->route()->parameter('cat');

                if (null === $model) return true;
                return ((mb_strtolower($model->utitle) !== mb_strtolower($input->utitle)) && !empty($input->utitle));
            }

            return empty($input->utitle);
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
                'title' => ['required', 'between:5, 32', 'string'],
                'utitle' => ['required', 'between:5, 32', 'string'],

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
