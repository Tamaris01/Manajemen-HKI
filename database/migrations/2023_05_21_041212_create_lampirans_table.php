<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lampiran', function (Blueprint $table) {
            $table->id();
            $table->string("hak_cipta_id",11);
            $table->foreign('hak_cipta_id')->references('id')->on('hak_cipta')->onDelete('CASCADE');
            $table->string("ktp");
            $table->string("contoh_ciptaan_file");
            $table->string("contoh_ciptaan_link",100);
            //$table->string("bukti_bayar");
            $table->string("surat_pernyataan");
            $table->string("bukti_pengalihan");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampirans');
    }
};
