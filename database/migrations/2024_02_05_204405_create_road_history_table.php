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
        Schema::create('road_history', function (Blueprint $table) {
            $table->id('HistoryID');
            $table->unsignedBigInteger('RoadID');
            $table->unsignedBigInteger('UpdatedByUserID');
            $table->timestamp('UpdateDate');
            $table->jsonb('GraphChanges');
            $table->jsonb('AttributeChanges');
            $table->timestamps();


            $table->foreign('RoadID')->references('RoadID')->on('roads')->onDelete('cascade');
            $table->foreign('UpdatedByUserID')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_history');
    }
};
