<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'attribute_id',
        'entity_id',
        'value',
    ];

    // many-one relation with Attribute
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    // many-one relation with Project
    public function project()
    {
        return $this->belongsTo(Project::class, 'entity_id');
    }
}
