<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->increments('code');
            $table->string('name');
            $table->string('name_en');

            $table->index('code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
