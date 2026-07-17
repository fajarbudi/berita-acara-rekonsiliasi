<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_mekanisme extends Model
{
    use HasFactory;

    protected $primaryKey = "mekanisme_id";

    protected $fillable = [
        'mekanisme_nama',
        'mekanisme_uraian'
    ];
}
