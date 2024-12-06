<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('qualifications', function (Blueprint $table) {
        $table->unsignedBigInteger('institution_id')->nullable(); // Add the column
        $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('qualifications', function (Blueprint $table) {
        $table->dropForeign(['institution_id']);
        $table->dropColumn('institution_id');
    });
}

};
