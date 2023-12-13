<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Pest\Laravel\json;

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
            $table->string('bedrijfsNaam')->nullable();
            $table->string('Bedrijf_user');
            $table->string('Kvk')->nullable();
            $table->string('Btw')->nullable();
            $table->string('Db')->nullable();
            $table->string('Domain')->nullable();
            $table->string('Email')->nullable();
            $table->string('Phone')->nullable();
            $table->string('UserName')->nullable();
            $table->string('Password')->nullable();
            $table->json("InlogNaam")->nullable();
            $table->json("Note")->nullable();
            $table->json("Status")->nullable();
            $table->string('Algemeen')->nullable();
            $table->string('Contactpersonen')->nullable();
            $table->string('LogBoek')->nullable();
            $table->string('inlogGegevens')->nullable();
            $table->longText('Notes')->nullable()->default('text');
            $table->string('nieuwKlant')->nullable();
            $table->string('nieuwAbonnee')->nullable();
            $table->string('klant')->nullable();
            $table->string('abonnee')->nullable();
            $table->string('opzegd')->nullable();
            $table->string('leverancier')->nullable();
            $table->string('reseller')->nullable();
            $table->string('zakelijkeKlant')->nullable();
            $table->string('overige')->nullable();
            $table->string('geenrelatie')->nullable();
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
