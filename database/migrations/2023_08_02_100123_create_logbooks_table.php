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
        Schema::create('tblLogbook', function (Blueprint $table) {
            $table->increments('logbookId');
            $table->integer('tugasId')->unsigned();
            $table->integer('pemagangId')->unsigned();
            $table->date('tglLogbook');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('tugasId')->references('tugasId')->on('tblTugas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pemagangId')->references('pemagangId')->on('tblPemagang')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblLogbooks');
    }
};
