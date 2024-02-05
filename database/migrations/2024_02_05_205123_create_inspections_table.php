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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id('inspection_id');
            $table->unsignedBigInteger('road_id');
            $table->unsignedBigInteger('inspector_id');
            $table->date('inspection_date');
            $table->json('surface_malformations');
            $table->json('sign_damages');
            $table->json('safety_device_damages');
            // Add other inspection attributes
            $table->timestamps();

            $table->foreign('road_id')->references('RoadID')->on('roads')->onDelete('cascade');
            $table->foreign('inspector_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
