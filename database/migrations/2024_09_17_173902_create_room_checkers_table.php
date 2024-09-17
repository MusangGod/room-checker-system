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
        Schema::create('room_checkers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('date');
            $table->time('time');
            $table->string('user_id');
            $table->string('staff_id');
            $table->string('image');
            $table->enum('status', ['done', 'progress', 'not_started'])->default('not_started');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_checkers');
    }
};
