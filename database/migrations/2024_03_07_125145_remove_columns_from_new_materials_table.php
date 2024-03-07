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
        Schema::table('new_materials', function (Blueprint $table) {
            $table->dropColumn(['is_approved_by_admin', 'approval_made_at', 'rejection_reason_by_admin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new_materials', function (Blueprint $table) {
            $table->boolean('is_approved_by_admin')->default(false);
            $table->dateTime('approval_made_at');
            $table->text('rejection_reason_by_admin')->nullable();
        });
    }
};
