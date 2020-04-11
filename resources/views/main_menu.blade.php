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
        La cuarentena en Paraguay est&aacute; teniendo desabastecimientos de algunos productos (alcohol en gel, tapabocas, 
        etc) como tambi&eacute;n no sabemos qui&eacute;nes son los que venden y como poder contactarlos.
        </br>
        El sitio reune a todos los vendedores que ofrecen productos para la cuarentena en el territorio paraguayo y 
        poder contactarlos. 
        <br/>
        El sitio facilita el contacto, pero no se hace responsable de ninguna informaci&oacute;n err&oacute;nea, incompleta o 
        desactualizada como tambi&eacute;n del mal uso de la informaci&oacute;n publicada. Leer <a href="{{ url('disclamer') }}">t&eacute;rminos de uso</a>
        </br>
        Si quieres darte de alta haz click en <a href="{{ url('vendor') }}" >este</a> formulario. 
    </p>
</header>