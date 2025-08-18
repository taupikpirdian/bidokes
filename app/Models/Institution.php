<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'parent_id',
        'code',
        'name',
        'level',
    ];

    public function children()
    {
        return $this->hasMany(Institution::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Institution::class, 'parent_id');
    }
}
