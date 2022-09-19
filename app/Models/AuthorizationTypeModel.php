<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizationTypeModel extends Model
{
    use HasFactory;
    protected $table = 'authorization_types';
    protected $guarded = [];

    function Authorization()
    {
        return $this->hasMany(AuthorizationModel::class, 'authorization_types_id', 'id');
    }
}
