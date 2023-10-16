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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments("ids");
            $table->integer('init_user')->nullable()->unsigned();
            $table->integer('vehicle_id')->nullable()->unsigned();
            $table->string('init_comments');
            $table->integer('real_maintenance_status')->nullable()->unsigned();
            $table->timestamp('date_receiving')->useCurrent();
            $table->integer('receive_user')->nullable()->unsigned();
            $table->integer('init_status_by_receiver')->nullable()->unsigned();
            $table->integer('end_status_by_end_user')->nullable()->unsigned();
            $table->timestamp('date_init')->useCurrent();
            $table->timestamp('date_end_by_end_user')->useCurrent();
            $table->integer('end_user')->nullable()->unsigned();
            $table->string('end_comments');
            $table->string('recever_comments');
            $table->string('other_comments');
            $table->timestamp('estimate_end_times')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
