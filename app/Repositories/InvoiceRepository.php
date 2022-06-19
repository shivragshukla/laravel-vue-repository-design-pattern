<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Http\Resources\InvoiceResource;
use Illuminate\Support\Str;
use App\Models\Invoice;
use App\Models\Address;

class InvoiceRepository implements InvoiceRepositoryInterface 
{
    public function getAllInvoices() 
    {
        return InvoiceResource::collection(Invoice::all());
    }

    public function getInvoiceById($invoiceId) 
    {
        return new InvoiceResource(Invoice::findOrFail($invoiceId));
    }

    public function deleteInvoice($invoiceId) 
    {
        try {
            Invoice::destroy($invoiceId);
            return ['status'=>'success'];
        } catch (ModelNotFoundException $e) {
            return ['status'=>'error'];
        }
    }

    public function invoicePaid($invoiceId) 
    {
        try {
            Invoice::find($invoiceId)->update(['status' => 'paid']);
            return ['status'=>'success'];
        } catch (ModelNotFoundException $e) {
            return ['status'=>'error'];
        }
    }

    public function createInvoice(array $invoiceDetails) 
    {
        $paymentDue = $invoiceDetails['payment_terms'] 
            ? now()->addDays($invoiceDetails['payment_terms'])
            : null;
        $invoice = Invoice::create([
            "invoice_num" =>  $this->generateUniqueInvoiceId(),
            "client_name" =>  $invoiceDetails['client_name'] ?? null,
            "client_email" =>  $invoiceDetails['client_email'] ?? null,
            "invoice_date" =>  $invoiceDetails['invoice_date'] ?? null,
            "payment_terms" =>  $invoiceDetails['payment_terms'] ?? null,
            "description" =>  $invoiceDetails['description'] ?? null,
            "status" =>  $invoiceDetails['status'] ?? null,
            "payment_due" =>  $paymentDue,
        ]);
        $this->createSenderAddress(
            $invoice, 
            $invoiceDetails['senderAddress']
        );
        $this->createClientAddress(
            $invoice, 
            $invoiceDetails['clientAddress']
        );

        $this->associateItems(
            $invoice, 
            $invoiceDetails['items'] ?? []
        );

        return $invoice;
    }

    public function updateInvoice($invoiceId, array $newDetails) 
    {
        $paymentDue = $newDetails['payment_terms'] 
            ? now()->addDays($newDetails['payment_terms'])
            : null;

        try {
            $invoice = Invoice::find($invoiceId);
            $invoice->update([
                "client_name" =>  $newDetails['client_name'] ?? null,
                "client_email" =>  $newDetails['client_email'] ?? null,
                "invoice_date" =>  $newDetails['invoice_date'] ?? null,
                "payment_terms" =>  $newDetails['payment_terms'] ?? null,
                "description" =>  $newDetails['description'] ?? null,
                "payment_due" =>  $paymentDue,
            ]);
            $this->updateAddress(
                $invoice, 
                $newDetails['senderAddress']
            );
            $this->updateAddress(
                $invoice, 
                $newDetails['clientAddress']
            );

            $this->associateItems(
                $invoice, 
                $newDetails['items'] ?? []
            );

            return $invoice;
        } catch (ModelNotFoundException $e) {
            return ['status'=>'error'];
        }
    }

    public function getPaidInvoices() 
    {
        return Invoice::where('status', 'paid');
    }

    private function createSenderAddress(Invoice $invoice, array $data)
    {
        return $invoice->addresses()->create([
            "street" => $data['street'] ?? null,
            "city" => $data['city'] ?? null,
            "postcode" => $data['postcode'] ?? null,
            "country" => $data['country'] ?? null,
            "type" => Address::SENDER,
        ]);
    }

    private function createClientAddress(Invoice $invoice, array $data)
    {
        return $invoice->addresses()->create([
            "street" => $data['street'] ?? null,
            "city" => $data['city'] ?? null,
            "postcode" => $data['postcode'] ?? null,
            "country" => $data['country'] ?? null,
            "type" => Address::CLIENT,
        ]);
    }

    private function updateAddress(Invoice $invoice, array $data)
    {
        $address = $invoice->addresses->find($data['id']);
        return $address->update([
            "street" => $data['street'] ?? null,
            "city" => $data['city'] ?? null,
            "postcode" => $data['postcode'] ?? null,
            "country" => $data['country'] ?? null,
        ]);
    }

    private function associateItems(Invoice $invoice, array $data)
    {
        $invoice->items()->delete();

        $items = collect($data)->map(function ($item) {
            return array_merge(
                $item, ['total' => $item['price'] * $item['quantity']]
            );
        })->toArray();

        $total = collect($items)->map(function ($item) {
            return $item['total'];
        })->sum();

        $invoice->items()->createMany($items);
        $invoice->total = $total;

        return $invoice->save();
    }

    private function generateUniqueInvoiceId()
    {
        return Str::upper(substr(preg_replace('/[0-9]+/', '', Str::random(5)), 0, 2)) . rand (1000, 9999);
    }
}
