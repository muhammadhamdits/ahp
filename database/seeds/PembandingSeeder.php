<?php

use Illuminate\Database\Seeder;

class PembandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pembandings')->insert(['nama' => 'Pilih Nilai Perbandingan...', 'nilai' => 0]);
        DB::table('pembandings')->insert(['nama' => '9x Lebih Penting Dari', 'nilai' => 9]);
        DB::table('pembandings')->insert(['nama' => '8x Lebih Penting Dari', 'nilai' => 8]);
        DB::table('pembandings')->insert(['nama' => '7x Lebih Penting Dari', 'nilai' => 7]);
        DB::table('pembandings')->insert(['nama' => '6x Lebih Penting Dari', 'nilai' => 6]);
        DB::table('pembandings')->insert(['nama' => '5x Lebih Penting Dari', 'nilai' => 5]);
        DB::table('pembandings')->insert(['nama' => '4x Lebih Penting Dari', 'nilai' => 4]);
        DB::table('pembandings')->insert(['nama' => '3x Lebih Penting Dari', 'nilai' => 3]);
        DB::table('pembandings')->insert(['nama' => '2x Lebih Penting Dari', 'nilai' => 2]);
        DB::table('pembandings')->insert(['nama' => '1x Lebih Penting Dari', 'nilai' => 1]);
        DB::table('pembandings')->insert(['nama' => '1/2x Lebih Penting Dari', 'nilai' => 1/2]);
        DB::table('pembandings')->insert(['nama' => '1/3x Lebih Penting Dari', 'nilai' => 1/3]);
        DB::table('pembandings')->insert(['nama' => '1/4x Lebih Penting Dari', 'nilai' => 1/4]);
        DB::table('pembandings')->insert(['nama' => '1/5x Lebih Penting Dari', 'nilai' => 1/5]);
        DB::table('pembandings')->insert(['nama' => '1/6x Lebih Penting Dari', 'nilai' => 1/6]);
        DB::table('pembandings')->insert(['nama' => '1/7x Lebih Penting Dari', 'nilai' => 1/7]);
        DB::table('pembandings')->insert(['nama' => '1/8x Lebih Penting Dari', 'nilai' => 1/8]);
        DB::table('pembandings')->insert(['nama' => '1/9x Lebih Penting Dari', 'nilai' => 1/9]);
    }
}
