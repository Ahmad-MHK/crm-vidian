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
        Schema::create('test01s', function (Blueprint $table) {
            $table->id();
            $table->string('debiteurnaam');
            $table->string('Bedrijf_user');
            $table->string('Kvk');
            $table->string('Btw');
            $table->string('Db');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test01s');
    }
};
