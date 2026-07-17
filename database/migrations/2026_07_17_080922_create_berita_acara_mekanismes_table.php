<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcaraMekanismesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acara_mekanismes', function (Blueprint $table) {
            $table->id('berita_acara_mekanisme_id');
            $table->unsignedBigInteger('berita_acara_id');
            $table->unsignedBigInteger('mekanisme_id');
            $table->string('mekanisme_nama');
            $table->string('mekanisme_uraian');
            $table->decimal('skpd', 15, 2);
            $table->decimal('bud', 15, 2);
            $table->decimal('selisih', 15, 2);
            $table->string('keterangan')->nullable();
            $table->unique(['berita_acara_id', 'mekanisme_uraian'], 'ba_mekanisme_unique');
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
        Schema::dropIfExists('berita_acara_mekanismes');
    }
}
