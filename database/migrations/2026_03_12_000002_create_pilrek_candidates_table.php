<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pilrek_candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();        // Gelar akademik
            $table->string('position')->nullable();     // Jabatan saat ini
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->text('vision')->nullable();         // Visi
            $table->text('mission')->nullable();        // Misi
            $table->text('education')->nullable();      // Riwayat pendidikan (JSON)
            $table->text('experience')->nullable();     // Pengalaman (JSON)
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pilrek_candidates');
    }
};
