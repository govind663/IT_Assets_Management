<?php

use App\Models\Stock;
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
        Schema::table('request_material_products', function (Blueprint $table) {
            // == add column stock id to request material product table
            $table->foreignIdFor(Stock::class)->index()->nullable()->constrained()->onDelete('cascade')->after('new_material_id');
            $table->string('work_order_no')->nullable()->after('product_code');
            $table->string('currentquantity')->nullable()->comment('Current quantity in stock')->after('work_order_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_material_products', function (Blueprint $table) {
            // ==  drop work order no from request material product table
            $table->dropColumn([
                'stock_id',
                'work_order_no',
                'currentquantity'
            ]);
        });
    }
};
