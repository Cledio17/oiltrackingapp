<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OilRequest extends FormRequest
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
            'car_plate' => 'required|string|min:6|regex:/^[A-Z]{3}-[0-9]{4}$/',
            'oil_receipt' => 'required|image|mimes:jpeg,png,jpg',
            'location' => 'required|string',
        ];
    }
}
