<?php

namespace App\Models;

use App\Traits\AddUserIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, AddUserIdTrait;

    protected $fillable = [
        'name', 'type', 'no_of_employees'
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
