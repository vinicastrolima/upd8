<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            // Acre
            ['nome' => 'Rio Branco', 'estado_id' => 1],
            ['nome' => 'Cruzeiro do Sul', 'estado_id' => 1],
            ['nome' => 'Sena Madureira', 'estado_id' => 1],
            ['nome' => 'Feijó', 'estado_id' => 1],
            ['nome' => 'Tarauacá', 'estado_id' => 1],

            // Alagoas
            ['nome' => 'Maceió', 'estado_id' => 2],
            ['nome' => 'Arapiraca', 'estado_id' => 2],
            ['nome' => 'Rio Largo', 'estado_id' => 2],
            ['nome' => 'Palmeira dos Índios', 'estado_id' => 2],
            ['nome' => 'União dos Palmares', 'estado_id' => 2],

            // Amapá
            ['nome' => 'Macapá', 'estado_id' => 3],
            ['nome' => 'Santana', 'estado_id' => 3],
            ['nome' => 'Laranjal do Jari', 'estado_id' => 3],
            ['nome' => 'Oiapoque', 'estado_id' => 3],
            ['nome' => 'Pedra Branca do Amapari', 'estado_id' => 3],

            // Amazonas
            ['nome' => 'Manaus', 'estado_id' => 4],
            ['nome' => 'Parintins', 'estado_id' => 4],
            ['nome' => 'Itacoatiara', 'estado_id' => 4],
            ['nome' => 'Manacapuru', 'estado_id' => 4],
            ['nome' => 'Coari', 'estado_id' => 4],

            // Bahia
            ['nome' => 'Salvador', 'estado_id' => 5],
            ['nome' => 'Feira de Santana', 'estado_id' => 5],
            ['nome' => 'Vitória da Conquista', 'estado_id' => 5],
            ['nome' => 'Camaçari', 'estado_id' => 5],
            ['nome' => 'Itabuna', 'estado_id' => 5],

            // Ceará
            ['nome' => 'Fortaleza', 'estado_id' => 6],
            ['nome' => 'Caucaia', 'estado_id' => 6],
            ['nome' => 'Juazeiro do Norte', 'estado_id' => 6],
            ['nome' => 'Maracanaú', 'estado_id' => 6],
            ['nome' => 'Sobral', 'estado_id' => 6],

            // Espírito Santo
            ['nome' => 'Vitória', 'estado_id' => 7],
            ['nome' => 'Vila Velha', 'estado_id' => 7],
            ['nome' => 'Cariacica', 'estado_id' => 7],
            ['nome' => 'Serra', 'estado_id' => 7],
            ['nome' => 'Linhares', 'estado_id' => 7],

            // Goiás
            ['nome' => 'Goiânia', 'estado_id' => 8],
            ['nome' => 'Aparecida de Goiânia', 'estado_id' => 8],
            ['nome' => 'Anápolis', 'estado_id' => 8],
            ['nome' => 'Luziânia', 'estado_id' => 8],
            ['nome' => 'Águas Lindas de Goiás', 'estado_id' => 8],

            // Maranhão
            ['nome' => 'São Luís', 'estado_id' => 9],
            ['nome' => 'Imperatriz', 'estado_id' => 9],
            ['nome' => 'São José de Ribamar', 'estado_id' => 9],
            ['nome' => 'Timon', 'estado_id' => 9],
            ['nome' => 'Caxias', 'estado_id' => 9],

            // Mato Grosso
            ['nome' => 'Cuiabá', 'estado_id' => 10],
            ['nome' => 'Várzea Grande', 'estado_id' => 10],
            ['nome' => 'Rondonópolis', 'estado_id' => 10],
            ['nome' => 'Sinop', 'estado_id' => 10],
            ['nome' => 'Tangará da Serra', 'estado_id' => 10],


        ];

        DB::table('municipios')->insert($municipios);
    }
}
