<?php

namespace App\Modules\Dashboard\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\Bardiz12\Auth\GenerateMenuUser;
use App\Bardiz12\Auth\CachePrivileges;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    //
    protected $title = "Book";


    public function index(Request $request)
    {
        $data = [];
        return Inertia::render('Dashboard::Index', $data);
    }
    
    public function changeRole($id_role)
    {
        $role = Auth::user()->roles()->where('role.id_role',$id_role)->first();
        if ($role) {
            session()->put('active_role',json_decode(json_encode($role),true));
            $menuGenerator = new GenerateMenuUser($role);
            $menuGenerator->generate();

            $cachePrivileges = new CachePrivileges($role);
            $cachePrivileges->cache();
            return redirect()->route('dashboard.index')->with('success', 'Anda mengaktifkan Role '.$role->role_name);
        }
        return redirect()->route('dashboard.index')->with('errors',['Error, Gagal mengganti role']);
    }
}
