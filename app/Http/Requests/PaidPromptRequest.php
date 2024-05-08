<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaidPromptRequest extends FormRequest
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
            'n' => ['required', 'numeric'],
            'p' => ['required', 'numeric'],
            'k' => ['required', 'numeric'],
            'temp' => ['required', 'numeric'],
            'h' => ['required', 'numeric'],
            'ph' => ['required', 'numeric'],
            'rain' => ['required', 'numeric'],
        ];
    }
}
