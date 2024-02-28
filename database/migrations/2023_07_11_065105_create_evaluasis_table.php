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
        Schema::create('tblEvaluasi', function (Blueprint $table) {
            $table->increments('evaluasiId');
            $table->integer('tugasId')->unsigned();
            $table->integer('kelompokId')->unsigned();
            $table->integer('supervisorId')->unsigned();
            $table->string('penilaian');
            $table->string('komentar');
            $table->date('tglEvaluasi');
            $table->timestamps();
        });

        Schema::table('tblEvaluasi', function (Blueprint $table) {
            $table->foreign('tugasId')->references('tugasId')->on('tblTugas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supervisorId')->references('supervisorId')->on('tblSupervisor')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kelompokId')->references('kelompokId')->on('tblKelompok')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblEvaluasi');
    }
};
