<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    public function up()
    {
        
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('institution_id');
            $table->string('title');
            $table->text('details');
            $table->string('document'); // To store the PDF file path
            $table->boolean('published')->default(false); // Published status
            $table->timestamps();

            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('admissions');
    }
}
