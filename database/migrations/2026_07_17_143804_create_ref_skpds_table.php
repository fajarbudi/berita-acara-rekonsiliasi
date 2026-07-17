<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefSkpdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_skpds', function (Blueprint $table) {
            $table->id('skpd_id');
            $table->string('skpd_nama');
            $table->string('skpd_singkatan', 55);
            $table->string('skpd_nama_ppk');
            $table->string('skpd_nip_ppk');
            $table->string('skpd_nama_pa');
            $table->string('skpd_nip_pa');
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
        Schema::dropIfExists('ref_skpds');
    }
}
