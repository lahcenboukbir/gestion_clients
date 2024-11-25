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
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('company');
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->enum('status', ['new', 'interested', 'not_interested', 'customer'])->default('new');
            $table->string('city')->nullable();
            $table->string('activity')->nullable();
            $table->string('ice')->nullable();
            $table->string('comment')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prospects');
    }
};
