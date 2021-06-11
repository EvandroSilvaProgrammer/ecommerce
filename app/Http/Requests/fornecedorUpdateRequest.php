<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class fornecedorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'province' => 'required',
            'district' => 'required',
            'street' => 'required|max:255',
            'neighborhood' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do livro é obrigatório',
            'name.max:255' => 'Nome do livro não pode exceder os 255 caracteres',
            'province.required' => 'Nome da província obrigatório',
            'district.required' => 'Nome da província obrigatório',
            'street.required' => 'Nome da Rua é obrigatório',
            'neighborhood.required' => 'Nome do livro é obrigatório',
        ];
    }
}
