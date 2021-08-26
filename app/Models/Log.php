<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'log';
    protected $primaryKey = 'id_log';

    protected $fillable = [
        'id_user',
        'aktifitas',
        'raw_data'
    ];

    public static function aktivitas($aktivitas)
    {
        $data = new Log();
        $data->id_user = Auth::user()->id_user;
        $data->aktifitas = $aktivitas;
        $data->save();
    }
}
