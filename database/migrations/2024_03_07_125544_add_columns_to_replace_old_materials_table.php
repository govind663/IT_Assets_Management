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
            $table->integer('status')->nullable()->comment('0 - Pending ,
                                                1 - Approved,
                                                2 - Rejected,
                                                3 - Delivered,
                                                4 - Collected,
                                                5 - Returned,
                                                6 - Approved but not yet recived by department clecking team,
                                                7 - Recived and waiting for approval from manager to mark as delivered,
                                            ')->default(0)->after('reason');
          // === status operated  by the HOD ===
          $table->integer('is_checked_by_hod')->nullable()->default(0)->comment('0 - not checked , 1 - checked and approved, 2 - checked and rejected')->after('status');
          $table->date('checked_by_hod_at')->nullable()->after('is_checked_by_hod');
          $table->text('rejection_reason_by_hod')->nullable()->after('checked_by_hod_at');

          // === status operated  by the IT Department ===
          $table->integer('is_processed_by_it')->default(0)->comment('0 - not processed yet, 1 - processed  and approved, 2 - processed and rejected')->after('rejection_reason_by_hod');
          $table->date('sent_to_it_at')->nullable()->after('is_processed_by_it');
          $table->text('rejection_reason_by_it')->nullable()->after('sent_to_it_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('replace_old_materials', function (Blueprint $table) {
            $table->dropColumn([
                'status',
                'is_checked_by_hod',
                'checked_by_hod_at',
                'rejection_reason_by_hod',
                'is_processed_by_it',
                'sent_to_it_at',
                'rejection_reason_by_ it'
            ]);

        });
    }
};
