<?php

namespace App\Modules\Log\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Log extends BaseModel{
    use UseUUID;
    protected $table = 'log';
    protected $primaryKey = "id_log";
    protected $fillable = [
        "id_user",
        "aktifitas",
        'raw_data'
    ];

    protected $relationField = [
        "id_user" => "users.id_user"
    ];
    
    protected $relationFieldInject = [
        "id_user" => "name"
    ];

    
}