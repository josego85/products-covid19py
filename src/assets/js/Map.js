var v_feature = null;
var v_marcador_evento = null;

// Class Map.

// Constructor Map.
function Map(p_type, p_coordinates, p_zoom) {
	// Attributes.
    this.type = p_type;
    this.coordinates = p_coordinates;
    this.zoom = p_zoom;

    var lng = p_coordinates['lng'];
    var lat = p_coordinates['lat'];
    var minZoom = 6;
    var maxZoom = 18;

    map = new L.map('map-container',
    {
        center: [lat, lng],
        minZoom: minZoom,
        maxZoom: maxZoom,
        zoom: p_zoom,
        scrollWheelZoom: false,
        fullscreenControl: true,
        fullscreenControlOptions:
        {
            position: 'topleft'
        }
    });
    
    // Do not repeat the map.
    map.setMaxBounds([[-90, -180], [90, 180]]);

    // Humanitarian Style.
	var url = 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
    L.tileLayer(url,
    {
        minZoom: minZoom,
        maxZoom: maxZoom,
		attribution: 'Data \u00a9 <a href="http://www.openstreetmap.org/copyright">' +
          'OpenStreetMap Contributors </a> Tiles \u00a9 HOT'
	}).addTo(map);
    
    this.map = map;
}

/////////////////////////
// Methods
/////////////////////////

//
Map.prototype.get_vendors = function() {
	var map = this.map;
	
	this.geojsonLayer = new L.GeoJSON();
    v_geojsonLayer = this.geojsonLayer;

	var v_geo_json_url = HOSTNAME + "api/vendors";
	var urlIcon = L.Icon.Default.imagePath = "assets/img/";
    var leafIcon = L.Icon.extend(
    {
        options:
        {
            iconSize: [32, 32],
            iconAnchor: [32, 32],
            popupAnchor: [-16, -28]
        }
    });
    var iconVendor = new leafIcon(
    {
        iconUrl: urlIcon + 'vendor_32.png'
    });
    
    var layer_vendors;
    $.getJSON(v_geo_json_url, function(data_vendors)
    {
        layer_vendors = L.geoJson(data_vendors,
        {
            onEachFeature: onEachFeature,
            pointToLayer: function(feature, latlng)
            {
                var sex = feature.properties.sex;
                var icon = iconVendor;

                return L.marker(latlng,
                {
                    title: feature.properties.nombre, 
                    icon: icon
                });
			}
        });
        // Add makers cluster.
        var cluster_markers = L.markerClusterGroup();
        cluster_markers.addLayer(layer_vendors);
        map.addLayer(cluster_markers);
    });
};

// Map.prototype.filtrar_eventos = function(){
// 	// Obtener atributos de la clase.
// 	var v_mapa = this.mapa;
// 	//v_geojsonLayer = this.geojsonLayer;
	
// 	// Obtiene la referencia del cluster marcadores.
// 	var v_cluster_marcadores = this.cluster_marcadores;
	
//     var v_date_timepicker_desde = document.getElementById("date_timepicker_desde");
//     var v_date_timepicker_hasta = document.getElementById("date_timepicker_hasta");


//     // Elminar los valores antiguos.
//     v_cluster_marcadores.clearLayers();
    
//     $.getJSON(HOSTNAME + 'eventos/filtrarEventos?date_timepicker_desde=' + v_date_timepicker_desde.value
//     		+ '&date_timepicker_hasta=' + v_date_timepicker_hasta.value, function(p_data) {
//     	v_geojsonLayer = L.geoJson(p_data, {
//     		onEachFeature: onEachFeature
//     	});
    	
//     	v_cluster_marcadores.addLayer(v_geojsonLayer); 				// Agrega al Cluster group.
//     	v_mapa.addLayer(v_cluster_marcadores);						// Agrega al mapa.
//     });
// }

// Map.prototype.marcar = function(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm){
// 	// Obtener atributos de la clase.
// 	var v_mapa = this.mapa;
	
// 	var v_loc1 = new L.LatLng(p_lat1, p_lng1);
//     var v_loc2 = new L.LatLng(p_lat2, p_lng2);
//     var v_bounds = new L.LatLngBounds(v_loc1, v_loc2);
    
	
//     //console.log("el tipo osm: ", p_tipo_osm);
    
//     if(v_feature){
//     	v_mapa.removeLayer(v_feature);
//     }
//     if(p_tipo_osm == "node") {
// 	    //feature = L.circle( loc1, 25, {color: 'green', fill: false}).addTo(v_mapa);
// 	    v_mapa.fitBounds(v_bounds);
// 	    v_mapa.setZoom(18);
//     }else{
//          var v_loc3 = new L.LatLng(p_lat1, p_lng2);
//          var v_loc4 = new L.LatLng(p_lat2, p_lng1);

//          v_feature = L.polyline( [v_loc1, v_loc4, v_loc2, v_loc3, v_loc1], {
// 		     color: 'red'
// 	     }).addTo(v_mapa);	
// 	     v_mapa.fitBounds(v_bounds);
//     }
//     v_marcador_evento = new L.marker(v_loc1, {
// 		id: 'evento', 
// 	    draggable:'true'
// 	});
//     v_mapa.addLayer(v_marcador_evento);
// }


/////////////////////////
// Internal functions.
/////////////////////////

//
// To capitalize.
const capitalize = (s) => {
    if (typeof s !== 'string')
    {
        return '';
    }
    return s.charAt(0).toUpperCase() + s.slice(1);
}

// Show information in a popup.
function onEachFeature(p_feature, p_layer)
{
    if (p_feature.properties)
    {
        var v_popupString = '<div class="popup">';

        for (var propertie in p_feature.properties)
        {
            var value = p_feature.properties[propertie];

            if(value && (value != null || value.trim() !== ""))
            {
                if (propertie === 'website')
                {
                    // And if the value is a link.
                    if (value != null && (value[0] === 'w' & value[1] === 'w' & value[2] === 'w') ||
                    (value[0] === 'h' & value[1] === 't' & value[2] === 't' & value[3] === 'p'))
                    {
                        v_popupString += `<b> ${capitalize(propertie)} </b>: <a href="${value}" target="_blank">${value}</a><br />`;
                    }
                    else
                    {
                        v_popupString += '<b>' + capitalize(propertie) + '</b>: ' + value + '<br />';
                    }
                }
                else if (propertie === 'productos')
                {
                    var product_name;
                    var product_type;
                    var product = '<ul>';

                    for (var index in value)
                    {
                        product_name = value[index]['product_name'];
                        product_type = value[index]['product_type'];
                        product += '<li>' + capitalize(product_name) + ' (' + product_type + ')</li>';
                       
                    }
                    product += '</ul>';
                    v_popupString += '<b>' + capitalize(propertie) + '</b>: ' + product + '<br />';
                }
                else
                {
                    v_popupString += '<b>' + capitalize(propertie) + '</b>: ' + value + '<br />';
                }
            }
        }
        v_popupString += '</div>';
        p_layer.bindPopup(v_popupString);
    }
}