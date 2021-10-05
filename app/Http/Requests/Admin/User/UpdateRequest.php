<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users,email'.$this->user_id,
            'user_id'=>'required|integer|exists:users,id',
            'role'=>'required|integer'
        ];
    }
    public function messages()
    {
        return[
       'name.required'=>'Это поле необходимо для заполнения',
           'name.string'=>'Имя должно быть строкй',
            'email.required'=>'Это поле необходимо для заполнения',
                'email.string'=>'Почта должна быть строкй',
        'email.email'=>'Почта должна соответстовать формату',
        'email.unique'=>'Пользователь уже существует',

        ];
    }
}
