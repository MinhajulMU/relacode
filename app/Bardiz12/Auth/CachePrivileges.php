<?php

namespace App\Bardiz12\Auth;

use App\Modules\Role\Models\Role;

class CachePrivileges{

    public function __construct($role)
    {
        $this->role = $role;
    }

    public function cache(){
        $modules = $this->role->modules;
        $privileges = [];
        // dd($modules->toArray());
        foreach($modules as $module){
            $privileges[$module->slug] = [
                'can_read' => $module->pivot->can_read,
                'can_create' => $module->pivot->can_create,
                'can_update' => $module->pivot->can_update,
                'can_delete' => $module->pivot->can_delete,
                'can_validate' => $module->pivot->can_validate
            ];
        }

        session()->put("role_privileges", $privileges);
    }
}