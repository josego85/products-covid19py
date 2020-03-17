<html>
<head>
    <meta charset="utf-8" />
    <link rel="SHORTCUT ICON" href="resources/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ubicaci&oacute;n de productos para el consumo contra el COVID19 - Paraguay</title>

    <link rel="stylesheet" href="assets/js/libs/leaflet/leaflet.css" charset="utf-8" />
    <link rel="stylesheet" href="assets/js/libs/leaflet/plugins/Leaflet.fullscreen/leaflet.fullscreen.css" charset="utf-8" />
    <link rel="stylesheet" href="assets/js/libs/leaflet/plugins/Leaflet.markercluster/MarkerCluster.css" />
    <link rel="stylesheet" href="assets/js/libs/leaflet/plugins/Leaflet.markercluster/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="assets/js/libs//bootstrap-4.4.1-dist/css/bootstrap.min.css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="assets/css/styles.css" charset="utf-8" />

    <script src="assets/js/libs/leaflet/leaflet.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/libs/leaflet/plugins/Leaflet.fullscreen/Leaflet.fullscreen.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/libs/leaflet/plugins/Tile.Stamen/tile.stamen.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/libs/leaflet/plugins/Leaflet.markercluster/leaflet.markercluster.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/libs/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/libs/bootstrap-4.4.1-dist/js/bootstrap.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/Constants.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/Utilities.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/onLoadScripts.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/Map.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <!-- Menu -->
    <?php include "menu.php"; ?>
    
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h1 class="display-3">Dar de alta productos</h1>
        <p class="lead">
            Completa los datos para dar de alta
        </p>
    </header>
    
    <div class="container">
        <form role="form" action="http://api-products-covid19py/api/vendor" method='post'>
        <div class="form-group">
                <label>Mail
                    <span>(*)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; tu mail" name="user_email" value="" id="user_email" size="25" />
            </div>
            <div class="form-group">
                <label>Nombre
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el nombre del vendedor" name="vendor_name" value="" id="vendor_name" size="25" />
            </div>
            <div class="form-group">
                <label>Apellido
                    <span>(opcional)</span>
                </label>
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; el apellido del vendedor" name="vendor_last_name" value="" id="vendor_last_name" size="25" />
            </div>
            <!-- <div class="form-group">
                <label>Latitud
                    <span>*</span>
                </label>
                <input class="form-control" type="text" name="evento_latitud" id="evento_latitud" value="" placeholder="click en el Mapa"/>
            </div>
            <div class="form-group">
                <label>Longitud
                    <span>*</span>
                </label>
                <input class="form-control" type="text" name="evento_longitud" id="evento_longitud" value="" placeholder="click en el Mapa"/>
            </div> -->
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

    <div class="container">
        <form role="form" >
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Ingresa aqui tu busqueda" name="direccion" value="" id="direccion" size="25" />
            </div>
            <button class="btn btn-default" type="button" onclick="direccion_buscador();">Buscador</button>
            <div id="resultado"/>
        </form>
    </div>
    <div id="map">
        <div class="title-section">Mapa</div>
        <div id='map-container' style="height: 600px; border: 1px solid #AAA;"></divdiv>
    </div>

    </br>
    <!-- Footer -->
    <?php include "footer.php"; ?>
</body>
</html>