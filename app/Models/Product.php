<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id', 'id');
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'products_transactions')->withPivot('quantity');
    }
}
