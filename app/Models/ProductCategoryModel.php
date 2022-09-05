<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryModel extends Model
{
    use HasFactory;
    protected $table = 'product_category';
    protected $guarded = [];

    function Product() {
        return $this->hasMany(ProductModel::class, 'product_category_id', 'id');
    }
}
