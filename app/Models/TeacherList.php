<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'teachers_list';

    protected $fillable = ['uuid', 'original_name', 'assigned_name'];

    protected $appends = ['people'];

    public function getPeopleAttribute()
    {
        return $this->people()->count();
    }

    public function people()
    {
        return $this->hasMany('App\Models\Person', 'file_id', 'id');
    }

}
