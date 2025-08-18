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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('polres_id')->nullable();
            $table->unsignedBigInteger('polsek_id')->nullable();
            $table->string('nomor')->unique();
            $table->string('reporter_name');
            $table->text('reporter_address')->nullable();
            $table->string('reporter_phone')->nullable();
            $table->text('issue');
            $table->unsignedBigInteger('category_id');
            $table->timestamp('reporter_date');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
