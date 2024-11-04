<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationsTable extends Migration
{
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Foreign key to courses table
            $table->string('subject_name'); // The subject for the qualification
            $table->json('needed_grades'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qualifications');
    }
}

