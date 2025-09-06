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
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete(); // ربط بالدكتور
            $table->date('date');         // تاريخ اليوم المتاح
            $table->time('start_time');   // وقت البداية
            $table->time('end_time');     // وقت النهاية
            $table->boolean('is_booked')->default(false); // هل الوقت اتحجز ولا لسه
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
