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
        Schema::create('tblKelompok', function (Blueprint $table) {
            $table->increments('kelompokId');
            $table->integer('supervisorId')->unsigned();
            $table->string('namaKelompok');
            $table->timestamps();
        });

        Schema::table('tblKelompok', function (Blueprint $table) {
            $table->foreign('supervisorId')->references('supervisorId')->on('tblSupervisor')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblKelompok');
    }
};
