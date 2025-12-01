<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('mentor_id')->nullable()->after('user_id');
            $table->foreign('mentor_id')->references('id')->on('mentors')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['mentor_id']);
            $table->dropColumn('mentor_id');
        });
    }
};
