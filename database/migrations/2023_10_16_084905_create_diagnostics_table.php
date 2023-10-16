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
            $table->string('commentsdisgnostics');
            $table->timestamp('dates')->useCurrent();
            $table->timestamp('date_validator')->useCurrent();

            $table->integer('disgnostic_user')->nullable()->unsigned();
            $table->integer('user_validator')->nullable()->unsigned();
            $table->integer('statusdisgnostics')->nullable()->unsigned();
            $table->integer('maintenance_id')->nullable()->unsigned();

            $table->timestamps();
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
