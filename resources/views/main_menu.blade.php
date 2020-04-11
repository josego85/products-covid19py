<header class="jumbotron my-4">
    <h2 class="display-5">Productos para la cuarentena 2020 - Paraguay!</h2>
    @if( request()->get('guardado') === 'ok' )
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Vendedor guardado!</h4>
            <p>
                Vas a aparecer en la parte de vendendores con 
                ubicaci&oacute;n si marcaste en el mapa, o si no
                vas a aparecer en la parte de vendedores sin 
                ubicaci&oacute;n.
            </p>
        </div>
    @endif
    <p class="lead">
        El sitio re&uacute;ne a vendedores que ofrecen productos para poder contactarlos.
        <br/>
        Leer <a href="{{ url('disclamer') }}">t&eacute;rminos de uso</a>
        </br>
        Registrarse como vendedor <a href="{{ url('vendor') }}" >aqu&iacute;</a>. 
    </p>
</header>