<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function ($pipeline) {
            if(! $pipeline->user_id) {
                $pipeline->user_id = auth()->user()->id;
            }
        });
    }


    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
