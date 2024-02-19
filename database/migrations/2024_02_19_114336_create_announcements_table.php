<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table -> string("image")->nullable();
            $table -> string("title");
            $table -> text("message");
            $table -> unsignedBigInteger("status_id")->default(8);
            $table -> foreignId("post_id")->constrained("posts")->onUpdate("cascade")->onDelete("cascade");
            $table -> foreignId("user_id")->constrained("users")->onUpdate("cascade")->onDelete("cascade");
            $table -> foreignId("role_id")->constrained("roles")->onUpdate("cascade")->onDelete("cascade");
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
