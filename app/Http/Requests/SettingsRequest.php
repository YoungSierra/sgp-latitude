<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'name'   => 'required|string|max:20',
            'email'  => 'required|email',
            'bio'    => 'required|string|min:30|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|'
        ];
    }

    public function attributes()
    {
        return [
            'name'   => 'nombre',
            'email'  => 'correo',
            'bio'    => 'biografía',
            'avatar' => 'logo'
        ];
    }
}