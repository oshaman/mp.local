<?php

namespace Fresh\Medpravda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('TAGS_ADMIN');
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', 'required|unique:tags,alias|max:64|alpha_dash', function ($input) {
            if ($this->route()->hasParameter('tag') && $this->isMethod('post')) {
                $model = $this->route()->parameter('tag');
                if (null === $model) return true;

                return (($model->alias !== $input->alias) && !empty($input->alias));
            }

            return !empty($input->alias);
        });

        $validator->sometimes('tag', 'unique:tags,name', function ($input) {
            if ($this->route()->hasParameter('tag') && $this->isMethod('post')) {
                $model = $this->route()->parameter('tag');
                if (null === $model) return true;
                return (($model->name !== $input->tag) && !empty($input->tag));
            }

            return !empty($input->tag);
        });

        $validator->sometimes('utag', 'unique:tags,uname', function ($input) {
            if ($this->route()->hasParameter('tag') && $this->isMethod('post')) {
                $model = $this->route()->parameter('tag');
                if (null === $model) return true;
                return (($model->uname !== $input->utag) && !empty($input->utag));
            }

            return !empty($input->utag);
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
                'tag' => ['required', 'between:3, 64', 'regex:#^[а-яА-ЯёЁ0-9\s-]+$#u'],
                'utag' => ['required', 'between:3, 64', 'regex:#^[а-яА-ЯёЁіІїЇiIЄє0-9\s-\']+$#u'],

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

                'approved' => 'boolean|nullable',
            ];
            return $rules;
        }

        return [
            //
        ];
    }
}
