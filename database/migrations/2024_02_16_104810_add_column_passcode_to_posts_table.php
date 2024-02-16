<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table -> string("zoomid")->after("name")->default("366 611 7089");
            $table -> string("passcode")->unique()->after("zoomid");
        });
    }

  
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table -> dropColumn("passcode");
        });
    }
};
