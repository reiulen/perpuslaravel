<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->string('id_anggota');
            $table->string('nama_peminjam');
            $table->string('email');
            $table->string('jenis_kelamin');
            $table->string('kelas');
            $table->string('judul_buku');
            $table->foreignId('buku_id');
            $table->string('tgl_pinjam');
            $table->string('tgl_kembali');
            $table->enum('status',['Belum diambil','Dipinjam','Dikembalikan','Denda'])->default('Belum diambil');
            $table->integer('denda')->default('0');
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
        Schema::dropIfExists('pinjamen');
    }
}
