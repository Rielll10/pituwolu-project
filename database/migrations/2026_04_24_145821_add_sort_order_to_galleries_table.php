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
        Schema::table('galleries', function (Blueprint $table) {
            $table->renameColumn('judul', 'title');
            $table->renameColumn('foto', 'image');
            $table->renameColumn('deskripsi', 'description');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->integer('sort_order')->default(0)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->renameColumn('title', 'judul');
            $table->renameColumn('image', 'foto');
            $table->renameColumn('description', 'deskripsi');
        });
    }
};
