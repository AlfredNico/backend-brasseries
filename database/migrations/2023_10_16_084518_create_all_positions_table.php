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
        Schema::create('all_positions', function (Blueprint $table) {
            $table->increments("ids");
            $table->integer('last_driver')->nullable()->unsigned();
            $table->integer('vehicle_id')->nullable()->unsigned();
            $table->string('position_name');
            $table->double('longs')->nullable();
            $table->double('lats')->nullable();
            $table->timestamp('dates')->useCurrent();
            $table->string('odometer');
            $table->timestamps();

            $table->foreign('last_driver')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('vehicle_id')->references('ids')->on('vehicles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_positions');
    }
};
