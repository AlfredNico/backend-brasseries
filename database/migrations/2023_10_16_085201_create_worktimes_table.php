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
        Schema::create('worktimes', function (Blueprint $table) {
            $table->increments("ids");
            $table->integer('vehicle_id')->nullable()->unsigned();
            $table->integer('driver_id')->nullable()->unsigned();
            $table->timestamp('date_init')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->string('position_init');
            $table->string('position_end');
            $table->double('long_init')->nullable();
            $table->double('lat_init')->nullable();
            $table->double('long_end')->nullable();
            $table->double('lat_end')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('vehicle_id')->references('ids')->on('vehicles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worktimes');
    }
};
