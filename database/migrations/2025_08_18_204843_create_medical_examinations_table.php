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
        Schema::create('medical_examinations', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->string('name');
            $table->string('gender');
            $table->string('pangkat');
            $table->text('address');
            $table->date('date_of_birth');
            $table->string('religion');
            $table->string('nrp');
            $table->string('kesatuan');
            $table->integer('score');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_examinations');
    }
};
