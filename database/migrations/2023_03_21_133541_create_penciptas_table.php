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
        Schema::create('pencipta', function (Blueprint $table) {
            $table->id();
            $table->string("hak_cipta_id",11);
            $table->foreign('hak_cipta_id')->references('id')->on('hak_cipta')->onDelete('CASCADE');
            $table->string("nama",30);
            $table->string("alamat",50);
            $table->string("kode_pos",6);
            $table->string("provinsi",50);
            $table->string("kota",50);
            $table->string("email",50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penciptas');
    }
};
