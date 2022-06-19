<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'client_name' => 'required_if:status,pending|nullable',
            'client_email' => 'required_if:status,pending|nullable',
            'invoice_date' => 'required_if:status,pending|nullable',
            'payment_terms' => 'required_if:status,pending|nullable',
            'description' => 'required_if:status,pending|nullable',

            'senderAddress.street' => 'required_if:status,pending|nullable',
            'senderAddress.city' => 'required_if:status,pending|nullable',
            'senderAddress.postcode' => 'required_if:status,pending|nullable',
            'senderAddress.country' => 'required_if:status,pending|nullable',

            'clientAddress.street' => 'required_if:status,pending|nullable',
            'clientAddress.city' => 'required_if:status,pending|nullable',
            'clientAddress.postcode' => 'required_if:status,pending|nullable',
            'clientAddress.country' => 'required_if:status,pending|nullable',
            
            'items.*.name' => 'required_if:status,pending|nullable',
            'items.*.quantity' => 'required_if:status,pending|nullable',
            'items.*.price' => 'required_if:status,pending|nullable',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Status is required',
            'client_name.required_if' => 'Client name is required',
            'client_email.required_if' => 'Client Email is required',
            'invoice_date.required_if' => 'Invoice date is required',
            'payment_terms.required_if' => 'Payment terms is required',
            'description.required_if' => 'Description is required',

            'senderAddress.street.required_if' => 'Street is required',
            'senderAddress.city.required_if' => 'City is required',
            'senderAddress.postcode.required_if' => 'Postcode is required',
            'senderAddress.country.required_if' => 'Country is required',

            'clientAddress.street.required_if' => 'Street is required',
            'clientAddress.city.required_if' => 'City is required',
            'clientAddress.postcode.required_if' => 'Postcode is required',
            'clientAddress.country.required_if' => 'Country is required',

            'items.*.name.required_if' => 'Name is required',
            'items.*.quantity.required_if' => 'Qty is required',
            'items.*.price.required_if' => 'Price is required',
        ];
    }
}
