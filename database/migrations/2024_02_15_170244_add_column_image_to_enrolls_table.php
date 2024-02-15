<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('enrolls', function (Blueprint $table) {
            $table -> string("image")->after("id");
            $table -> unsignedBigInteger("admit_by")->after("user_id")->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('enrolls', function (Blueprint $table) {
            $table -> dropColumn("image");
            $table -> dropColumn("admit_by");
        });
    }
};
