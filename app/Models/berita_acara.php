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
        'berita_acara_file',
        'skpd_id',
        'berita_acara_nama_ppk',
        'berita_acara_nip_ppk',
        'berita_acara_nama_pa',
        'berita_acara_nip_pa',
        'berita_acara_nama_kepala_skpkd',
        'berita_acara_nip_kepala_skpkd',
        'berita_acara_jabatan_kepala_skpkd',
        'berita_acara_nama_mengetahui_skpkd',
        'berita_acara_nip_mengetahui_skpkd',
        'berita_acara_jabatan_mengetahui_skpkd',
        'berita_acara_sp2dLS_skpd',
        'berita_acara_sp2dLS_bud',
        'berita_acara_sp2dLS_selisih',
        'berita_acara_sp2dLS_ket',
        'berita_acara_sp2dUP_skpd',
        'berita_acara_sp2dUP_bud',
        'berita_acara_sp2dUP_selisih',
        'berita_acara_sp2dUP_ket',
        'berita_acara_sp2BP_skpd',
        'berita_acara_sp2BP_bud',
        'berita_acara_sp2BP_selisih',
        'berita_acara_sp2BP_ket',
        'berita_acara_sts_skpd',
        'berita_acara_sts_bud',
        'berita_acara_sts_selisih',
        'berita_acara_sts_ket',
        'berita_acara_saldo_awal_bulan',
        'berita_acara_penerimaan_sp2d',
        'berita_acara_pengeluaran_bku',
        'berita_acara_pengembalian',
        'berita_acara_kunci_data'
    ];

    public function skpd()
    {
        return $this->hasOne(ref_skpd::class, 'skpd_id', 'skpd_id');
    }
}