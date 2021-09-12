<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Users extends BaseModel{
    use UseUUID;
    protected $table = 'users';
    protected $primaryKey = "id_user";
    protected $fillable = [
        "name",
        "email",
        "password",
        "photo_path",
        "remember_token"
    ];

    protected $relationField = [

    ];
    
    protected $relationFieldInject = [

    ];
    
    public function roles()
    {
        return $this->belongsToMany('App\Modules\Role\Models\Role', 'user_role', 'id_user', 'id_role')->wherePivot('deleted_at',null);
    }
    
}