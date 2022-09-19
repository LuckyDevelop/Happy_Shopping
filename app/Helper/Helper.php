<?php
namespace App\Helper;

use App\Models\MenusModel;
use App\Models\AuthorizationTypesModel;
use App\Models\AuthorizationTypeModel;
use App\Models\MenuModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

/**
 *
 */
class Helper
{
	public static function getGroupMenu()
    {
        $groupmenu = DB::table('menu_group')->where('id','>',2)->get(); //->whereIn('id', [3,4,6,7])

        return $groupmenu;
    }

    public static function getMenu()
    {
        $tipe = AuthorizationTypeModel::where('name', 'view')->first();
        $menu = MenuModel::join('authorizations', 'authorizations.menus_id', '=', 'menus.id')
            ->where('authorizations.authorization_types_id', $tipe->id)
            ->where('authorizations.roles_id', auth()->user()->roles_id)
            ->whereNotIn('menus.menu_group_id', [1,2])
            ->orderBy('order', 'asc')->get();
        return $menu;
    }

    public static function getMenunull()
    {
        $menu = DB::table('menus')->where('menu_group_id', 1)->get();;

        return $menu;
    }
    public static function getMenunull2()
    {
        $tipe = AuthorizationTypeModel::where('name', 'view')->first();

        $menu = MenuModel::join('authorizations', 'authorizations.menus_id', '=', 'menus.id')
            ->where('authorizations.authorization_types_id', $tipe->id)
            ->where('authorizations.roles_id', auth()->user()->roles_id)
            ->where('menus.menu_group_id', 2)->get();
        return $menu;
    }

    public static function changeRouteName()
    {
        $req = Route::getCurrentRoute()->getName();
        $exp = explode('_', $req);
        $menuName = MenuModel::where('route', $exp[0])->first()->toArray();
        return $menuName;
    }

    public static function setActiveMenu()
    {
        $route = Route::getCurrentRoute()->uri;
        $exp = explode('/', $route);
        $route = $exp[0];
        return $route;
    }
}
