<?php

use App\Models\Department;
use App\Models\Product;
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
        Schema::create('replace_old_materials', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no_id')->nullable();
            $table->foreignIdFor(Product::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Department::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('work_order_no')->nullable();
            $table->date('order_dt')->nullable();
            $table->date('supply_dt')->nullable();
            $table->date('return_dt')->nullable();
            $table->text('reason')->nullable();
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
        Schema::dropIfExists('replace_old_materials');
    }
};
