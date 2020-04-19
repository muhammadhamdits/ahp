<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbandinganAlternatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbandingan_alternatifs', function (Blueprint $table) {
            $table->bigInteger('alternatif_id_1')->unsigned();
            $table->bigInteger('alternatif_id_2')->unsigned();
            $table->bigInteger('kriteria_id')->unsigned();
            $table->bigInteger('pembanding_id')->unsigned();
            $table->foreign('alternatif_id_1')->references('id')->on('alternatifs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('alternatif_id_2')->references('id')->on('alternatifs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pembanding_id')->references('id')->on('pembandings')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['alternatif_id_1', 'alternatif_id_2', 'kriteria_id'], 'perbandingan_alternatifs_primary');
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
        Schema::dropIfExists('perbandingan_alternatifs');
    }
}
