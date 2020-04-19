<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbandinganKriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbandingan_kriterias', function (Blueprint $table) {
            $table->bigInteger('kriteria_id_1')->unsigned();
            $table->bigInteger('kriteria_id_2')->unsigned();
            $table->bigInteger('pembanding_id')->unsigned();
            $table->foreign('kriteria_id_1')->references('id')->on('kriterias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kriteria_id_2')->references('id')->on('kriterias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pembanding_id')->references('id')->on('pembandings')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['kriteria_id_1', 'kriteria_id_2']);
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
        Schema::dropIfExists('perbandingan_kriterias');
    }
}
