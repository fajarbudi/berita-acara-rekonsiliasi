<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita_acara_belanja extends Model
{
    use HasFactory;

    protected $primaryKey = "berita_acara_belanja_id";

    protected $fillable = [
        'berita_acara_id',
        'belanja_id',
        'belanja_nama',
        'belanja_uraian',
        'skpd',
        'bud',
        'selisih',
        'keterangan'
    ];
}
