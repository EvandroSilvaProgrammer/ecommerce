<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
        // return [
        //     'name' => 'required|max:255',
        //     'subcategorie' => 'required',
        //     'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        //     'discount' => 'min:0';
        //     'qtd' => 'required|min:0',
        //     'description' => 'required',
        //     'brand' => 'required',
        //     'image' => 'image|required|',
        // ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome do livro é obrigatório',
            'name.max:255' => 'Nome do livro não pode exceder os 255 caracteres',
            'price.required' => 'Preço do livro é obrigatório',
            'qtd.required' => 'Quantidade do livro é obrigatória',
            'description.required' => 'Descrição do livro é obrigatória',
            'details.required' => 'Detalhes do livro é obrigatório',
            'image.image' => 'O ficheiro de imagem tem de ser um ficheiro de imagem válido',
            'image.required' => 'A imagem é obrigatória'
        ];
    }
}
