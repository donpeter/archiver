<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         $user = $this->user();
        //dd($user);
        if($user->role === 'admin'){
            return true;
        }else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|min:3',
            'email' => 'required|email|unique:users|max:255|min:5',
            'username' => 'required|string|unique:users|max:255|min:3',
            'password' => 'required|string|unique:users|max:255|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
            'role' => 'required|string|max:6|min:4',

        ];
    }
}
