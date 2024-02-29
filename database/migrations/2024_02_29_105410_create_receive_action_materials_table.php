<?php

use App\Models\Catagories;
use App\Models\Department;
use App\Models\NewMaterial;
use App\Models\Product;
use App\Models\Role;
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
        Schema::create('receive_action_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NewMaterial::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('mobile_no')->nullable();
            $table->foreignIdFor(Department::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->string('gender')->nullable();
            $table->foreignIdFor(Role::class)->index()->nullable()->constrained()->onDelete('cascade');
            $table->dateTime('date_time_of_receive')->nullable();

            // ===  below is for tracking status of receive action materials ===
            $table->integer('is_confirmed')->default(0)->nullable()->comment('0 -  not confirmed yet, 1 - confirmed by department clerk,');

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
        Schema::dropIfExists('receive_action_materials');
    }
};
