<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita_acara_pendapatan extends Model
{
    use HasFactory;

    protected $primaryKey = "berita_acara_pendapatan_id";

    protected $fillable = [
        'berita_acara_id',
        'rekening_id',
        'rekening_kode',
        'rekening_uraian',
        'skpd',
        'bud',
        'selisih',
        'keterangan'
    ];
}
