<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:client',
            'password' => 'required|max:255',
            'confirm_password' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do cliente é obrigatório',
            'name.max:255' => 'Nome do cliente não pode exceder os 255 caracteres',
            'email.required' => 'Email do cliente é obrigatório',
            'email.max:255' => 'Email do cliente não pode exceder os 255 caracteres',
            'email.unique' => 'O email digitado já está em uso no nosso sistema! Tente outro',
            'password.required' => 'A senha é obrigatória',
            'password.max:255' => 'A senha não pode exceder os 255 caracteres',
            'confirm_password.required' => 'É obrigatório repetir a senha',
            'confirm_password.max:255' => 'A senha não pode exceder os 255 caracteres',
        ];
    }
}
