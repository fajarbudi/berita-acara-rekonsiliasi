<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcaraBelanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acara_belanjas', function (Blueprint $table) {
            $table->id('berita_acara_belanja_id');
            $table->unsignedBigInteger('berita_acara_id');
            $table->unsignedBigInteger('belanja_id');
            $table->string('belanja_nama');
            $table->string('belanja_uraian');
            $table->decimal('skpd', 15, 2);
            $table->decimal('bud', 15, 2);
            $table->decimal('selisih', 15, 2);
            $table->string('keterangan')->nullable();
            $table->unique(['berita_acara_id', 'belanja_uraian'], 'ba_belanja_unique');
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
        Schema::dropIfExists('berita_acara_belanjas');
    }
}
