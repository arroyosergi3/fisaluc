<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->longText('google_access_token')->nullable()->change();
    });
}


public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->varchar('google_access_token')->change(); // O lo que tuvieras antes
    });
}

};
