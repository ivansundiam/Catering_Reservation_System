<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'package' => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'occasion' => 'required',
            'theme' => 'required',
            'address' => 'required',
            'payment_percent' => 'required',
            'receipt-img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'package.required' => 'Choose at least one package.',
            'date.required' => 'Select a reservation date.',
            'time.required' => 'Specify a reservation time.',
            'payment_percent' => 'Select the percentage of your payment.',
            'receipt-img.required' => 'Please upload your receipt photo for verification.',
        ];
    }

}
