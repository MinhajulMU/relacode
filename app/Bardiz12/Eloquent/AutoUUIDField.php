<?php

namespace App\Bardiz12\Eloquent;

use Illuminate\Support\Str;

/**
 * AutoUUIDField
 * author   : @bardiz12
 * github   : https://github.com/bardiz12
 * web      : https://bardiz.digital
 * phone    : 085712503009
 * email    : dizba.seller@gmail.com
 * You can use this Library Freely, but dont delete the author's comments. :).
 */
trait AutoUUIDField
{
    protected $uuid_fields = null;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if(is_array($model->getUUIDFields())){
                foreach($model->getUUIDFields() as $field){
                    $model->{$field} = (string) Str::uuid();
                }
            }
        });
    }

    public function getUUIDFields(){
        return $this->uuid_fields;
    }

    
}