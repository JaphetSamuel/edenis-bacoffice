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
        Schema::create('kycs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('adresse')->nullable();
            $table->string('ville');
            $table->string('pays');
            $table->string('lieu_naissance');
            $table->date('date_naissance');
            $table->string('nationalite');
            $table->string('profession');
            $table->string('type_piece');
            $table->string('piece_identite');
            $table->string('numero_piece_identite');
            $table->string('photo');
            $table->string('signature');
            $table->string('numero_telephone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kycs');
    }
};
