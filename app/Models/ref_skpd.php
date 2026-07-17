<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_skpd extends Model
{
    use HasFactory;

    protected $primaryKey = "skpd_id";

    protected $fillable = [
        'skpd_nama',
        'skpd_singkatan',
        'skpd_nama_ppk',
        'skpd_nip_ppk',
        'skpd_nama_pa',
        'skpd_nip_pa'
    ];
}
