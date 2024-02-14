<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table -> foreignId("post_id")->constrained("posts")->onUpdate("cascade")->onDelete("cascade");
            $table -> unsignedBigInteger("stage_id")->default(2);
            
            $table -> foreignId("user_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrolls');
    }
};
