<?php

namespace App\Models;

use App\Bardiz12\BaseModel;
use \App\Bardiz12\Eloquent\UseUUID;

class Role extends BaseModel{
    use UseUUID;
    protected $table = 'role';
    protected $primaryKey = "id_role";
    protected $fillable = [
        "role_name",
        "role_slug"
    ];

    protected $relationField = [
        
    ];
    
    protected $relationFieldInject = [

    ];

    public function modules()
    {
        return $this
                    ->belongsToMany('App\Modules\Module\Models\Module', 'role_privilege', 'id_role', 'id_module')
                    ->withPivot([
                        'can_create',
                        'can_read',
                        'can_update',
                        'can_delete',
                        'can_validate'
                    ]);
    }

    

    public function rolePrivileges()
    {
        return $this->hasMany('App\Modules\Module\Models\RolePrivilege', 'id_role', 'id_role');
    }


    
}