<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('physio');
            $table->unsignedBigInteger('patient');
            $table->unsignedBigInteger('treatment');
            $table->date('date');
            $table->time('time');
            $table->foreign('physio')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('patient')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('treatment')->references('id')->on('treatments')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('appointments');
    }
};
