<?php

namespace App\Repository;

use App\Models\AdminsModel;

use Exception;

class SignUpRepository
{
    function addData() {
        AdminsModel::create([
            'username' => request('username'),
            'password' => bcrypt(request('password')),
        ]);
    }
}
