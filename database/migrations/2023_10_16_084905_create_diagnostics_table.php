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
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->increments("ids");
            $table->integer('disgnostic_user')->nullable()->unsigned(); // disgnosticuser
            $table->integer('status_disgnostic_id')->nullable()->unsigned(); // statusdisgnostics
            $table->string('commentsdisgnostics'); // commentsdisgnostics
            $table->integer('maintenance_id')->nullable()->unsigned(); // maintenanceid
            $table->timestamp('dates')->nullable(); // dates
            $table->timestamp('date_validator')->nullable(); // validatordate
            $table->integer('user_validator')->nullable()->unsigned(); // uservalidator

            $table->timestamps();
            $table->foreign('disgnostic_user')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('status_disgnostic_id')->references('ids')->on('statuses')->cascadeOnDelete();
            $table->foreign('maintenance_id')->references('ids')->on('maintenances')->cascadeOnDelete();
            $table->foreign('user_validator')->references('ids')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
    }
};
