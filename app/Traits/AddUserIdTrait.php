<?php

namespace App\Traits;

trait AddUserIdTrait
{

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if(! $model->user_id && auth()->user()) {
                $model->user_id = auth()->user()->id;
            }
        });
    }

}