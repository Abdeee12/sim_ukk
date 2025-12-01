<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('laporan_harians', function (Blueprint $table) {
            $table->string('mentor_signature')->nullable()->after('path_bukti');
        });
    }

    public function down()
    {
        Schema::table('laporan_harians', function (Blueprint $table) {
            $table->dropColumn('mentor_signature');
        });
    }
};
