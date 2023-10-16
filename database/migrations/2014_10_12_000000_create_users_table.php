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
        Schema::create('users', function (Blueprint $table) {
            $table->increments("ids");
            $table->string('name');
            $table->string('username')->unique();
            $table->boolean('is_activated')->default(0);
            $table->string('passwd');
            $table->timestamp('dates')->useCurrent();
            $table->string('cle_user')->nullable();
            $table->timestamps();


            $table->integer('usertype_id')->nullable()->unsigned();
            $table->foreign('usertype_id')->references('ids')->on('userTypes')->cascadeOnUpdate()->cascadeOnDelete();

            $table->integer('departement_id')->nullable()->unsigned();
            $table->foreign('departement_id')->references('ids')->on('departements')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
