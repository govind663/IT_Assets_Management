<?php

use App\Models\Catagories;
use App\Models\Unit;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique()->nullable();
            $table->string('name');
            $table->foreignIdFor(Catagories::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Unit::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('brand');
            $table->string('mobile_no');
            $table->text('description');
            $table->integer('is_available')->default(1)->comment('0: Not Available, 1: Available'); //0-Not Available, 1-Available
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
        Schema::dropIfExists('products');
    }
};
