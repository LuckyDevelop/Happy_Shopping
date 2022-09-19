<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationModel extends Model
{
    use HasFactory;
    protected $table = 'authorizations';
    protected $guarded = [];

    function Role() {
        return $this->belongsTo(RoleModel::class, 'roles_id', 'id');
    }

    function AuthType()
    {
        return $this->belongsTo(AuthorizationTypeModel::class, 'authorization_types_id', 'id');
    }

    function Menu()
    {
        return $this->belongsTo(MenuModel::class, 'menu_id', 'id');
    }
}
