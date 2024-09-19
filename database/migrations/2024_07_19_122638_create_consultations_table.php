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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('contact')->nullable();
            $table->string('residence')->nullable();
            $table->string('profession');
            $table->string('age');
            $table->string('trancheAge');
            $table->string('assure')->nullable();
            $table->text('motifConsultation')->nullable();
            $table->string('poids')->nullable();
            $table->string('temperature')->nullable();
            $table->string('tensionArterielle')->nullable();
            $table->string('pouls')->nullable();
            $table->text('histoireMaladie')->nullable();
            $table->text('hypotheseDiagnostic')->nullable();
            $table->string('miseObservation')->nullable();
            $table->string('refere')->nullable();
            $table->text('traitement')->nullable();
            $table->date('dateConsultation');
            $table->string('service');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
