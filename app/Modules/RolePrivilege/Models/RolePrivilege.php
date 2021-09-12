<?php

namespace App\Modules\RolePrivilege\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class RolePrivilege extends BaseModel{
    use UseUUID;
    protected $table = 'role_privilege';
    protected $primaryKey = "id_role_privilege";
    protected $fillable = [
        "can_create",
        "can_delete",
        "can_read",
        "can_update",
        "can_validate",
        "id_module",
        "id_role"
    ];

    protected $relationField = [
        "id_role" => "role.id_role",
        "id_module" => "module.id_module"
    ];
    
    protected $relationFieldInject = [
        "id_role" => "id_role",
        "id_module" => "icon"
    ];

    
}