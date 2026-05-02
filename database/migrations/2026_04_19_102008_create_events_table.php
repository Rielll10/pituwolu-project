<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['promo', 'event'])->default('event');   // Promo atau Event
            $table->string('title');                                        // Judul
            $table->text('description')->nullable();                        // Deskripsi
            $table->string('image')->nullable();                            // Foto
            $table->string('badge')->nullable();                            // Label badge, mis: "Promo ☕", "Event 🎉"
            $table->date('start_date')->nullable();                         // Mulai
            $table->date('end_date')->nullable();                           // Sampai
            $table->string('link')->nullable();                             // Link opsional (Instagram, dll)
            $table->boolean('is_active')->default(true);                    // Aktif/hidden
            $table->integer('sort_order')->default(0);                      // Urutan tampil
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
