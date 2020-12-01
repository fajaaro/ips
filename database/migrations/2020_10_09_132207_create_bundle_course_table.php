<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleCourseTable extends Migration
{
    public function up()
    {
        Schema::create('bundle_course', function (Blueprint $table) {
            $table->foreignId('bundle_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bundle_course');
    }
}
