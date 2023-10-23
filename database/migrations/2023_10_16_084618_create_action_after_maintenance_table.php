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
        Schema::create('action_after_maintenances', function (Blueprint $table) {
            $table->increments("ids");
            $table->timestamp('dates')->nullable();
            $table->integer('status_diagnostic_id')->nullable()->unsigned();
            $table->integer('status_maintenance_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('status_diagnostic_id')->references('ids')->on('statuses')->cascadeOnDelete();
            $table->foreign('status_maintenance_id')->references('ids')->on('statuses')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_after_maintenances');
    }
};
