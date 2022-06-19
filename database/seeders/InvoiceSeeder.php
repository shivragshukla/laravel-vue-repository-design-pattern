<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Address;
use File;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/invoice.json");
        $invoices = json_decode($json);

        foreach ($invoices as $key => $value) {

            $invoice = Invoice::create([
                "invoice_num" =>  $value->id,
                "client_name" =>  $value->clientName,
                "client_email" =>  $value->clientEmail,
                "payment_terms" =>  $value->paymentTerms,
                "status" =>  $value->status,
                "payment_due" =>  $value->paymentDue,
                "total" =>  $value->total,
                "created_at" =>  $value->createdAt,
            ]);

            // senderAddress
            $invoice->addresses()->create([
                "street" => $value->senderAddress->street,
                "city" => $value->senderAddress->city,
                "postcode" => $value->senderAddress->postCode,
                "country" => $value->senderAddress->country,
                "type" => Address::SENDER,
            ]);

            // clientAddress
            $invoice->addresses()->create([
                "street" => $value->clientAddress->street,
                "city" => $value->clientAddress->city,
                "postcode" => $value->clientAddress->postCode,
                "country" => $value->clientAddress->country,
                "type" => Address::CLIENT,
            ]);

            // items
            $items = json_decode(json_encode($value->items), true);
            $invoice->items()->createMany($items);
        }
            
    }
}
