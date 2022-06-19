<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'invoice_num' => $this->invoice_num,
            'client_name' => $this->client_name,
            'client_email' => $this->client_email,
            'payment_terms' => $this->payment_terms,
            'status' => $this->status,
            'total' => $this->total,
            'senderAddress' => AddressResource::collection($this->senderAddress)->first(),
            'clientAddress' => AddressResource::collection($this->clientAddress)->first(),
            'items' => ItemResource::collection($this->items),
            'invoice_date' =>  $this->invoice_date,
            'payment_due' =>  $this->payment_due,
        ];
    }
}
