<header class="jumbotron my-4 bg-warning">
    <h2 class="display-5">Productos y/o servicios para la cuarentena 2020 - Paraguay!</h2>
    @if( request()->get('guardado') === 'ok' )
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Vendedor registrado!</h4>
            <p>
                Vas a aparecer en el mapa y en la lista de todos los vendedores.
            </p>
        </div>
    @endif


    <p class="lead">
        El sitio re&uacute;ne a vendedores que ofrecen productos y/o servicios para poder contactarlos.
        <br/>
        Leer <a href="{{ url('disclaimer') }}"><strong>t&eacute;rminos de uso</strong></a>
        </br>
        Registrarse como vendedor <a href="{{ url('vendors') }}"><strong>aqu&iacute;</strong></a>. 
    </p>
</header>