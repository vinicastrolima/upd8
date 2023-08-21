<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Estado;

use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());
        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $clientes)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return response()->json($cliente, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clientes $clientes)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return response()->json(null, 204);
    }
}
