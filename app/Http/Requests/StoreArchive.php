<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArchive extends FormRequest
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
        if($user->username == 'admin' || ($user->type) >= 2 )
         return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ref' => 'required|unique:archives|max:20|min:5',
            'name' => 'required|max:255',
        ];
    }
}
