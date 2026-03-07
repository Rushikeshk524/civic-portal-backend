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
        Schema::create('complaint_status_history', function (Blueprint $table) {
            $table->id('history_id');
            $table->unsignedBigInteger('complaint_id');
            $table->unsignedBigInteger('changed_by');
            $table->enum('old_status', ['pending','in_progress','resolved'])->nullable();
            $table->enum('new_status',['pending','in_progress','resolved']);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('complaint_id')->references('complaint_id')->on('complaints')->onDelete('cascade');
            $table->foreign('changed_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_status_history');
    }
};
