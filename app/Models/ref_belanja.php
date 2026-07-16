<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_belanja extends Model
{
    use HasFactory;

    protected $primaryKey = "belanja_id";

    protected $fillable = [
        'belanja_nama',
        'belanja_uraian'
    ];
}
