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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الدكتور
            $table->string('email')->unique(); // البريد الإلكتروني
            $table->foreignId('specialty_id')->constrained()->cascadeOnDelete();
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->decimal('consultation_fee', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
