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
            $table->integer('vehicle_id')->nullable()->unsigned(); // vehicleid
            $table->integer('init_user')->nullable()->unsigned(); //inituser
            $table->string('init_comments'); //initcomments
            $table->integer('real_maintenance_status_id')->nullable()->unsigned(); // reallmaintenancesstatus
            $table->timestamp('date_receiving')->nullable(); // datereceiving
            $table->integer('receive_user')->nullable()->unsigned(); //receiveuser
            $table->integer('init_status_by_receiver')->nullable()->unsigned(); //initstatusbyreceiver
            $table->integer('end_status_by_end_user')->nullable()->unsigned(); //endstatusbyenduser
            $table->timestamp('date_init')->nullable(); // dateinit
            $table->timestamp('date_end_by_end_user')->nullable(); //datendbyenduser
            $table->integer('end_user')->nullable()->unsigned(); // enduser
            $table->string('end_comments'); // endcomments
            $table->string('recever_comments'); // recevercomments
            $table->string('other_comments'); // othercomments
            $table->timestamp('estimate_end_times')->nullable(); // estimateendtimes

            $table->timestamps();
            $table->foreign('init_user')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('receive_user')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('init_status_by_receiver')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('end_status_by_end_user')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('end_user')->references('ids')->on('users')->cascadeOnDelete();
            $table->foreign('real_maintenance_status_id')->references('ids')->on('statuses')->cascadeOnDelete();
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
