<?php

namespace App\Bardiz12\Eloquent;

use Illuminate\Support\Str;

/**
 * UseUUID
 * author   : @bardiz12
 * github   : https://github.com/bardiz12
 * web      : https://bardiz.digital
 * phone    : 085712503009
 * email    : dizba.seller@gmail.com
 * You can use this Library Freely, but dont delete the author's comments. :).
 */
trait UseUUID
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}