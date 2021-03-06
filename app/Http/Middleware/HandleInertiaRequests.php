<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $arrayMerge = array_merge(parent::share($request), [
            'auth' => function () use ($request){
                return [
                    'user' => Auth::check() ? (Auth::user()->toArray()) : null,
                    'active_role' => $request->session()->get('active_role') == null ? null : $request->session()->get('active_role'),
                    'menu' =>  $request->session()->get('menu') == null ? null : $request->session()->get('menu'),
                    'role_privileges' => $request->session()->get('role_privileges') == null ? null : $request->session()->get('role_privileges'),
                    'roles' => $request->session()->get('roles') == null ? null : $request->session()->get('roles'),
                    'profile_photo' => $request->session()->get('profile_photo')
                ];
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
            'csrf' => csrf_token(),
            'id_user_asli' => $request->session()->get('id_user_asli')
        ]);
        return $arrayMerge;
    }
}
