<?php

use App\Models\Dokter;
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
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('poli_id')->constrained();
            // $table->string('hari_praktik');
            $table->string('spesialis');
            $table->integer('biaya_layanan');

            $table->timestamps();
        });

        Dokter::create([
            'user_id'=>3,
            'poli_id'=>1,
            'spesialis'=>'Jantung',
            'biaya_layanan'=>30000
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokters');
    }
};
