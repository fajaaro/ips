<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubdistrictsTable extends Migration
{
    public function up()
    {
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->id();
            $table->string('kelurahan', 100);
            $table->string('kecamatan', 100);
            $table->string('city', 100);
            $table->unsignedInteger('province_code');
            $table->char('postal_code', 6);

            $table->index('city');
            $table->index('kecamatan');
            $table->index('province_code');

            $table->foreign('province_code')->references('code')->on('provinces');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subdistricts');
    }
}
