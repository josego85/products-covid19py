<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'user_email' => 'email|nullable',
            'user_phone' => 'required|numeric',
            'user_comment' => 'max:4000',
            'user_lat' => 'required_without:user_lng|numeric',
            'user_lng' => 'required_without:user_lat|numeric',
            'products' => 'required|array|min:1',
            'user_full_name' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_phone.required' => 'El contacto es obligatorio.',
            'user_comment.max' => 'La descripción no puede tener más de 4000 caracteres',
            'user_lat.required_without' => 'La ubicación en el mapa es obligatoria.',
            'user_lng.required_without' => 'La ubicación en el mapa es obligatoria.',
            'products.required' => 'Tiene que agregar por lo menos 1 producto.',
            'user_full_name.required' => 'El nombre completo es obligatorio.',
        ];
    }
}
