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
            $table->integer('usertype_id')->nullable()->unsigned();
            $table->integer('departement_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('username')->unique();
            $table->boolean('is_activated')->default(0);
            $table->string('passwd');
            $table->timestamp('dates')->nullable();
            // $table->timestamp('dates')->useCurrent();
            $table->string('cle_user')->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamp('expires_at_token')->nullable();


            $table->timestamps();
            $table->foreign('usertype_id')->references('ids')->on('user_types')->cascadeOnUpdate()->cascadeOnDelete();
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
