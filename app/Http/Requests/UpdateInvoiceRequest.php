<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
            'status' => 'required',
            'client_name' => 'required',
            'client_email' => 'required',
            'invoice_date' => 'required',
            'payment_terms' => 'required',
            'description' => 'required',

            'senderAddress.id' => 'required',
            'senderAddress.street' => 'required',
            'senderAddress.city' => 'required',
            'senderAddress.postcode' => 'required',
            'senderAddress.country' => 'required',

            'clientAddress.id' => 'required',
            'clientAddress.street' => 'required',
            'clientAddress.city' => 'required',
            'clientAddress.postcode' => 'required',
            'clientAddress.country' => 'required',

            'items.*.name' => 'required',
            'items.*.quantity' => 'required',
            'items.*.price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Status is required',
            'client_name.required' => 'Client name is required',
            'client_email.required' => 'Client Email is required',
            'invoice_date.required' => 'Invoice date is required',
            'payment_terms.required' => 'Payment terms is required',
            'description.required' => 'Description is required',

            'senderAddress.street.required' => 'Street is required',
            'senderAddress.city.required' => 'City is required',
            'senderAddress.postcode.required' => 'Postcode is required',
            'senderAddress.country.required' => 'Country is required',

            'clientAddress.street.required' => 'Street is required',
            'clientAddress.city.required' => 'City is required',
            'clientAddress.postcode.required' => 'Postcode is required',
            'clientAddress.country.required' => 'Country is required',
            
            'items.*.name.required' => 'Name is required',
            'items.*.quantity.required' => 'Qty is required',
            'items.*.price.required' => 'Price is required',
        ];
    }
}
