<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->date('cleaning_date');
            $table->enum('status', ['is pending for','user did not clean', 'Bad cleaned', 'Well cleaned', 'Rest Day'])->default('is pending for');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
