<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $guarded = [];

    function TransactionDetail() {
        return $this->hasMany(TransactionDetailModel::class, 'transaction_id', 'id');
    }

    function VoucherUsage() {
        return $this->hasMany(VoucherUsageModel::class, 'transaction_id', 'id');
    }
}
