<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalExamination extends Model
{
    protected $fillable = [
        'nomor',
        'name',
        'gender',
        'pangkat',
        'address',
        'date_of_birth',
        'religion',
        'nrp',
        'kesatuan',
        'score',
        'created_by',
    ];
}
