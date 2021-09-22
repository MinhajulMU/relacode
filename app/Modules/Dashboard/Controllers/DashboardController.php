<?php

namespace App\Modules\Dashboard\Controllers;

use ReflectionClass;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use App\Bardiz12\Auth\GenerateMenuUser;
use App\Bardiz12\Auth\CachePrivileges;
use App\Modules\UserRole\Models\UserRole;
use App\Modules\Users\Models\Users;
use App\Modules\Dokumen\Models\Dokumen;
use App\Models\Log;
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

    public function profil()
    {
        $data['role'] = UserRole::where('id_user',Auth::user()->id_user)
        ->leftJoin('role','role.id_role','=','user_role.id_role')
        ->get(['role.role_name','user_role.id_role']);
        $data['log'] = Log::where('id_user',Auth::user()->id_user)->orderBy('created_at','desc')->take(10)->get();
        $data['user'] = Users::find(Auth::user()->id_user);
        $id_jns_dokumen = '133174b3-eec3-42fd-b0b6-1286e086f079';
        $dokumen = Dokumen::where('id_jns_dokumen',$id_jns_dokumen)->where('id_model',Auth::user()->id_user)->orderBy('dokumen.created_at','desc')->first();
        $data['dokumen'] = $dokumen;
        
        return Inertia::render('Dashboard::Profil', $data);
    }
    public function updateProfil(Request $request,$id)
    {
        $formData = $request->validate([
            "name"       => "required|string",
            "email"       => "required|string|email"
        ]);   
        $users = Users::findOrFail($id);
        $users->update($formData);

        // update profile photo
        $data['id_jns_dokumen'] = '133174b3-eec3-42fd-b0b6-1286e086f079'; // profile photo
		$data['model'] = (new ReflectionClass($users))->getName();
		$data['id_model'] = $users->id_user;

		if ($request->file('photo') != null) {
            $users->deleteDokumen($data['model'], $data['id_model'], $data['id_jns_dokumen']);
			$dok = $users->saveDokumen($request->file('photo'), $data, true);
            if ($dok[0] ==  true) {
                session()->put('profile_photo','storage/uploads/'.$dok[2]->file_path.$dok[2]->file_name);
            }

		}
        $log  = Log::aktivitas('Update Profile');
        return redirect()
            ->route("dashboard.profile.index")
            ->with('success', 'Berhasil memperbarui data!');
    }
}
