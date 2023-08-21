@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Cadastrar Cliente</h1>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <!-- Formulário de cadastro -->
            <form id="form-cadastrar" action="http://127.0.0.1:8000/api/clientes" method="post">
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
                <div class="form-row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Certifique-se de incluir o jQuery no seu HTML -->

<script>
    $(document).ready(function() {
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

        $("#btn-cadastrar").on("click", function() {
            const formData = {
                // Obtenha os valores dos campos do formulário aqui
            };

            $.ajax({
                url: 'http://127.0.0.1:8000/api/clientes',
                type: 'POST',
                data: formData,
                success: function(response, status, xhr) {
                    if (xhr.status === 200) {
                        alert('Cliente cadastrado com sucesso');
                        location.reload(); // Recarrega a página
                    } else {
                        console.error("Resposta inesperada:", xhr.status);
                    }
                },
                error: function(xhr, status, error) {
                    const errorMessage = xhr.responseText || error;
                    alert("Erro ao cadastrar cliente: " + errorMessage);
                }
            });
        });

    });
</script>
@endsection


