@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Lista de Clientes</h1>
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Formulário de filtragem -->
                        <form id="form-filtrar">
                            <div class="form-row">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="cpf" placeholder="CPF">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="nome" placeholder="Nome">
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control" name="data_nascimento" placeholder="Data de Nascimento">
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="sexo">
                                        <option value="">Sexo</option>
                                        <option value="homem">Homem</option>
                                        <option value="mulher">Mulher</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="endereco" placeholder="Endereço">
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="estado" placeholder="Estado">
                                </div>
                            </div>
                            <div class="form-row mt-2">
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="cidade" placeholder="Cidade">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                    <button type="reset" class="btn btn-secondary ml-2">Limpar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table">
                    <!-- Cabeçalho da tabela -->
                    <thead>
                        <tr>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Sexo</th>
                            <th>Endereço</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <!-- Corpo da tabela -->
                    <tbody id="table-body">
                        <!-- Os dados dos clientes serão preenchidos aqui via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Seu código JavaScript aqui -->
@endsection
