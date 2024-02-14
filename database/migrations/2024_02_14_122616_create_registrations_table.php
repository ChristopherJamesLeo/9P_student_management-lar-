<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string("reg_no");
            $table->foreignId("registrable_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->string("registrable_type");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
