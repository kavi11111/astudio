<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    // one-many relation with AttributeValue
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
