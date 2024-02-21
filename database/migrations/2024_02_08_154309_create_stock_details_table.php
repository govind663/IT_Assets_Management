<?php

use App\Models\Catagories;
use App\Models\Product;
use App\Models\Stock;
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
        Schema::create('stock_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Stock::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Catagories::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Product::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('product_code')->unique()->nullable();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->foreignIdFor(Unit::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->date('warranty_dt')->nullable();
            $table->string('quantity')->nullable();
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
        Schema::dropIfExists('stock_details');
    }
};
