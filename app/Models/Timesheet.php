<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'date',
        'hours',
        'user_id',
        'project_id',
    ];

    // many-many relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // many-one relation with Project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
