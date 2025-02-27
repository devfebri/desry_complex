<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_pemohon');
            $table->string('kontak_pemohon');
            $table->string('devisi')->nullable();
            $table->string('sub_devisi')->nullable();
            $table->string('approval_manager')->default('proses');
            $table->string('approval_senior_manager')->default('proses');
            $table->string('approval_manager_it')->default('proses');
            $table->string('approval_teknisi')->default('proses');
            $table->string('approval_senior_manager_it')->default('proses');
            $table->date('waktu_pengambilan')->nullable();
            $table->string('status')->default('proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draft');
    }
}
