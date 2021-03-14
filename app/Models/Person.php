<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'surname',
        'second_surname',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
