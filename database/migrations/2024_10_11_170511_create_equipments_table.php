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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('consultation_id')->constrained('consultations')->onDelete('cascade');
            $table->foreignId('equipment_name_id')->constrained('equipment_names');
            $table->foreignId('equipment_type_id')->constrained('equipment_types');
            $table->integer('quantity')->unsigned();
            $table->string('serial_number')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipments');
    }
};
