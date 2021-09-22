<?php

namespace App\Modules\RefJnsDokumen\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Bardiz12\Eloquent\UseUUID;
use App\Bardiz12\BaseModel;

class RefJnsDokumen extends BaseModel{
    use UseUUID;
    protected $table = 'ref_jns_dokumen';
    protected $primaryKey = "id_jns_dokumen";
    protected $fillable = [
        "nm_jns_dokumen"
    ];

    protected $relationField = [

    ];
    
    protected $relationFieldInject = [

    ];

    
}