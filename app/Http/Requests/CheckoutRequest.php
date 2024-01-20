<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'addr.shipping.first_name' => 'required|string|max:255',
            'addr.shipping.last_name' => 'required|string|max:255',
            'addr.shipping.email' => 'email',
            'addr.shipping.phone_number' => 'required|string|max:20',
            'addr.shipping.street_address' => 'required|string|max:255',
            'addr.shipping.city' => 'required|string|max:255',
            'addr.shipping.postal_code' => 'string|max:20',
            'addr.shipping.state' => 'string|max:255',
            'addr.shipping.country' => 'required|string|max:255',

            'addr.billing.first_name' => 'required_if:checkbox,0|string|max:255',
            'addr.billing.last_name' => 'required_if:checkbox,0|string|max:255',
            'addr.billing.email' => 'email',
            'addr.billing.phone_number' => 'required_if:checkbox,0|string|max:20',
            'addr.billing.street_address' => 'required_if:checkbox,0|string|max:255',
            'addr.billing.city' => 'required_if:checkbox,0|string|max:255',
            'addr.billing.postal_code' => 'string|max:20',
            'addr.billing.state' => 'string|max:255',
            'addr.billing.country' => 'required_if:checkbox,0|string|max:255',
        ];
    }
}
