<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function ($contact) {
            if(! $contact->user_id) {
                $contact->user_id = auth()->user()->id;
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->first_name . ' ' . $this->last_name; 
            }
        );
    }

}
