<?php

use App\Models\Poli;
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
        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poli');
            $table->timestamps();
        });

        Poli::create([
            'nama_poli'=>'Poli Umum'
        ]);
        Poli::create([
            'nama_poli'=>'Poli Gigi'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polis');
    }
};
