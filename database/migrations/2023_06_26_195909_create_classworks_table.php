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
        Schema::create('classworks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('classroom_id');
            $table->string('title');
            $table->integer('grade');
            $table->text('instructions')->nullable();
            $table->enum('status',['completed','not_started','in_progress'])->default('material');
            $table->enum('type',['material','assignment'])->default('material');
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classworks');
    }
};
