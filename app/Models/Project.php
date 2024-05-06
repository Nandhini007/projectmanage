<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'user_id'
    ];

    public function project()
    {
        return $this->hasMany(Task::class);
    }
}