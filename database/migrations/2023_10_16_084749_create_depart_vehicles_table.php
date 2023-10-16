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
            $table->string('commentaires');
            $table->timestamp('dates')->useCurrent();

            $table->integer('conducteur_id')->nullable()->unsigned();
            $table->integer('attributeur')->nullable()->unsigned();

            $table->timestamps();
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
