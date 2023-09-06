<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subcategory_photo', 'is_hidden', 'category_id', 'searchQuery'];

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }



}
