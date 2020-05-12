<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="SHORTCUT ICON" href="{{ @url('assets/img/favicon.ico')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Productos y/o servicios para la venta y consumo en Paraguay de forma sencilla.">
	<meta name="author" content="josego">

	<title>{{ $APP_NAME }} - Ubicaci&oacute;n de productos para el consumo contra el COVID19 - Paraguay </title>


	{{-- Agregar METAS DE FACEBOOK Y TWITTER --}}


	<link rel="stylesheet" href="{{ @url('assets/js/libs/leaflet/leaflet.css') }}" charset="utf-8" />
	<link rel="stylesheet" href="{{ @url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}" charset="utf-8" />
	<link rel="stylesheet" href="{{ @url('assets/js/libs/leaflet/plugins/Leaflet.fullscreen/leaflet.fullscreen.css') }}" charset="utf-8" />
	<link rel="stylesheet" href="{{ @url('assets/js/libs/leaflet/plugins/Leaflet.markercluster/MarkerCluster.css') }}" charset="utf-8" />
	<link rel="stylesheet" href="{{ @url('assets/js/libs/leaflet/plugins/Leaflet.markercluster/MarkerCluster.Default.css') }}" charset="utf-8" />
	<link rel="stylesheet" href="{{ @url('assets/js/libs/leaflet/plugins/Leaflet-control-geocoder/Control.Geocoder.min.css') }}" charset="utf-8" />
	<link rel="stylesheet" href="{{ @url('assets/js/libs//bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" media="screen" charset="utf-8" />
	<link rel='stylesheet' href="{{ @url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/css/bootstrap-select.min.css') }}" charset="utf-8" />
	<link rel='stylesheet' href="{{ @url('https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css') }}" charset="utf-8" />
	<link rel="stylesheet" href="{{ @url('assets/css/styles.css')}}" charset="utf-8" />

	<script src="{{ @url('assets/js/libs/leaflet/leaflet.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('assets/js/libs/leaflet/plugins/Leaflet.fullscreen/Leaflet.fullscreen.min.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('assets/js/libs/leaflet/plugins/Leaflet.markercluster/leaflet.markercluster.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('assets/js/libs/leaflet/plugins/Leaflet-control-geocoder/Control.Geocoder.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('assets/js/libs/jquery/jquery-3.4.1.min.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('assets/js/libs/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/js/bootstrap-select.min.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') }}" type="text/javascript" charset="utf-8"></script>
	<script src="{{ @url('assets/js/Utilities.js') }}" type="text/javascript" charset="utf-8"></script>
	<script id="loadMap" data_load_map={{ $data_load_map }} src="{{ @url('assets/js/onLoadScripts.js') }}" type="text/javascript" charset="utf-8"></script> 
	<script src="{{ @url('assets/js/Map.js') }}" type="text/javascript" charset="utf-8"></script>

	<script type="text/javascript">
		var HOSTNAME = '{{ @url('/') }}';
		var HOSTNAME_API = HOSTNAME + '/api/';
		var GOOGLE_ANALYTICS_CODE = '';

		// Map.
		var DEFAULT_ZOOM_MAP = 6;
		var DEFAULT_ZOOM_MARKER = 16;
		var DEFAULT_MIN_ZOOM_MAP = 6;
		var DEFAULT_MAX_ZOOM_MAP = 20;

		// Villa Hayes - Paraguay.
		var DEFAULT_LNG = -57.623807;
		var DEFAULT_LAT = -23.299114;
	</script>

</head>
<body>

	@include('template.menu-top')