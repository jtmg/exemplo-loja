<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return[
            "name" => "required",
            "url" => "required|image|mimes:jpg,jpeg,png,gif|max:2048"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "O nome do produto é Obrigatório",
            "url.required"=> "A Imagem é Obrigatória",
            "url.image" => "O ficheiro deve ser uma imagem",
            "url.mimes" => "A imagem só pode ser dos seguintes tipos: jpg,jpeg,png,gif",
            "url.max" => "O tamanho da imagem não pode exceder os 2MB"
        ];
    }
}
