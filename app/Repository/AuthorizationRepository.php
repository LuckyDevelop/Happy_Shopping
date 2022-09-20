<?php

namespace App\Repository;

use App\Models\AuthorizationModel;
use App\Models\AuthorizationTypeModel;
use App\Models\MenuModel;
use App\Models\RoleModel;

class AuthorizationRepository
{
    function getData($role)
    {
        $data = AuthorizationModel::where('roles_id', $role)->get();
        return $data;
    }

    function getAdminGroup()
    {
        $data = RoleModel::all();
        return $data;
    }

    function getMenu()
    {
        $data = MenuModel::all();
        return $data;
    }

    function getType()
    {
        $data = AuthorizationTypeModel::all();
        return $data;
    }

    function update()
    {
        AuthorizationModel::where('roles_id', request('role'))->delete();
        $req = request('menu_tipe');
        $temp = [];
        foreach ($req as $val) {
            $exp = explode('_', $val);
            $ar['roles_id'] = request('role');
            $ar['menus_id'] =  $exp[0];
            $ar['authorization_types_id'] =  $exp[1];
            $temp[] = $ar;
        }
        $auth = AuthorizationModel::insert($temp);
    }
}
