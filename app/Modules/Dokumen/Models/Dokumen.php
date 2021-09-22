<?php

namespace App\Modules\Dokumen\Models;

use ReflectionClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Dokumen extends BaseModel{
    
    use UseUUID;
    protected $table = 'dokumen';
    protected $primaryKey = "id_dokumen";
    protected $fillable = [
        "deskripsi",
        "file_name",
        "file_path",
        "file_size",
        "file_type",
        "id_jns_dokumen",
        "id_model",
        "model"
    ];

    protected $relationField = [

    ];
    
    protected $relationFieldInject = [

    ];

}