<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Bardiz12\Auth\GenerateMenuUser;
use App\Bardiz12\Auth\CachePrivileges;
use App\Modules\Dokumen\Models\Dokumen;
use App\Models\Log;
use Session;
use Avatar;
use Auth;
class LoginSuccessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $id_user = $event->user['id_user'];
        $user = User::find($id_user);
        $id_jns_dokumen = '133174b3-eec3-42fd-b0b6-1286e086f079';
        // dd(Auth::user()->id_user);
        $dokumen = Dokumen::where('id_jns_dokumen',$id_jns_dokumen)->where('id_model',$user->id_user)->orderBy('dokumen.created_at','desc')->first();
        if ($dokumen == null) {
            $profile_photo = Avatar::create($user->name)->toBase64();
        }else{
            $profile_photo = url('/storage/uploads/'.$dokumen->file_path.$dokumen->file_name);
        }
        $roles = $user->roles()->select(['role.id_role','role_name','role_slug'])->get();
        session()->put('profile_photo',$profile_photo);
        $log  = Log::aktivitas('Login');
        if (count($roles) > 0) {
            $activeRole = $roles[0];
            session()->put('roles',json_decode(json_encode($roles),true));
            request()->session()->put('active_role', json_decode(json_encode($activeRole),true));
            $menuGenerator = new GenerateMenuUser($activeRole);
            $menuGenerator->generate();
            $cachePrivileges = new CachePrivileges($activeRole);
            $cachePrivileges->cache();
        }else{
            $log  = Log::aktivitas('Login Failed, Roles 0');
            Auth::logout();
            session()->flush();
            return redirect()->route('login');
        }

    }

}
