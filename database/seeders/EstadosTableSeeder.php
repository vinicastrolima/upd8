<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            ['nome' => 'Acre'],
            ['nome' => 'Alagoas'],
            ['nome' => 'Amapá'],
            ['nome' => 'Amazonas'],
            ['nome' => 'Bahia'],
            ['nome' => 'Ceará'],
            ['nome' => 'Espírito Santo'],
            ['nome' => 'Goiás'],
            ['nome' => 'Maranhão'],
            ['nome' => 'Mato Grosso'],
        ];

        DB::table('estados')->insert($estados);
    }
}
