<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'sexo' => 'M',
                'endereco' => 'Rua A, 123',
                'estado' => 'São Paulo',
                'cidade' => 'São Paulo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cpf' => '98765432101',
                'nome' => 'Maria Santos',
                'data_nascimento' => '1985-08-25',
                'sexo' => 'F',
                'endereco' => 'Avenida B, 456',
                'estado' => 'Rio de Janeiro',
                'cidade' => 'Rio de Janeiro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Adicione mais clientes conforme necessário
        ];

        DB::table('clientes')->insert($clientes);
    }
}
