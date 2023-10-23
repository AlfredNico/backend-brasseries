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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments("ids");
            $table->integer('departement_id')->nullable()->unsigned(); // departementid
            $table->integer('status_vehicle_id')->nullable()->unsigned(); // status
            $table->string('name'); // name

            $table->timestamps();
            $table->foreign('departement_id')->references('ids')->on('departements')->cascadeOnDelete();
            $table->foreign('status_vehicle_id')->references('ids')->on('statuses')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
