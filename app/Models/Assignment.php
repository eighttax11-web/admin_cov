<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'person_id', 'grade_id', 'group_id', 'career_id', 'modality_id', 'campus_id', 'period_id', 'year', 'status'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
