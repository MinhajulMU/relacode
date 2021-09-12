<?php

namespace App\Modules\MenuGrup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class MenuGrup extends BaseModel{
    use UseUUID;
    protected $table = 'menu_grup';
    protected $primaryKey = "id_menu_grup";
    protected $fillable = [
        "nm_menu_grup",
        "icon",
        "urutan"
    ];

    protected $relationField = [

    ];
    
    protected $relationFieldInject = [

    ];

    
}