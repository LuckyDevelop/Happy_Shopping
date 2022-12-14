<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherModel extends Model
{
    use HasFactory;
    protected $table = 'voucher';
    protected $guarded = [];

    function VoucherUsage() {
        return $this->hasMany(VoucherUsageModel::class, 'voucher_id', 'id');
    }
}
