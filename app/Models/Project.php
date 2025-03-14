<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    // many-many relation with User
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // one-many relation with Timesheet
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    // one-many relation with AttributeValue
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'entity_id');
    }

}
