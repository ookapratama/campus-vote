<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pilrek_timelines', function (Blueprint $table) {
            $table->id();
            $table->string('phase_name');           // e.g. "Fase I – Penjaringan Bakal Calon"
            $table->integer('phase_order')->default(1);
            $table->string('event_name');            // e.g. "Pembentukan Panitia"
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['selesai', 'berlangsung', 'akan_datang'])->default('akan_datang');
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pilrek_timelines');
    }
};
