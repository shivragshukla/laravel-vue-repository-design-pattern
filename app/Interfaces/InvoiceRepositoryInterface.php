<?php

namespace App\Interfaces;

interface InvoiceRepositoryInterface 
{
    public function getAllInvoices();
    public function getInvoiceById($invoiceId);
    public function invoicePaid($invoiceId);
    public function deleteInvoice($invoiceId);
    public function createInvoice(array $invoiceDetails);
    public function updateInvoice($invoiceId, array $newDetails);
    public function getPaidInvoices();
}
