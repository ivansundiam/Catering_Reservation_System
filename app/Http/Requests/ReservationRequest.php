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
            'package_id' => 'required',
            'menu_id' => 'required',
            'phone_number' => 'required|max:11|min:11',
            'additional_number' => '',
            'adults' => '',
            'kids' => '',
            'beverage' => '',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i|after:07:59|before:20:01',
            'occasion' => 'required',
            'amount_paid' => 'numeric',
            'total_cost' => 'required',
            'rentals' => 'array',
            'add_ons' => 'array',
            'pax' => 'required|numeric|max:300',
            'address' => 'required',
            'payment_percent' => 'required',
            'receipt-img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function updateRules(): array
    {   
        return [
            'payment_percent' => 'required',
            'receipt-img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    

    public function messages()
    {
        return [
            'package.required' => 'Choose at least one package.',
            'phone_number.max' => 'Must be correct format of phone number: 09XXXXXXXXX.',
            'phone_number.min' => 'Must be correct format of phone number: 09XXXXXXXXX.',
            'date.required' => 'Select a reservation date.',
            'time.required' => 'Specify a reservation time.',
            'time.after' => 'Choose a time between 10:00 AM and 8:00 PM.',
            'time.before' => 'Choose a time between 10:00 AM and 8:00 PM.',
            'payment_percent' => 'Select the percentage of your payment.',
            'receipt-img.required' => 'Please upload your receipt photo for verification.',
        ];
    }

}
