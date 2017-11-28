<?php

namespace Fresh\Medpravda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Article extends FormRequest
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

        $validator->sometimes('alias', ['required', 'max:255', 'regex:#^[\w-]#', 'unique:articles,alias'], function ($input) {
//  bind article in RouteServiceProvider

            if (!$this->isMethod('post')) {
                return false;
            }

            if ($this->route()->hasParameter('spec') && ('ru' !== $this->route()->parameter('spec'))) {
                return false;
            }

            if ($this->route()->hasParameter('article_id')) {
                $model = \Fresh\Medpravda\Article::where('id', $this->route()->parameter('article_id'))->first();
                if (null === $model) return true;
                return ($model->alias !== $input->alias);
            }

            return true;
        });

        $validator->sometimes('category_id', ['digits_between:1,4', 'nullable', 'required'], function ($input) {
            if (!$this->isMethod('post')) {
                return false;
            }
            if ($this->route()->hasParameter('spec') && ('ru' !== $this->route()->parameter('spec'))) {
                return false;
            }
            return true;

        });

        $validator->sometimes('img', 'mimes:jpg,bmp,png,jpeg|max:5120', function ($input) {
//  bind article in RouteServiceProvider
            if ($this->route()->named('create_article') && $this->isMethod('post')) {
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
                'title' => ['required', 'string', 'between:4,255'],

                'tags' => 'array',
                'img' => 'mimes:jpg,bmp,png,jpeg|max:5120',
                'imgalt' => ['string', 'nullable'],
                'imgtitle' => ['string', 'nullable'],
                'content' => 'string|nullable',

                'seo_title' => 'string|nullable',
                'seo_keywords' => 'string|nullable',
                'seo_description' => 'string|nullable',
                'seo_text' => 'string|nullable',
                'og_image' => 'string|nullable',
                'og_title' => 'string|nullable',
                'og_description' => 'string|nullable',

                'approved' => 'boolean|nullable',
                'outputtime' => 'date_format:"Y-m-d H:i"|nullable',
                'view' => ['digits_between:1,10', 'nullable', 'max:4294967295'],
            ];

            if ($this->request->has('tags')) {
                foreach ($this->request->get('tags') as $key => $val) {
                    $rules['tags.' . $key] = ['digits_between:1,10', 'nullable', 'exists:tags,id'];
                }
            }
            return $rules;

        } else {
            $rules = [
                'value' => ['nullable', 'string', 'between:1,255', 'regex:#^[a-zA-zа-яА-ЯёЁ0-9\-\s\,\:\?\!\.]+$#u'],
                'param' => 'nullable|digits:1',
            ];
            return $rules;
        }
    }

    public function messages()
    {
        return [
            'tags.*.*' => 'Недопустимые символы в поле Теги',
        ];
    }
}
