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

            // === status operated  by the Department Clerk ===
            $table->boolean('is_processed_by_clerk')->default(0)
            ->comment('
            0 - material isn`t processed yet,
            1 - material is processed by clerk,
            2 - material processing was rejected by clerk,
            3 - material delivered  to the department for further processing
            ')->after('rejection_reason_by_hod');
            $table->date('checked_by_clerk_at')->nullable()->after('is_processed_by_clerk');
            $table->text('rejection_reason_by_clerk')->nullable()->after('checked_by_clerk_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new_materials', function (Blueprint $table) {
            $table->dropColumn([
                'is_processed_by_clerk',
                'checked_by_clerk_at',
                'rejection_reason_by_clerk'
            ]);
        });
    }
};
