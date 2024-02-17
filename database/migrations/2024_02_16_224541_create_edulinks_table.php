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
        Schema::create('edulinks', function (Blueprint $table) {
            $table->id();
            $table -> foreignId("post_id")->constrained("posts")->onUpdate("cascade")->onDelete("cascade");
            $table -> foreignId("tag_id")->constrained("tags")->onUpdate("cascade")->onDelete("cascade");

            $table -> date("classdate");
            $table -> string("link");
            $table -> unsignedBigInteger("status_id")->default(7)->comment("7=public/8=private");
            $table -> unsignedBigInteger("stage_id")->default(12)->comment("11=verifying/12=verified");
            $table -> unsignedBigInteger("user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edulinks');
    }
};
