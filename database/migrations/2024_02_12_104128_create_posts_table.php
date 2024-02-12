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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->date("startdate");
            $table->date("enddate");
            $table->time("starttime");
            $table->time("endtime");
            $table->decimal("fee",8,2)->default(0);
            $table->string("image")->nullable();
            $table->longText("content")->nullable();
            $table->string("slug");
            $table->unsignedBigInteger("tag_id");
            $table->unsignedBigInteger("type_id");
            $table->unsignedBigInteger("attshow")->default(3);
            $table->unsignedBigInteger("status_id")->default(1);
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
