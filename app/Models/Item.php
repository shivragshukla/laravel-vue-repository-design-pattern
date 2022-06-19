<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the invoice that owns the address.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
