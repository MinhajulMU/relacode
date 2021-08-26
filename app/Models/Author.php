<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Bardiz12\BaseModel;

class Author extends BaseModel
{
    protected $table = 'author';
    protected $primaryKey = "id_author";
    protected $fillable = [
        "name",
        "alamat"
    ];

}
