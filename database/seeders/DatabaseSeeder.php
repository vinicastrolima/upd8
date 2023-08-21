<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Clientes;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EstadosTableSeeder::class,
            MunicipiosTableSeeder::class,
            ClientesTableSeeder::class,

        ]);
    }
}
