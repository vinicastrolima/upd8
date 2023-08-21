<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = [
            [
                'cpf' => '12345678901',
                'nome' => 'João Silva',
                'data_nascimento' => '1990-05-15',
                'sexo' => 'homem',
                'endereco' => 'Rua A, 123',
                'estado_id' => 1,
                'cidade_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cpf' => '98765432101',
                'nome' => 'Maria Santos',
                'data_nascimento' => '1985-08-25',
                'sexo' => 'mulher',
                'endereco' => 'Avenida B, 456',
                'estado_id' => 2,
                'cidade_id' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cpf' => '98765432102',
                'nome' => 'Beatriz Barbosa',
                'data_nascimento' => '1985-08-25',
                'sexo' => 'mulher',
                'endereco' => 'Avenida B, 456',
                'estado_id' => 2,
                'cidade_id' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cpf' => '98765432103',
                'nome' => 'Danilo Dantas',
                'data_nascimento' => '1985-08-25',
                'sexo' => 'homem',
                'endereco' => 'Avenida B, 456',
                'estado_id' => 2,
                'cidade_id' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cpf' => '98765432104',
                'nome' => 'Vinicius Castro',
                'data_nascimento' => '1985-08-25',
                'sexo' => 'homem',
                'endereco' => 'Avenida B, 456',
                'estado_id' => 2,
                'cidade_id' => 7,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('clientes')->insert($clientes);
    }
}
