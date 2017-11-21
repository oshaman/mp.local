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
                return (($model->title !== $input->title) && !empty($input->title));
            }

            return !empty($input->title);
        });
        $validator->sometimes('utitle', 'unique:categories,utitle', function ($input) {
            if ($this->route()->hasParameter('cat') && $this->isMethod('post')) {
                $model = $this->route()->parameter('cat');

                if (null === $model) return true;
                return (($model->utitle !== $input->utitle) && !empty($input->utitle));
            }

            return !empty($input->utitle);
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
            ];
            return $rules;
        }

        return [
            //
        ];
    }
}
