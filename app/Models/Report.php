<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable = [
        'polres_id',
        'polsek_id',
        'nomor',
        'reporter_name',
        'reporter_address',
        'reporter_phone',
        'issue',
        'category_id',
        'reporter_date',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function polres()
    {
        return $this->belongsTo(Institution::class, 'polres_id');
    }

    public function polsek()
    {
        return $this->belongsTo(Institution::class, 'polsek_id');
    }

    
}