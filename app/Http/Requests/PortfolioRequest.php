<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string'],
            'image' => ['image'],
            'short_description' => ['max:50'] 
        ];
        
        return $rules;
    }

    public function messages()
    {

        $messages = [
            'title.required' => 'O campo de título é obrigatório',
            'title.string' => 'O campo de título é uma string',
            'image.image' => 'O arquivo deve ser uma imagem',
            'short_description.max' => 'A descrição deve ter no máximo 50 caracteres'
        ];

        return $messages;
    }
}
