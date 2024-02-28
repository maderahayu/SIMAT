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
        Schema::create('tblLampiran', function (Blueprint $table) {
            $table->increments('lampiranId');
            $table->integer('tugasId')->unsigned();
            $table->integer('userId')->unsigned();
            $table->string('namaFile');
            $table->timestamps();
        });

        Schema::table('tblLampiran', function (Blueprint $table) {
            $table->foreign('tugasId')->references('tugasId')->on('tblTugas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tblLampiran');

    }
};
