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
        Schema::table('replace_old_materials', function (Blueprint $table) {
            // === add column
            $table->string('replaceRequestID')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('replace_old_materials', function (Blueprint $table) {
            // === drop  column
            $table->dropColumn('replaceRequestID');
        });
    }
};
