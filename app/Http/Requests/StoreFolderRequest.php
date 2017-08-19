<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFolderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //dd($this->request);
        $user = $this->user();
        //dd($user);
        if($user->role == 'admin' || $user->role == 'staff'){
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
            'ref' => 'required|unique:folders|max:64|min:3',
            'name' => 'required|max:255',
        ];
    }
}
