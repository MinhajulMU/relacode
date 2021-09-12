<?php

namespace App\Bardiz12\Auth;

use App\Models\Role;
use DB;
class GenerateMenuUser{

    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function generate(){
        
        $menu = [];
        $menu_grup = DB::table('role_privilege')
        ->select('module.id_menu_grup','nm_menu_grup')
        ->where('id_role',$this->role->id_role)
        ->join('module','module.id_module','=','role_privilege.id_module')
        ->join('menu_grup','module.id_menu_grup','=','menu_grup.id_menu_grup')
        ->where('module.is_show',1)
        ->where('role_privilege.can_read',1)
        ->whereNull('module.deleted_at')
        ->whereNull('role_privilege.deleted_at')
        ->groupBy('module.id_menu_grup')
        ->orderBy('menu_grup.urutan','asc')
        ->get();
        foreach ($menu_grup as $key => $value) {            
            $menu['grup_menu'][$key] = [
                'id' => $value->id_menu_grup,
                'nm' => $value->nm_menu_grup,
                'menu_utama' => null
            ];
            $menu_utama = DB::table('role_privilege')
            ->select('module.id_module','module.name','module.icon','module.slug','parent_id')
            ->where('id_role',$this->role->id_role)
            ->join('module','module.id_module','=','role_privilege.id_module')
            ->where('module.is_show',1)
            ->where('role_privilege.can_read',1)
            ->where('module.parent_id',0)
            ->where('module.id_menu_grup',$value->id_menu_grup)
            ->whereNull('module.deleted_at')
            ->whereNull('role_privilege.deleted_at')
            ->orderBy('module.urutan','asc')
            ->get();
            if (count($menu_utama) > 0) {
                foreach ($menu_utama as $key_menu => $value_menu) {
                    $menu['grup_menu'][$key]['menu_utama'][$key_menu] = [
                        'nm'   => $value_menu->name,
                        'icon' => $value_menu->icon,
                        'slug' => $value_menu->slug,
                        'submenu' => null
                    ];
                    $submenu = DB::table('role_privilege')
                    ->select('module.name','module.icon','module.slug','parent_id')
                    ->where('id_role',$this->role->id_role)
                    ->join('module','module.id_module','=','role_privilege.id_module')
                    ->where('module.is_show',1)
                    ->where('role_privilege.can_read',1)
                    ->where('module.parent_id',$value_menu->id_module)
                    ->whereNull('module.deleted_at')
                    ->whereNull('role_privilege.deleted_at')
                    ->orderBy('module.urutan','asc')
                    ->get();

                    if (count($submenu) > 0) {
                        
                        foreach ($submenu as $key_submenu => $value_submenu) {
                            $menu['grup_menu'][$key]['menu_utama'][$key_menu]['submenu'][$key_submenu] = [
                                'nm'   => $value_submenu->name,
                                'icon' => $value_submenu->icon,
                                'url'  => route($value_submenu->slug . ".index"),
                            ];
                        }
                        $menu['grup_menu'][$key]['menu_utama'][$key_menu]['url'] = "#";
                    }else{
                        // print_r($submenu);

                        $menu['grup_menu'][$key]['menu_utama'][$key_menu]['url'] = route($value_menu->slug . ".index");
                    }

                }

            }

        }


        session()->put('menu', $menu);
        return $this;
    }
}