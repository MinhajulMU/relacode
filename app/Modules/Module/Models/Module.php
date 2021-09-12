<?php

namespace App\Modules\Module\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Module extends BaseModel{
    use UseUUID;
    protected $table = 'module';
    protected $primaryKey = "id_module";
    protected $fillable = [
        "name",
        "icon",
        "slug",
        "is_show",
        "id_menu_grup",
        "urutan",
        "parent_id"
    ];

    protected $relationField = [
        "id_menu_grup" => "menu_grup.id_menu_grup"
    ];
    
    protected $relationFieldInject = [
        "id_menu_grup" => "nm_menu_grup"
    ];

    public function privileges()
    {
        return $this->hasMany('App\Modules\RolePrivilege\Models\RolePrivilege', 'id_module', 'id_module');
    }
    
    public function rolePrivileges($id_role){
        return $this->privileges()->where('id_role', $id_role)->first();
    }
    
}