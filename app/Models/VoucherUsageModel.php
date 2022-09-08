<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUsageModel extends Model
{
    use HasFactory;
    protected $table = 'voucher_usage';
    protected $guarded = [];

    function Transaction() {
        return $this->belongsTo(TransactionModel::class, 'transaction_id', 'id');
    }

    function Voucher() {
        return $this->belongsTo(VoucherModel::class, 'voucher_id', 'id');
    }
}
