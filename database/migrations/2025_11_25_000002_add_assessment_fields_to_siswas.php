<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->unsignedTinyInteger('final_discipline')->nullable()->after('tempat_magang');
            $table->unsignedTinyInteger('final_performance')->nullable()->after('final_discipline');
            $table->unsignedTinyInteger('final_communication')->nullable()->after('final_performance');
            $table->text('assessment_note')->nullable()->after('final_communication');
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn(['final_discipline','final_performance','final_communication','assessment_note']);
        });
    }
};
