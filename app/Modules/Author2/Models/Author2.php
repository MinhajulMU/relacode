<?php

namespace App\Modules\Author2\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Author2 extends BaseModel{
    use UseUUID;
    protected $table = 'author2';
    protected $primaryKey = "id_author2";
    protected $fillable = [
        "name",
        "alamat"
    ];

    protected $relationField = [

    ];
    
    protected $relationFieldInject = [

    ];

    
}