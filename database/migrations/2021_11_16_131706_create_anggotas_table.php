<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('id_anggota');
            $table->string('foto');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('kelas');
            $table->enum('jenis_kelamin',['Laki-laki', 'Perempuan']);
            $table->integer('nis');
            $table->string('password');
            $table->enum('status', ['Nonaktif', 'Verify', 'Aktif'])->default('Nonaktif');
            $table->string('aktifitas')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('anggotas');
    }
}
