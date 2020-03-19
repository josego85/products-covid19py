<html>
<head>
    <meta charset="utf-8" />
    <link rel="SHORTCUT ICON" href="assets/img/favicon.ico">
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
    <script id="loadMap" data-name="marker" src="assets/js/onLoadScripts.js" type="text/javascript" charset="utf-8"></script>
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
                <input class="form-control" type="text" placeholder="Ingrese aqu&iacute; tu mail" value="" name="user_email" size="25" />
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
                <div class="row-fluid">
                    <div class="span3">
                        <label><input type="checkbox" name="gel_alcohol" value="gel_alcohol"> Gel a base de alcohol</label>
                    </div>
                    <div class="span3">
                        <label><input type="checkbox" name="alcohol_rectificado" value="alcohol_rectificado"> Alcohol rectificado</label>
                    </div>
                    <div class="span3">
                        <label><input type="checkbox" name="hipoclorito_sodio" value="hipoclorito_sodio"> Lavandina (hipoclorito de sodio)</label>
                    </div>
                    <div class="span3">
                        <label><input type="checkbox" name="tapaboca" value="tapaboca"> Tapaboca</label>
                    </div>
                    <div class="span3">
                        <label><input type="checkbox" name="papel" value="papel"> Papel</label>
                    </div>
                    <div class="span3">
                        <label><input type="checkbox" name="toalla" value="toalla"> Toalla</label>
                    </div>
                    <div class="span3">
                        <label><input type="checkbox" name="jabon_coco" value="jabon_coco"> Jab&oacute;n de coco</label>
                    </div>
                    <div class="span3">
                        <label><input type="checkbox" name="guantes" value="guantes"> Guantes</label>
                    </div>
                </div>
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