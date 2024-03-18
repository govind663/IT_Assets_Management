<?php

use App\Models\Vendor;
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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique()->nullable()->comment('Invoice number or reference code for this stock entry');
            $table->foreignIdFor(Vendor::class)->index()->nullable()->constrained()->onDelete('cascade')->comment('Vendors Company Name List');
            $table->date('inward_dt')->comment('Inward date and time of stock entry');
            $table->string('work_order_no')->unique()->nullable();
            $table->string('voucher_no');
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
        Schema::dropIfExists('stocks');
    }
};
