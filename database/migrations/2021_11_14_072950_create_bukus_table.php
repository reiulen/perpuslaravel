<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->string('slug');
            $table->string('pengarang');
            $table->integer('jumlah_buku'); 
            $table->text('deskripsi');
            $table->integer('tahun_terbit');
            $table->string('penerbit');
            $table->string('isbn')->nullable();
            $table->foreignId('kategori_id');   
            $table->string('gambar_buku');
            $table->integer('views')->default('0')->nullable();
            $table->foreignId('pinjaman')->default('0')->nullable();
            $table->enum('status', ['Publish', 'Draft', 'Pending'])->default('Publish');    
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
        Schema::dropIfExists('bukus');
    }
}
