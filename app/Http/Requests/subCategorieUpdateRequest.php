<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class subCategorieUpdateRequest extends FormRequest
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
            'categorie' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'Nome da Subcategoria é obrigatório',
            'categorie.required' => 'A Categoria é Obrigatória'
        ];
    }
}
