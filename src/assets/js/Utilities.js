var map = null;
var action = null;

/**
 * GeoLocalizacion por html5.
 * @method localization
 * @returns void
 */
function localization(p_action){
	action = p_action;
	
	/**
	 * OBS:
	 * - Iceweasel 27.0.1 en Debian Wheezy NO funciona la GeoLocalizacion del html5.
	 * - Mozilla Firefox en Windows si funciona la GeoLocaclizacion del html5.
	 */
    // if (navigator.geolocation)
    // {
    //     navigator.geolocation.getCurrentPosition(getCoordinates, errores,
    //     {
   	//  		enableHighAccuracy: true, 
   	//  		maximumAge: 30000, 
   	//  		timeout: 27000
   	//  	});
    // }
    // else
    // {
    // 	defaultPosition();
    // }
    defaultPosition();
}

/**
 * Metodo que obtiene las coordenadas actuales por medio de la geolocalizacion.
 * @method getCoordinates
 * @param p_position
 * @returns void
 */
function getCoordinates (p_position)
{
    var coordinates = new Array();
    
    coordinates['lng']  = p_position.coords.lng;;
	coordinates['lat'] = p_position.coords.lat;;
    
    load_map(coordinates);
}

/**
 * Metodo errores, sea el codigo de error que salga, va a cargar por defecto coordenadas (latitud y longitud) de USA.
 * @method errores
 * @param error
 * @returns void
 */
function errores (error)
{
	/*
	switch(error.code){
    	case error.PERMISSION_DENIED:
    		alert("User denied the request for Geolocation.");
    		break;
    	case error.POSITION_UNAVAILABLE:
    		alert("Location information is unavailable.");
    		break;
    	case error.TIMEOUT:
    		alert("The request to get user location timed out.");
    		break;
    	case error.UNKNOWN_ERROR:
    		alert("An unknown error occurred.");
    		break;
    }
    */
    defaultPosition();
}	

/**
 * Metodo que posiciona por defecto Asuncion - Paraguay.
 * @method defaultPosition
 * @returns void
 */ 
function defaultPosition ()
{
    // Asuncion - Paraguay.
    var lng = -57.6309129;
	var lat = -25.2961407;
    var coordinates = new Array();
   
    coordinates['lng']  = lng;
    coordinates['lat'] = lat;
    
	load_map(coordinates);
}

//
function load_map (p_coordinates)
{
    switch (action)
    {
	    case 'marker':
	    	map = new Map('', p_coordinates, 6);
            break;
        case 'list':
        case 'default':
            map = new Map('', p_coordinates, 6);
            map.get_vendors();
            break;
	}
}

// //
// function filtrar(){
// 	v_mapa.filtrar_eventos();
// }

// //
// function direccion_buscador() {
//     var v_entrada = document.getElementById("direccion");

//     $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + v_entrada.value, function(p_data) {
//         var v_array_items = [];

//         $.each(p_data, function(key, val) {
//             bb = val.boundingbox;
//             console.log('val: ', val);
            
//             v_array_items.push("<li><a href='#' onclick='elegirDireccion(" + bb[0] + ", " + bb[2] + ", " + bb[1] + ", " + bb[3] + ", \"" + val.osm_type + "\");return false;'>" + val.display_name + '</a></li>');
//         });

//         $('#resultado').empty();
//         if (v_array_items.length != 0) {
//             $('<p>', { html: "Resultados de la b&uacute;queda:" }).appendTo('#resultado');
//             $('<ul/>', {
//                 'class': 'my-new-list',
//                 html: v_array_items.join('')
//             }).appendTo('#resultado');
//         }else{
//              $('<p>', { html: "Ningun resultado encontrado." }).appendTo('#resultado');
//         }
//     });
// }

// //
// function elegirDireccion(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm) {
//     v_mapa.marcar(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm);
// }