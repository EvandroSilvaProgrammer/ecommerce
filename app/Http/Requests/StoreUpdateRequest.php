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
            'name.required' => 'Nome do produto é obrigatório',
            'name.max:255' => 'Nome do produto não pode exceder os 255 caracteres',
            'price.required' => 'Preço do produto é obrigatório',
            'qtd.required' => 'Quantidade do produto é obrigatória',
            'description.required' => 'Descrição do produto é obrigatória',
            'details.required' => 'Detalhes do produto é obrigatório',
            'image.image' => 'O ficheiro de imagem tem de ser um ficheiro de imagem válido',
            'image.required' => 'A imagem é obrigatória'
        ];
    }
}
