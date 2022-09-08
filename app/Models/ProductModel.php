<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $guarded = [];

    function ProductCategory() {
        return $this->belongsTo(ProductCategoryModel::class, 'product_category_id', 'id');
    }

    function TransactionDetail() {
        return $this->hasMany(TransactionDetailModel::class, 'product_id', 'id');
    }
}
