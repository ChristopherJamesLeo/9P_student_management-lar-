<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> string("provider")->nullable()->after("email");
            $table -> string("provider_id")->nullable()->after("provider");
            $table -> string("password")->nullable()->change();
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table -> dropColumn("provider");
            $table -> dropColumn("provider_id");

            $table -> string("password")->change();
        });
    }
};
