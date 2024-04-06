<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $load = ['partner'];

    function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id')->withDefault();
    }
}
