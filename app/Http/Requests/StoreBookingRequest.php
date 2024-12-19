<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'rooms_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'total_price' => 'required|numeric',
            'guest_id' => 'required|exists:guests,id'
        ];
    }
    public function messages()
    {
        return [
            'rooms_id.required' => 'Please select a room.',
            'rooms_id.exists' => 'The selected room does not exist.',
            'check_in.required' => 'The check-in date is required.',
            'check_in.date' => 'Please enter a valid check-in date.',
            'check_out.required' => 'The check-out date is required.',
            'check_out.date' => 'Please enter a valid check-out date.',
            'check_out.after' => 'The check-out date must be after the check-in date.',
            'total_price.required' => 'Please enter the total price.',
            'total_price.numeric' => 'The total price must be a valid number.',
        ];
    }
}
