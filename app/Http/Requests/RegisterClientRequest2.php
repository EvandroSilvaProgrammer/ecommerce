<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterClientRequest2 extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'telephone' => 'required|max:255',
            'province' => 'required|max:255',
            'district' => 'required|max:255',
            'neighborhood' => 'required|max:255',
            'street' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'telephone.required' => 'Telefone é obrigatório',
            'province.required' => 'Província é obrigatória',
            'district.required' => 'Município é obrigatório',
            'neighborhood.required' => 'Bairro é obrigatório',
            'street.required' => 'Rua é obrigatória',
        ];
    }
}
