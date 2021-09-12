<?php

namespace App\Modules\Book2\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Book2 extends BaseModel{
    use UseUUID;
    protected $table = 'book2';
    protected $primaryKey = "id_book2";
    protected $fillable = [
        "title",
        "description",
        "id_author2",
        "allow_pinjam",
        "tanggal_pinjam"
    ];

    protected $relationField = [
        "id_author2" => "author2.id_author2"
    ];
    
    protected $relationFieldInject = [
        "id_author2" => "name"
    ];

    
}