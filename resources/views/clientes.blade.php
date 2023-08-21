@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card fundo-terciario rounded">
                <div class="card-body">
                    <h1 class="texto-cinza">Buscar Clientes</h1>
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card fundo-terciario rounded">
                <div class="card-body">
                    <h1 class="texto-cinza">Lista de Clientes</h1>
                    <table class="table tabela-lista">
                        <thead>
                            <tr class="texto-cinza fundo-terciario">
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
                        <tbody id="table-body">
                            <!-- Os dados dos clientes serão preenchidos aqui via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.excluir-btn').click(function() {
            var clienteId = $(this).data('id');

            $.ajax({
                url: '/api/clientes/' + clienteId,
                type: 'DELETE',
                success: function(response) {
                    carregarClientes();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        function carregarClientes() {
            $.ajax({
                url: '/api/clientes',
                type: 'GET',
                success: function(data) {
                    var tableBody = $('#table-body');
                    tableBody.empty();

                    data.forEach(function(cliente) {
                        var row = '<tr>' +
                            '<td>' + cliente.cpf + '</td>' +
                            '<td>' + cliente.nome + '</td>' +
                            '<td>' + cliente.data_nascimento + '</td>' +
                            '<td>' + cliente.sexo + '</td>' +
                            '<td>' + cliente.endereco + '</td>' +
                            '<td>' + cliente.estado.nome + '</td>' +
                            '<td>' + cliente.municipio.nome + '</td>' +
                            '<td>' +
                            '<div class="d-flex justify-content-between">' +
                            '<button class="btn btn-success editar-btn">Editar</button>' +
                            '<button class="btn btn-danger excluir-btn" data-id="' + cliente.id + '">Excluir</button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                        tableBody.append(row);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        carregarClientes();
    });
</script>
@endsection
