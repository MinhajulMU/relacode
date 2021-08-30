<?php

namespace App\Models;

use App\Bardiz12\BaseModel;

class RolePrivilege extends BaseModel{

    protected $table = 'role_privilege';
    protected $primaryKey = "id_role_privilege";
    protected $fillable = [
        "id_role",
        "id_module",
        "can_create",
        "can_read",
        "can_update",
        "can_delete",
        'can_validate'
    ];

    protected $relationField = [
        "id_module" => "module.id_module",
        "id_role" => "role.id_role"
    ];
    
    protected $relationFieldInject = [
        "id_module" => "name",
        "id_role" => "role_name"
    ];

    public function module()
    {
        return $this->hasOne('App\Modules\Module\Models\Module', 'id_module', 'id_module');
    }

    
}