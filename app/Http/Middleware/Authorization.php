<?php

namespace App\Http\Middleware;

use App\Models\AuthorizationModel;
use App\Models\AuthorizationTypeModel;
use App\Models\MenuModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $req = $request->route()->getName();
        $exp = explode('_', $req);
        $menu = MenuModel::where('route', $exp[0])->first();
        $tipe = AuthorizationTypeModel::where('name', $exp[1])->first();
        // dd($tipe['id']);
        $otorisasi = AuthorizationModel::where('roles_id', Auth::user()->roles_id)->with(['Role', 'Menu', 'AuthType'])
            ->where('menus_id', $menu['id'])
            ->where('authorization_types_id', $tipe['id'])
            ->first();
            // dd($otorisasi);
        if($otorisasi === null) {
            if($request->ajax() == true){
                return response()->json('You need authorization from the Master',401);
            }
            abort(403, "You don't have access");
        }
        return $next($request);
    }
}
