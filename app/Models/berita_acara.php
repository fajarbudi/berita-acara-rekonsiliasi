<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class berita_acara extends Model
{
    use HasFactory;

    protected $primaryKey = "berita_acara_id";

    protected $fillable = [
        'berita_acara_no_bud',
        'berita_acara_no_skpd',
        'berita_acara_tanggal',
        'berita_acara_tahun_anggaran',
        'berita_acara_periode',
        'berita_acara_hari',
        'berita_acara_tempat',
        'berita_acara_kesimpulan',
        'skpd_id',
        'berita_acara_nama_ppk',
        'berita_acara_nip_ppk',
        'berita_acara_nama_pa',
        'berita_acara_nip_pa',
    ];
}