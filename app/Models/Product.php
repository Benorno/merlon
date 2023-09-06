<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
    ['product_code',
    'name',
    'description',
    'price',
    'stock_quantity',
    'photo',
    'material',
    'subcategory_id',
    'is_hidden',
    'top_width',
    'bottom_width',
    'height',
    'weight',
    'quantity_carton',
    'origin',
    'stockable',
    'nucleated',
    'views',
    'searchQuery'
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // If you want to establish a self-referencing relationship for related products
    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'product_related', 'product_id', 'related_product_id', 'stock_quantity');
    }

}
