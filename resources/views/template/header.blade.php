<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="SHORTCUT ICON" href="{{ @url('assets/img/favicon.ico')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Productos y/o servicios para la venta y consumo en Paraguay de forma sencilla.">
	<meta name="author" content="productospy">

	<title>Productos y/o servicios para el consumo en Paraguay </title>

	<!-- Facebook Open Graph -->
    <meta property="og:url" content="{{ @url('/') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Productospy" />
    <meta property="og:description" content="Productos y/o servicios para la venta y consumo en Paraguay de forma sencilla." />
    <meta property="og:image" content="{{ @url('assets/img/logo.png') }}" />

    <!-- Twitter Open Graph -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@productospy" />
    <meta name="twitter:creator" content="@productospy" />
    <meta name="twitter:title" content="Productospy" />
    <meta name="twitter:description" content="Productos y/o servicios para la venta y consumo en Paraguay de forma sencilla." />
    <meta name="twitter:image" content="{{ @url('assets/img/logo.png') }}" />

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('assets/js/libs/leaflet/leaflet.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/js/libs/leaflet/plugins/Leaflet.fullscreen/leaflet.fullscreen.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/libs/leaflet/plugins/Leaflet.markercluster/MarkerCluster.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/libs/leaflet/plugins/Leaflet.markercluster/MarkerCluster.Default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/libs/leaflet/plugins/Leaflet-control-geocoder/Control.Geocoder.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/libs/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css')}}" />

	<!-- Vite Assets -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

	<!-- JavaScript Libraries -->
    <script src="{{ asset('assets/js/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/libs/leaflet/plugins/Leaflet.fullscreen/Leaflet.fullscreen.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/leaflet/plugins/Leaflet.markercluster/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/js/libs/leaflet/plugins/Leaflet-control-geocoder/Control.Geocoder.js') }}"></script>
    <script src="{{ asset('assets/js/libs/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="{{ asset('assets/js/libs/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<!-- Application JavaScript -->
    <script src="{{ asset('assets/js/Utilities.js') }}"></script>
    <script id="loadMap" data_load_map={{ $data_load_map }} src="{{ asset('assets/js/onLoadScripts.js') }}"></script>
    <script src="{{ asset('assets/js/Map.js') }}"></script>

    <script type="text/javascript">
        var HOSTNAME = '{{ url('/') }}';
        var HOSTNAME_API = HOSTNAME + '/api/';
        var GOOGLE_ANALYTICS_CODE = '';

        // Map Configuration
        var DEFAULT_ZOOM_MAP = 6;
        var DEFAULT_ZOOM_MARKER = 16;
        var DEFAULT_MIN_ZOOM_MAP = 6;
        var DEFAULT_MAX_ZOOM_MAP = 20;

        // Villa Hayes - Paraguay
        var DEFAULT_LNG = -57.623807;
        var DEFAULT_LAT = -23.299114;
    </script>
</head>
<body>

	@include('template.menu-top')