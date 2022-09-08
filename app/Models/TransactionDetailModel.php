<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetailModel extends Model
{
    use HasFactory;
    protected $table = 'transaction_detail';
    protected $guarded = [];

    function Product() {
        return $this->belongsTo(ProductModel::class, 'product_id', 'id');
    }

    function Transaction() {
        return $this->belongsTo(TransactionModel::class, 'transaction_id', 'id');
    }
}
