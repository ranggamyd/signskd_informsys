<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignedSKD extends Model
{
    use HasFactory;

    protected $table = 'signed_skds';
    protected $guarded = ['id'];
    protected $load = ['skd'];

    function skd()
    {
        return $this->belongsTo(SKD::class, 'skd_id')->withDefault();
    }
}
