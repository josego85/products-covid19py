<html>
<head>
<?php 
        $data = 
        [
            'data_load_map' => "marker"
        ]
    ?>
    @include('header', $data)
</head>
<body>
    @include('menu')
    
    <header class="jumbotron my-4">
        <h2 class="display-5">Registrarse como vendedor</h2>
        <p class="lead">
            Completa tus datos como vendedor con los productos para aparecer en ProductosPY.
            </br>
            Cualquier consulta a <strong>productospy.org@gmail.com</strong>
        </p>
    </header>

    <script>
        $(function ()
        {
            const lockModal = $("#lock-modal");
            const loadingCircle = $("#loading-circle");
            const form = $("form");

            $('#form').on('submit', function(e)
            {
                e.preventDefault();

                // Lock down the form.
                lockModal.css("display", "block");
                loadingCircle.css("display", "block");

                setTimeout(function ()
                {
                    // Re-enable the form.
                    lockModal.css("display", "none");
                    loadingCircle.css("display", "none");
                }, 3000);

                $.ajax(
                {
                    url: HOSTNAME_API + "vendor",
                    type: 'POST',
                    data: $('#form').serialize(),
                    success: function (data, text)
                    {
                        let response = JSON.parse(data);
                        let status = response.status;
                        let result = response.result;

                        if (status)
                        {
                            window.location = '/?guardado=ok';
                        }
                        else if (!result)
                        {
                            let errors = response.errors;
                            let msg = '<div class="alert alert-warning" id="success-alert">' +
                              '<strong>Aviso: </strong>';
                            let index;
                            for (index in errors)
                            {
                                msg += '</br>' + errors[index];
                            }
                            msg += '</div>';
                            $("#msg").html(msg);
                        }
                    },
                    error: function (request, status, error)
                    {
                        alert(request.responseText);
                    }
                });
            });
        });
    </script>
    
    <div class="container">
        <form id="form" role="form" method='post'>
            <div class="form-group">
                <label>
                    <span class="label label-default" style="font-size:22px;">Email</span>
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el email del vendedor" value="" name="user_email" size="25" />
            </div>
            <div class="form-group">
                <label>
                    <span class="label label-default" style="font-size:22px;">Nombre y apellido</span>
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el nombre y apellido del vendedor" name="user_full_name" value="" size="25" />
            </div>
            <div class="form-group">
                <label>
                    <span class="label label-default" style="font-size:22px;">N&uacute;mero de contacto</span>
                    <span>(Ejemplo: 0981999999 o 021999999 o 999999) (*)</span>
                </label>
                <input class="form-control" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" minlength="6" maxlength="10" placeholder="Ingrese aqu&iacute; el n&uacute;mero de contacto del vendedor" name="user_phone" value="" required />
            </div>
            <div class="form-group">
                <label>
                    <span class="label label-default" style="font-size:22px;">Productos</span>
                    <span>(*)</span>
                </label>
                @include('products')
            </div>
            <div>
                <label>
                    <span class="label label-default" style="font-size:22px;">Ubicaci&oacute;n del vendedor</span>
                    <span>(opcional)</span>
                    </br>
                    <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Aviso!</h4>
                        <p>
                            Si tenes una ubicaci&oacute;n geogr&aacute;fica haz click en el bot&oacute;n de abajo para que 
                            aparezca en el mapa un marcador y puedas moverlo para indicar tu ubicaci&oacute;n.
                        </p>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading">Observaci&oacute;n!</h4>
                        <p>
                            Si no moves el marcador no va a guardar tu ubicaci&oacute;n!!!
                        </p>
                    </div>
                    <button type="button" class="btn btn-success btn-lg btn-block" onclick="marker_point_map(event, DEFAULT_ZOOM_MAP)">Marcar ubicaci&oacute;n</button>
                </label>
                </br>
                <div id="map">
                    <div id='map-container' style="width: 100%; height: 300px; border: 1px solid #AAA;"></div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="hidden" name="user_lat" id="user_lat" value="" placeholder="click en el mapa"/>
            </div>
            <div class="form-group">
                <input class="form-control" type="hidden" name="user_lng" id="user_lng" value="" placeholder="click en el mapa"/>
            </div>
            <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Registrar vendedor" />
            <div id="lock-modal"></div>
            <div id="loading-circle"></div>
        </form>
       <div id="msg">
       </div>
    </div>
    </br>
    @include('footer')
</body>
</html>