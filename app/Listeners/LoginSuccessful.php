<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Bardiz12\Auth\GenerateMenuUser;
use App\Bardiz12\Auth\CachePrivileges;
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
        $roles = $user->roles()->select(['role.id_role','role_name','role_slug'])->get();
        if (count($roles) > 0) {
            $activeRole = $roles[0];
            session()->put('roles',json_decode(json_encode($roles),true));
            request()->session()->put('active_role', json_decode(json_encode($activeRole),true));
            $menuGenerator = new GenerateMenuUser($activeRole);
            $menuGenerator->generate();
            $cachePrivileges = new CachePrivileges($activeRole);
            $cachePrivileges->cache();
        }else{
            Auth::logout();
            session()->flush();
            return redirect()->route('login');
        }

    }

}
