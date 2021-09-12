<?php

namespace App\Modules\Role\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

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

    
}