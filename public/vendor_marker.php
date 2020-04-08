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
            Completa los datos para dar de alta.
        </p>
    </header>
    
    <div class="container">
        <form role="form" action="http://api-products-covid19py/api/vendor" method='post'>
            <div class="form-group">
                <label>Email
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; tu email" value="" name="user_email" size="25" />
            </div>
            <div class="form-group">
                <label>Nombre
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el nombre del vendedor" name="vendor_name" value="" size="25" />
            </div>
            <div class="form-group">
                <label>Apellido
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el apellido del vendedor" name="vendor_last_name" value="" size="25" />
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
                <input class="form-control" type="hidden" name="vendor_lat" id="vendor_lat" value="" placeholder="click en el mapa"/>
            </div>
            <div class="form-group">
                <input class="form-control" type="hidden" name="vendor_lng" id="vendor_lng" value="" placeholder="click en el mapa"/>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="Enviar" />
       </form>
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