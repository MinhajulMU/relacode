<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Sanctum\HasApiTokens;


class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use  HasApiTokens,SoftDeletes, Authenticatable, Authorizable, HasFactory;
    public $incrementing = false; 
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public $primaryKey = "id_user";

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_role', 'id_user', 'id_role')->wherePivot('deleted_at',null);
    }
}
