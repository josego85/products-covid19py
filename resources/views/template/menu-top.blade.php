<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo productospy" 
                class="logo-top" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Inicio
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                {{-- <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/products') }}">
                        Productos Disponibles
                    </a>
                </li> --}}
                <li class="nav-item active ">
                    <a class="nav-link a-vendedor" href="{{ url('/vendor') }}">Registrar vendedor
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>