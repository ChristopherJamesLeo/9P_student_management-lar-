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
        Schema::create('dayables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("day_id");
            $table->unsignedBigInteger("dayable_id");
            $table->string("dayable_type");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dayables');
    }
};
