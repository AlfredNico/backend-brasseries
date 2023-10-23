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
        Schema::create('depart_vehicles', function (Blueprint $table) {
            $table->increments("ids");
            $table->integer('conducteur_id')->nullable()->unsigned();
            $table->integer('attributeur_id')->nullable()->unsigned();
            $table->string('commentaires');
            $table->timestamp('dates')->nullable();
            $table->timestamps();

            $table->foreign('conducteur_id')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('attributeur_id')->references('ids')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depart_vehicles');
    }
};
