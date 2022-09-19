<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $guarded = [];

    function Admin()
    {
        return $this->hasMany(AdminsModel::class, 'roles_id', 'id');
    }

    function Authorize()
    {
        return $this->hasMany(AuthorizationModel::class, 'roles_id', 'id');
    }
}
