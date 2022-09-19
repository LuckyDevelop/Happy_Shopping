<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminsModel extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';
    protected $guarded = [];

    function Role() {
        return $this->belongsTo(RoleModel::class, 'roles_id', 'id');
    }
}
