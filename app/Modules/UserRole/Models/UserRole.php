<?php

namespace App\Modules\UserRole\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class UserRole extends BaseModel{
    use UseUUID;
    protected $table = 'user_role';
    protected $primaryKey = "id_user_role";
    protected $fillable = [
        "id_role",
        "id_user"
    ];

    protected $relationField = [
        "id_role" => "role.id_role",
        "id_user" => "users.id_user"
    ];
    
    protected $relationFieldInject = [
        "id_role" => "role_name",
        "id_user" => "name"
    ];

    
}