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
        Schema::create('meter_histories', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('reason')->nullable();
            $table->string('community')->nullable();
            $table->string('english_name')->nullable();
            $table->string('comet_id')->nullable();
            $table->date('changed_date')->nullable();
            $table->string('meter_number')->nullable();
            $table->string('household_status')->nullable();
            $table->string('old_community_new_holder')->nullable();
            $table->string('new_community_new_holder')->nullable();
            $table->string('new_holder_name')->nullable();
            $table->string('comet_id_new_holder')->nullable();
            $table->string('old_meter_number_new_holder')->nullable();
            $table->string('new_meter_number_new_holder')->nullable();
            $table->string('status_new_holder')->nullable();
            $table->string('new_community_name')->nullable();
            $table->string('old_meter_number')->nullable();
            $table->string('new_meter_number')->nullable();
            $table->string('main_holder')->nullable();
            $table->string('comet_id_main_holder')->nullable();
            $table->string('meter_number_main_holder')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_histories');
    }
};
