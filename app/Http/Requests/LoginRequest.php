<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',        // doit être un email valide:contentReference[oaicite:2]{index=2}
            'password' => 'required|string|min:8', // mot de passe requis, minimum 8 caractères:contentReference[oaicite:3]{index=3}
            'remember' => 'sometimes|boolean',     // facultatif, doit être vrai ou faux:contentReference[oaicite:4]{index=4}
        ];
    }
}
