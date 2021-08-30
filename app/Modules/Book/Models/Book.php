<?php

namespace App\Modules\Book\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class Book extends BaseModel
{
    use UseUUID;
    protected $table = 'book';
    protected $primaryKey = "id_book";
    protected $fillable = [
        "title",
        "description",
        'id_author',
        'allow_pinjam'
    ];

    protected $relationField = [
        'id_author' => 'author.id_author'
    ];

    protected $relationFieldInject = [
        'id_author' => 'name'
    ];
}
