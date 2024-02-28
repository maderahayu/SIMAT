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
        Schema::create('tblTugas', function (Blueprint $table) {
            $table->increments('tugasId');
            $table->integer('kelompokId')->unsigned();
            $table->integer('supervisorId')->unsigned();
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('status');
            $table->date('tglMulai');
            $table->date('tglSelesai');
            $table->timestamps();
        });

        Schema::table('tblTugas', function (Blueprint $table) {
            $table->foreign('supervisorId')->references('supervisorId')->on('tblSupervisor')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kelompokId')->references('kelompokId')->on('tblKelompok')->onUpdate('cascade')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblTugas');
    }
};
