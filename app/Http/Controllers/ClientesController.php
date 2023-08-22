<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::with('estado', 'municipio')->get();

        return response()->json($clientes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = Cliente::findOrFail($id);
        $estados = Estado::all();
        return response()->json($cliente)->compat('estados');
    }

    public function obterEstadosECidades()
    {
        $estadosComCidades = Estado::with('municipio')->get();

        return response()->json($estadosComCidades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar os dados do request
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|string|unique:clientes,cpf',
            'nome' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|string|in:homem,mulher',
            'endereco' => 'required|string|max:300',
            'estado_id' => 'required|exists:estados,id',
            'cidade_id' => 'required|exists:municipios,id',
        ]);

        // Se houver erros de validação, retornar as mensagens de erro
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Remover caracteres especiais do CPF
        $cpf = preg_replace('/[^0-9]/', '', $request->cpf);

        // Criar o cliente
        $cliente = Cliente::create([
            'cpf' => $cpf,
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'sexo' => $request->sexo,
            'endereco' => $request->endereco,
            'estado_id' => $request->estado_id,
            'cidade_id' => $request->cidade_id,
        ]);

        return redirect('clientes/cadastrar');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        $clientes = Cliente::with('estado', 'municipio')->get();

        return response()->json($cliente, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validar os dados do request
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|string|unique:clientes,cpf,' . $cliente->id,
            'nome' => 'required|string|max:100',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|string|in:homem,mulher',
            'endereco' => 'required|string|max:300',
            'estado_id' => 'required|exists:estados,id',
            'cidade_id' => 'required|exists:municipios,id',
        ]);

        // Se houver erros de validação, retornar as mensagens de erro
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Remover caracteres especiais do CPF
        $cpf = preg_replace('/[^0-9]/', '', $request->cpf);

        // Criar um array para armazenar os campos a serem atualizados
        $camposAtualizados = [
            'cpf' => $cpf,
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'sexo' => $request->sexo,
            'endereco' => $request->endereco,
            'estado_id' => $request->estado_id,
            'cidade_id' => $request->cidade_id,
        ];

        // Comparar os campos atuais com os novos valores e remover os campos iguais
        $camposIguais = array_filter($camposAtualizados, function ($value, $key) use ($cliente) {
            return $value == $cliente->$key;
        }, ARRAY_FILTER_USE_BOTH);

        // Remover campos iguais do array de campos a serem atualizados
        $camposParaAtualizar = array_diff_assoc($camposAtualizados, $camposIguais);

        // Atualizar o cliente apenas com os campos diferentes
        $cliente->update($camposParaAtualizar);

        return response('', 200);
    }


    public function buscarClientes(Request $request)
    {
        $termos = $request->input('termos');
    
        // Verificar se $termos é nulo ou não
        if ($termos === null) {
            $termos = [];
        }
    
        $clientes = Cliente::query()->with('estado', 'municipio');
    
        // Verificar se há algum termo definido
        $termosVazios = true;
        foreach ($termos as $termo) {
            if ($termo) {
                $termosVazios = false;
                break;
            }
        }
    
        if (!$termosVazios) {
            foreach ($termos as $campo => $termo) {
                if ($termo) {
                    if ($campo === 'estado' || $campo === 'cidade') {
                        $clientes->whereHas($campo, function ($query) use ($termo) {
                            $query->where('nome', 'LIKE', "%$termo%");
                        });
                    } else {
                        $clientes->where($campo, 'LIKE', "%$termo%");
                    }
                }
            }
        } else {
            // Se não houver termos definidos, retorna todos os clientes
            $clientes->get();
        }
    
        $clientes = $clientes->get();
    
        return response()->json($clientes);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        // Encontrar o cliente pelo ID
        $cliente = Cliente::findOrFail($id);

        // Excluir o cliente
        $cliente->delete();

        return response()->json(null, 204);
    }
}
