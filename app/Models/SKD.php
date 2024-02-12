<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKD extends Model
{
    use HasFactory;

    protected $table = 'skds';
    protected $guarded = ['id'];
    protected $load = ['patient', 'doctor'];
    protected $with = ['signed_skds'];

    function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id')->withDefault();
    }

    function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id')->withDefault();
    }

    function signed_skds()
    {
        return $this->belongsTo(SignedSKD::class, 'skd_id')->withDefault();
    }
}
