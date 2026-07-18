<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acaras', function (Blueprint $table) {
            $table->id('berita_acara_id');
            $table->string('berita_acara_no_bud', 100);
            $table->string('berita_acara_no_skpd', 100);
            $table->string('berita_acara_tanggal', 100);
            $table->string('berita_acara_tahun_anggaran', 100);
            $table->string('berita_acara_periode', 100);
            $table->string('berita_acara_hari', 100);
            $table->string('berita_acara_tempat', 100);
            $table->longText('berita_acara_kesimpulan')->nullable();
            $table->integer('skpd_id');
            $table->string('berita_acara_nama_ppk')->nullable();
            $table->string('berita_acara_nip_ppk')->nullable();
            $table->string('berita_acara_nama_pa')->nullable();
            $table->string('berita_acara_nip_pa')->nullable();
            $table->string('berita_acara_sp2dLS_skpd')->nullable();
            $table->string('berita_acara_sp2dLS_bud')->nullable();
            $table->string('berita_acara_sp2dLS_selisih')->nullable();
            $table->string('berita_acara_sp2dLS_ket')->nullable();
            $table->string('berita_acara_sp2dUP_skpd')->nullable();
            $table->string('berita_acara_sp2dUP_bud')->nullable();
            $table->string('berita_acara_sp2dUP_selisih')->nullable();
            $table->string('berita_acara_sp2dUP_ket')->nullable();
            $table->string('berita_acara_sts_skpd')->nullable();
            $table->string('berita_acara_sts_bud')->nullable();
            $table->string('berita_acara_sts_selisih')->nullable();
            $table->string('berita_acara_sts_ket')->nullable();
            $table->string('berita_acara_saldo_awal_bulan')->nullable();
            $table->string('berita_acara_penerimaan_sp2d')->nullable();
            $table->string('berita_acara_pengeluaran_bku')->nullable();
            $table->string('berita_acara_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita_acaras');
    }
}
