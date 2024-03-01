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
        Schema::create('new_materials', function (Blueprint $table) {
            $table->id();
            $table->string('request_no')->nullable()->comment('request no for  this material is generated by admin when he add a new material to request list.');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->string('mobile_no')->unique()->nullable()->comment("The mobile number of the person who added this material,it is not necessarily the one responsible for maintaining or using the material.");
            $table->string('email')->unique()->nullable();
            $table->date('requested_at')->nullable();
            $table->string('material_doc')->comment('Material documentation file link')->nullable()->default(null);
            $table->integer('status')->comment('
                0 - Pending ,
                1 - Approved,
                2 - Rejected,
                3 - Delivered,
                4 - Collected,
                5 - Returned,
                6 - Approved but not yet recived by department clecking team,
                7 - Recived and waiting for approval from manager to mark as delivered,
            ')->default(0);

            // === status operated  by the HOD ===
            $table->integer('is_checked_by_hod')->default(0)->comment('0 - not checked , 1 - checked and approved, 2 - checked and rejected');
            $table->date('checked_by_hod_at')->nullable();
            $table->text('rejection_reason_by_hod')->nullable();

            // === status operated  by the IT Department ===
            $table->integer('is_processed_by_it')->default(0)->comment('0 - not processed yet, 1 - processed  and approved, 2 - processed and rejected');
            $table->date('sent_to_it_at')->nullable();
            $table->text('rejection_reason_by_it')->nullable();

            // === status operated  by the Admin ===
            $table->boolean('is_approved_by_admin')->default(0)->comment('  0 - not yet,
                                                                            1 - approved,
                                                                            2 - rejected,
                                                                            3 - return to product  department for correction
                                                                         ');
            $table->date('approval_made_at')->nullable();
            $table->text('rejection_reason_by_admin')->nullable();

            $table->integer('inserted_by')->nullable();
            $table->timestamp('inserted_at')->nullable();
            $table->integer('modified_by')->nullable();
            $table->timestamp('modified_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_materials');
    }
};
