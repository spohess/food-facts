<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUserTokenRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
            'token_name' => ['string'],
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'email:required' => 'Credênciais inválidas',
            'email:email' => 'Credênciais inválidas',
            'email:exists' => 'Credênciais inválidas',
            'password:required' => 'Credênciais inválidas',
            'password:string' => 'Credênciais inválidas',
        ];
    }
}
