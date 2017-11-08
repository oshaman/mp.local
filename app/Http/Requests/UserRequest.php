<?php

namespace Fresh\Medpravda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('USERS_ADMIN');
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('password', 'required|min:6|confirmed', function ($input) {

            if ($this->isMethod('get')) return false;

            if (!empty($input->password) || ((empty($input->password) && $this->route()->getName() !== 'users_update'))) {
                return true;
            }

            return false;
        });

        $validator->sometimes('name', 'required|min:4|alpha_dash', function ($input) {

            if ($this->isMethod('get')) return false;

            if (($this->route()->getName() == 'users_create') || ($this->route()->getName() == 'users_update')) {
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
        $id = (isset($this->route()->parameter('user')->id)) ? $this->route()->parameter('user')->id . ',id' : '';
        if ($this->isMethod('post')) {
            return [
                'role' => 'required|integer',
                'email' => 'required|email|max:255|unique:users,email,' . $id
            ];
        }
        return [];
    }
}
