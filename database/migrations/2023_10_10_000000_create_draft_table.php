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
            $table->datetime('tanggal_approval_manager')->nullable();
            $table->string('ket_manager')->nullable();

            $table->string('approval_senior_manager')->default('proses');
            $table->datetime('tanggal_approval_sm')->nullable();
            $table->string('ket_sm')->nullable();

            $table->string('approval_manager_it')->default('proses');
            $table->datetime('tanggal_approval_manager_it')->nullable();
            $table->string('ket_manager_it')->nullable();

            $table->string('approval_teknisi')->default('proses');
            $table->datetime('tanggal_approval_teknisi')->nullable();
            $table->string('ket_teknisi')->nullable();

            $table->string('approval_senior_manager_it')->default('proses');
            $table->datetime('tanggal_approval_sm_it')->nullable();
            $table->string('ket_sm_it')->nullable();
            
            $table->date('waktu_pengambilan')->nullable();
            $table->string('status')->default('proses');
            $table->datetime('tanggal_submit')->nullable();
            $table->datetime('tanggal_diambil')->nullable();
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
