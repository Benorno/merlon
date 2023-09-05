<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
        'first_name',
        'last_name',
        'company_name',
        'address',
        'vat',
        'zip',
        'phone',
        'client_email',
        'comment',
        'quantity',
        'guest_id',
        'status',
        'search_query',
    ];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
