<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcaraPendapatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acara_pendapatans', function (Blueprint $table) {
            $table->id('berita_acara_pendapatan_id');
            $table->unsignedBigInteger('berita_acara_id');
            $table->unsignedBigInteger('rekening_id');
            $table->string('rekening_kode');
            $table->string('rekening_uraian');
            $table->decimal('skpd', 15, 2);
            $table->decimal('bud', 15, 2);
            $table->decimal('selisih', 15, 2);
            $table->string('keterangan')->nullable();
            $table->unique(['berita_acara_id', 'rekening_uraian'], 'ba_rekening_unique');
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
        Schema::dropIfExists('berita_acara_pendapatans');
    }
}
