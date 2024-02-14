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
        Schema::table('users', function (Blueprint $table) {
            $table -> unsignedBigInteger("gender_id")->default(3)->after("email");
            $table -> unsignedBigInteger("role_id")->default(3)->after("gender_id");
            $table -> unsignedBigInteger("city_id")->default(1)->nullable()->after("role_id");
            $table -> unsignedBigInteger("country_id")->default(1)->nullable()->after("city_id");
            $table -> unsignedBigInteger("status_id")->default(1)->after("country_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> dropColumn("gender_id");
            $table -> dropColumn("role_id");
            $table -> dropColumn("city_id");
            $table -> dropColumn("country_id");
            $table -> dropColumn("status_id");
        });
    }
};
