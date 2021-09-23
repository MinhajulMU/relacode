<?php

namespace App\Modules\BackupDb\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class BackupDb extends BaseModel{
    use UseUUID;
    protected $table = 'backup_db';
    protected $primaryKey = "id_backup_db";
    protected $fillable = [
        "date",
        "file_name",
        "file_path"
    ];

    protected $relationField = [

    ];
    
    protected $relationFieldInject = [

    ];

    
}