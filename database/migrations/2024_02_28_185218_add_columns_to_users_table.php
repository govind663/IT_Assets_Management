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
        Schema::table('users', function (Blueprint $table) {
            // ==== Add gender column  to users table =====
            $table->string('gender')->nullable()->after('department_id')->comment('
            1 - Male,
            2 - Female,
            3 - Other
            ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //  Remove gender column from users table
            $table->dropColumn('gender');
        });
    }
};
