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
        Schema::create('signs', function (Blueprint $table) {
            $table->id('sign_id');
            $table->unsignedBigInteger('road_id');
            $table->string('sign_type', 50);
            $table->date('installation_date');
            $table->date('expiry_date');
            $table->timestamps();

            $table->foreign('road_id')->references('RoadID')->on('roads')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signs');
    }
};
