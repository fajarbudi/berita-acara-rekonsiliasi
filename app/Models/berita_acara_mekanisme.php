<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita_acara_mekanisme extends Model
{
    use HasFactory;

    protected $primaryKey = "berita_acara_mekanisme_id";

    protected $fillable = [
        'berita_acara_id',
        'mekanisme_id',
        'mekanisme_nama',
        'mekanisme_uraian',
        'skpd',
        'bud',
        'selisih',
        'keterangan'
    ];
}
