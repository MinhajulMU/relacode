<?php

namespace App\Modules\Config\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Config extends BaseModel{
    use UseUUID;
    protected $table = 'config';
    protected $primaryKey = "id_config";
    protected $fillable = [
        "key",
        "value"
    ];

    protected $relationField = [

    ];
    
    protected $relationFieldInject = [

    ];

    
}