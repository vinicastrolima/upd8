<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Sua Aplicação</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item {{ Request::is('clientes') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('clientes.index') }}">Visualizar Clientes</a>
            </li>
            <li class="nav-item {{ Request::is('clientes/cadastrar') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('clientes/cadastrar') }}">Cadastrar Clientes</a>
            </li>
        </ul>
    </div>
</nav>
