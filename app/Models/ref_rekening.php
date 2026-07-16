<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_rekening extends Model
{
    use HasFactory;

    protected $primaryKey = "rekening_id";

    protected $fillable = [
        'rekening_nama',
        'rekening_kode',
        'rekening_uraian'
    ];
}
