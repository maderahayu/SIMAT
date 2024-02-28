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
        Schema::create('tblPemagang', function (Blueprint $table) {
            $table->increments('pemagangId');
            $table->integer('userId')->unsigned();
            $table->integer('kelompokId')->unsigned();
            $table->integer('supervisorId')->unsigned();
            $table->string('namaPemagang');
            $table->string('namaUniversitas');
            $table->string('fotoProfil');
            $table->date('tglMulai')->nullable();
            $table->date('tglSelesai')->nullable();
            $table->string('noTelp');
            $table->timestamps();
        });

        Schema::table('tblPemagang', function (Blueprint $table) {
            $table->foreign('userId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kelompokId')->references('kelompokId')->on('tblKelompok')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('supervisorId')->references('supervisorId')->on('tblSupervisor')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblPemagang');
    }
};
