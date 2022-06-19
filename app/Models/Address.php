<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];

    const SENDER = 'sender';
    const CLIENT = 'client';

    /**
     * Get the invoice that owns the address.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
