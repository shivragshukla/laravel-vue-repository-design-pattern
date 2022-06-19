<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    const DRAFT = 'draft';
    const PENDING = 'pending';
    const PAID = 'paid';

    protected $casts = [
        'payment_due' => 'datetime:Y-m-d',
        'invoice_date' => 'datetime:Y-m-d',
    ];

    /**
     * Get the addresses for the invoice.
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the senderAddress for the invoice.
     */
    public function senderAddress()
    {
        return $this->addresses()->where('type', Address::SENDER);
    }

    /**
     * Get the clientAddress for the invoice.
     */
    public function clientAddress()
    {
        return $this->addresses()->where('type', Address::CLIENT);
    }

    /**
     * Get the items for the invoice.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
