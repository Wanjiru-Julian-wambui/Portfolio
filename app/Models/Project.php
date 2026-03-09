<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'project_url',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}