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

<!-- Modal de edição -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-editar">
                    <!-- Primeira linha -->
                    <div class="form-row mt-2">
                        <div class="col-md-4">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="col-md-4">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14">
                        </div>
                        <div class="col-md-4">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" id="sexo" name="sexo">
                                <option value="homem">Homem</option>
                                <option value="mulher">Mulher</option>
                            </select>
                        </div>
                    </div>
                    <!-- Segunda linha -->
                    <div class="form-row mt-2">
                        <div class="col-md-6">
                            <label for="data_nascimento">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento">
                        </div>
                        <div class="col-md-6">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco">
                        </div>
                    </div>
                    <!-- Terceira linha -->
                    <div class="form-row mt-2">
                        <div class="col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado_id">
                                <!-- Opções de estado aqui, se necessário -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="cidade">Cidade</label>
                            <select class="form-control" id="cidade" name="cidade_id">
                                <!-- Opções de cidade populadas dinamicamente -->
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="clienteId" name="clienteId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary salvar" id="salvarEdicao">Salvar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        const formFiltrar = $('#form-filtrar');

        function filtrarClientes(termos) {
            $.ajax({
                url: '/api/buscar-clientes', // Rota para a função de busca/filtragem no backend
                type: 'GET',
                data: { termos: termos },
                success: function(data) {
                    var tableBody = $('#table-body');
                    tableBody.empty();
                    console.log('Apagou a tabela')

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
                            '<button class="btn btn-success editar-btn" data-toggle="modal" data-target="#editarModal" data-id="' + cliente.id + '">Editar</button>' +
                            '<button class="btn btn-danger excluir-btn" data-toggle="modal" data-target="#excluirModal' + cliente.id + '" data-id="' + cliente.id + '" data-cpf="' + cliente.cpf + '" data-nome="' + cliente.nome + '">Excluir</button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                        tableBody.append(row);

                        // Criação do modal para este cliente
                        var modal = '<div class="modal fade" id="excluirModal' + cliente.id + '" tabindex="-1" aria-labelledby="excluirModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog">' +
                            '<div class="modal-content">' +
                            '<div class="modal-header">' +
                            '<h5 class="modal-title" id="excluirModalLabel">Excluir Cliente</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>' +
                            '<div class="modal-body">' +
                            '<p>Tem certeza de que deseja excluir o cliente?</p>' +
                            '<p><strong>CPF:</strong> <span id="excluirCpf' + cliente.id + '"></span></p>' +
                            '<p><strong>Nome:</strong> <span id="excluirNome' + cliente.id + '"></span></p>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>' +
                            '<button type="button" class="btn btn-danger" id="confirmarExclusao">Confirmar</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('body').append(modal);
                    });
                    console.log('tentou montar o modal')
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        formFiltrar.on('submit', function(event) {
            event.preventDefault();
            const termos = {
                cpf: $('input[name="cpf"]').val(),
                nome: $('input[name="nome"]').val(),
                data_nascimento: $('input[name="data_nascimento"]').val(),
                sexo: $('select[name="sexo"]').val(),
                endereco: $('input[name="endereco"]').val(),
                estado_id: $('select[name="estado"]').val(),
                cidade_id: $('select[name="cidade"]').val()
            };

            filtrarClientes(termos); // Chamar a função de filtragem com os termos
        });

        formFiltrar.on('reset', function(event) {
            event.preventDefault();
            filtrarClientes(); 
        });
    });

    $(document).ready(function() {

        $(document).on('click', '.editar-btn', function() {
            var clienteId = $(this).data('id');

            $.ajax({
                url: '/api/clientes/' + clienteId,
                type: 'GET',
                success: function(cliente) {
                    $('#clienteId').val(cliente.id);
                    $('#cpf').val(cliente.cpf);
                    $('#nome').val(cliente.nome);
                    $('#data_nascimento').val(cliente.data_nascimento);
                    $('#sexo').val(cliente.sexo);
                    $('#endereco').val(cliente.endereco);
                    $('#estado').val(cliente.estado_id);
                    preencherCidades(cliente.estado_id);
                    $('#cidade').val(cliente.cidade_id);

                    $('#editarModal').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        const estadoSelect = $("#estado");
        const cidadeSelect = $("#cidade");
        let estadosECidades; // Variável para armazenar os dados de estados e cidades

        // Função para preencher o select de cidades com base no estado selecionado
        function preencherCidades(estadoId) {
            cidadeSelect.empty();

            const estado = estadosECidades.find(item => item.id == estadoId);

            if (estado) {
                estado.municipio.forEach(cidade => {
                    const option = $("<option>").val(cidade.id).text(cidade.nome);
                    cidadeSelect.append(option);
                });
            }
        }

        // Fazer a chamada AJAX para buscar estados e cidades
        $.ajax({
            url: '/api/estados-cidades',
            type: 'GET',
            success: function(data) {
                estadosECidades = data; // Armazena os dados de estados e cidades

                // Preenche o select de estados
                estadosECidades.forEach(estado => {
                    const option = $("<option>").val(estado.id).text(estado.nome);
                    estadoSelect.append(option);
                });
            },
            error: function(error) {
                console.error("Erro ao buscar estados e cidades:", error);
            }
        });

        estadoSelect.on("change", function() {
            const estadoId = estadoSelect.val();
            preencherCidades(estadoId);
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
                            '<button class="btn btn-success editar-btn" data-toggle="modal" data-target="#editarModal" data-id="' + cliente.id + '">Editar</button>' +
                            '<button class="btn btn-danger excluir-btn" data-toggle="modal" data-target="#excluirModal' + cliente.id + '" data-id="' + cliente.id + '" data-cpf="' + cliente.cpf + '" data-nome="' + cliente.nome + '">Excluir</button>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                        tableBody.append(row);

                        // Criação do modal para este cliente
                        var modal = '<div class="modal fade" id="excluirModal' + cliente.id + '" tabindex="-1" aria-labelledby="excluirModalLabel" aria-hidden="true">' +
                            '<div class="modal-dialog">' +
                            '<div class="modal-content">' +
                            '<div class="modal-header">' +
                            '<h5 class="modal-title" id="excluirModalLabel">Excluir Cliente</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>' +
                            '<div class="modal-body">' +
                            '<p>Tem certeza de que deseja excluir o cliente?</p>' +
                            '<p><strong>CPF:</strong> <span id="excluirCpf' + cliente.id + '"></span></p>' +
                            '<p><strong>Nome:</strong> <span id="excluirNome' + cliente.id + '"></span></p>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>' +
                            '<button type="button" class="btn btn-danger" id="confirmarExclusao">Confirmar</button>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('body').append(modal);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        $(document).on('click', '#salvarEdicao', function() {
            var clienteId = $('#clienteId').val();

            var novoCpf = $('#cpf').val();
            var novoNome = $('#nome').val();
            var novoSexo = $('#sexo').val();
            var novaData = $('#data_nascimento').val();
            var novoEndereço = $('#endereco').val();
            var novoEstado = $('#estado').val();
            var novaCidade = $('#cidade').val();
            console.log(novoEstado, novoEstado);


            var dadosEditados = {
                cpf: novoCpf,
                nome: novoNome,
                data_nascimento:novaData,
                sexo: novoSexo ,
                endereco: novoEndereço ,
                estado_id: novoEstado,
                cidade_id: novaCidade,
            };

            $.ajax({
                url: '/api/clientes/' + clienteId,
                type: 'PUT',
                data: dadosEditados,
                success: function(response) {
                    carregarClientes();
                    $('#editarModal').modal('hide');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '.excluir-btn', function() {
            var clienteId = $(this).data('id');
            var clienteCpf = $(this).data('cpf');
            var clienteNome = $(this).data('nome');

            $('#excluirCpf' + clienteId).text(clienteCpf);
            $('#excluirNome' + clienteId).text(clienteNome);

            $('#excluirModal' + clienteId).modal('show');
        });

        $(document).on('click', '.modal .close, .modal .btn-secondary, .salvar', function() {
            var clienteId = $(this).closest('.modal').attr('id').replace('excluirModal', '');
            var clienteId = $(this).closest('.modal').attr('id').replace('editarModal', '');
            $('.modal-backdrop').remove(); // Remover apenas o backdrop
            $('#excluirModal' + clienteId).modal('hide');
            $('#editarModal' + clienteId).modal('hide');

        });

        $(document).on('click', '#confirmarExclusao', function() {
            var clienteId = $(this).closest('.modal').attr('id').replace('excluirModal', '');

            $.ajax({
                url: '/api/clientes/' + clienteId,
                type: 'DELETE',
                success: function(response) {
                    carregarClientes();
                    $('#excluirModal' + clienteId).modal('hide');
                    $('#excluirModal' + clienteId).on('hidden.bs.modal', function () {
                        $(this).remove(); 
                        $('.modal-backdrop').remove();
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        carregarClientes();
    });
</script>
@endsection
