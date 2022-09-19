<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuGroupModel extends Model
{
    use HasFactory;
    protected $table = 'menu_group';
    protected $guarded = [];

    function Menu()
    {
        return $this->hasMany(MenuModel::class, 'menu_group_id', 'id');
    }
}
