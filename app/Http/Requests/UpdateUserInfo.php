<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'third_name' => 'required|max:255',
            'username' => 'required|max:255',
            'type' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
