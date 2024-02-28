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
        Schema::create('tblSupervisor', function (Blueprint $table) {
            $table->increments('supervisorId');
            $table->integer('userId')->unsigned();
            $table->string('namaSupervisor');
            $table->string('fotoProfil')->nullable();
            $table->string('noTelp');
            $table->timestamps();
        });

        Schema::table('tblSupervisor', function (Blueprint $table) {
            $table->foreign('userId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblSupervisor');
    }
};
