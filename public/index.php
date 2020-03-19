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
    <script id="loadMap" data-name="list" src="assets/js/onLoadScripts.js" type="text/javascript" charset="utf-8"></script>
    <script src="assets/js/Map.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <!-- Menu -->
    <?php include "menu.php"; ?>
    
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h2 class="display-5">Productos para el consumo contra el COVID19 - Paraguay!</h2>
        <p class="lead">
            Sitio para ubicar vendedores que venden productos COVID19 en el terrirorio paraguyao y poder
            contactarlos.
            <!-- <br/>
            Si quieres darte de alta haz click en este formulario. -->
        </p>
    </header>

    <?php include "searcher.php"; ?>

    <div id="map">
        <div class="title-section">Mapa</div>
        <div id='map-container' style="height: 600px; border: 1px solid #AAA;"></divdiv>
    </div>

    </br>

    <?php include "footer.php"; ?>
</body>
</html>