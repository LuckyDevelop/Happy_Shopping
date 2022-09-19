<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $guarded = [];

    function MenuGroup()
    {
        return $this->belongsTo(MenuGroupModel::class, 'menu_group_id', 'id');
    }

    function Authorization()
    {
        return $this->hasMany(AuthorizationModel::class, 'menu_id', 'id');
    }
}
