<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('role');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profil')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        User::create([
            'nama' => 'Admin',
            'role' =>'admin',
            'email' =>'admin@gmail.com',
            'password'=>bcrypt(123),
            'profil'=>'profil.jpg'
        ]);
        User::create([
            'nama' => 'Pasien Elen',
            'role'=>'pasien',
            'email'=>'pasien@gmail.com',
            'password'=>bcrypt(123),
            'profil'=>'profil.jpg'
        ]);
        User::create([
            'nama' => 'Dokter Anam',
            'role'=>'dokter',
            'email'=>'dokter@gmail.com',
            'password'=>bcrypt(123),
            'profil'=>'doctor.png'
        ]);
  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
