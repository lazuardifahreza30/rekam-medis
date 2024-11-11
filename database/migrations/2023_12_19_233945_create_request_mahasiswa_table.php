<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_mahasiswa', function (Blueprint $table) {
            $table->integer('rm_id', 1)->nullable();
            $table->string('rm_email',70);
            $table->string('rm_npm', 11);
            $table->integer('rm_semester')->length(1);
            $table->double('rm_ipk', 4, 2);
            $table->integer('rm_sks')->length(3);
            $table->string('rm_tahun_ajaran', 9);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_mahasiswa');
    }
}
