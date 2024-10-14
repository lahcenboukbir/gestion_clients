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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('consultation_id')->constrained('consultations')->onDelete('cascade');
            $table->foreignId('departure_port_id')->constrained('ports');
            $table->foreignId('arrival_port_id')->constrained('ports');
            $table->dateTime('departure_date_time')->nullable();
            $table->dateTime('arrival_date_time')->nullable();
            $table->string('duration')->nullable();
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
