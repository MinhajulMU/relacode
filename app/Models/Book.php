<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Bardiz12\BaseModel;

class Book extends BaseModel
{
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
