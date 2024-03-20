<?php

use App\Models\Konsul;
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
        Schema::create('konsuls', function (Blueprint $table) {
            $table->id();
            $table->string('konsultasi');
            $table->string('tgl_konsultasi');
            $table->foreignId('pasien_id')->constrained();
            $table->foreignId('dokter_id')->constrained();

            $table->timestamps();
        });

        Konsul::create([
            'konsultasi'=>'mata',
            'tgl_konsultasi'=>date('Y-m-d'),
            'pasien_id'=>1,
            'dokter_id'=>1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konsuls');
    }
};
