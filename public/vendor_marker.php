<html>
<head>
    <?php
        $data_load_map = 'marker';
        include "header.php"; 
    ?>
</head>
<body>
    <!-- Menu -->
    <?php include "menu.php"; ?>
    
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h2 class="display-5">Dar de alta productos de la cuarentena 2020</h2>
        <p class="lead">
            Completa los datos del vendedor para aparecer en el sitio.
            </br>
            En caso de no encontrarse su producto, contactarse a <strong>productospy@gmail.com</strong>
        </p>
    </header>

    <script>
        $(function ()
        {
            $('#form').on('submit', function(e)
            {
                e.preventDefault();
                $.ajax(
                {
                    url: "api/vendor",
                    type: 'POST',
                    data: $('#form').serialize(),
                    success: function (data, text)
                    {
                        let response = JSON.parse(data);
                        let status = response.status;
                        let result = data.result;

                        if (status)
                        {
                            $('#form').trigger("reset");

                            let success_alert = '<div class="alert alert-success" id="success-alert">' +
                            '<strong>Vendedor guardado!!!</strong>' +
                            '</div>';
                            let go_alert = 'Ya te encontras en el mapa. Ir al <a href=" ' + HOSTNAME + '">mapa</a>';
                            let msg = success_alert + go_alert;

                            $("#msg").html(msg);
                        }
                        else if (!result)
                        {
                            let errors = response.errors;
                            let msg = '<div class="alert alert-danger" id="success-alert">' +
                              '<strong>Errores: </strong>';
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
                <label>Email
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el email del vendedor" value="" name="user_email" size="25" />
            </div>
            <div class="form-group">
                <label>Nombre y apellido
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el nombre y apellido del vendedor" name="user_full_name" value="" size="25" />
            </div>
            <div class="form-group">
                <label>N&uacute;mero de contacto
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el n&uacute;mero de contacto del vendedor" name="user_phone" value="" size="25" />
            </div>
            <div class="form-group">
                <label>Productos</label>
                <?php include "products.php"; ?>
            </div>
            <div>
                <div id="map">
                    <div id='map-container' style="height: 300px; border: 1px solid #AAA;"></div>
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="hidden" name="user_lat" id="user_lat" value="" placeholder="click en el mapa"/>
            </div>
            <div class="form-group">
                <input class="form-control" type="hidden" name="user_lng" id="user_lng" value="" placeholder="click en el mapa"/>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Enviar" />
       </form>
       <div id="msg">
       </div>
    </div>
    
    <div>
        <div>
            <div>
                <div>
                    
               </div>
           </div>
       </div>

        <!-- Element: Map -->
        <div class='col col-50'>
          <div id='map'></div>
          <div class='left'>
            <a id='geojsonLayer' href='#'></a>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="container">
        <form role="form" >
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Ingresa aqui tu busqueda" name="direccion" value="" id="direccion" size="25" />
            </div>
            <button class="btn btn-default" type="button" onclick="direccion_buscador();">Buscador</button>
            <div id="resultado"/>
        </form>
    </div> -->
    

    </br>
    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>
</html>