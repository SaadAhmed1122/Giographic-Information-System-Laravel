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
        Schema::create('roads', function (Blueprint $table) {
            $table->id('RoadID');
            $table->string('RoadName', 255);
            $table->string('RoadType', 50);
            $table->geometry('StartLocation'); // Start point
            $table->geometry('EndLocation');   // End point
            $table->json('LinearReferencingPoints')->nullable(); // Linear referencing points
            // Add other road attributes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roads');
    }
};
