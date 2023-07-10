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
        Schema::create('hak_cipta', function (Blueprint $table) {
            $table->string('id', 11)->primary();
            $table->string("pemohon_id", 11)->nullable();
            $table->foreign('pemohon_id')->references('id')->on('pemohon')->onDelete('CASCADE');
            $table->string("admin_id", 11)->nullable();
            $table->foreign('admin_id')->references('id')->on('admin')->onDelete('CASCADE');
            //$table->string("jenis_permohonan",30);
            $table->string("jenis_ciptaan", 50);
            $table->string("sub_jenis_ciptaan", 50);
            $table->string("judul", 50);
            $table->string("uraian_singkat", 100);
            $table->date("tanggal_pertama");
            $table->string("kota_pertama", 30);
            $table->text("keterangan")->nullable();
            $table->bigInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hak_ciptas');
    }
};
