var marker_point = null;
var cluster_markers = null;

// Class Map.

// Constructor Map.
function Map (p_coordinates, p_zoom)
{
	// Attributes.
    this.coordinates = p_coordinates;
    this.zoom = p_zoom;

    let lng = p_coordinates['lng'];
    let lat = p_coordinates['lat'];
    let minZoom = DEFAULT_MIN_ZOOM_MAP;
    let maxZoom = DEFAULT_MAX_ZOOM_MAP;

    map = new L.map('map-container',
    {
        center: [lat, lng],
        minZoom: minZoom,
        maxZoom: maxZoom,
        zoom: p_zoom,
        //scrollWheelZoom: false,
        fullscreenControl: true,
        fullscreenControlOptions:
        {
            position: 'topleft'
        }
    });
    
    // Do not repeat the map.
    //map.setMaxBounds([[-90, -180], [90, 180]]);

    // Humanitarian Style.
	let url = 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
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
Map.prototype.get_vendors = function()
{
	let map = this.map;
	
	this.geojsonLayer = new L.GeoJSON();

	let v_geo_json_url = HOSTNAME_API + "vendors";
	let urlIcon = L.Icon.Default.imagePath = "assets/img/";
    let leafIcon = L.Icon.extend(
    {
        options:
        {
            iconSize: [32, 32],
            iconAnchor: [32, 32],
            popupAnchor: [-16, -28]
        }
    });
    let iconVendor = new leafIcon(
    {
        iconUrl: urlIcon + 'vendor_32.png'
    });
    
    let layer_vendors;

    $.getJSON(v_geo_json_url, function(p_data)
    {
        layer_vendors = L.geoJson(p_data,
        {
            onEachFeature: onEachFeature,
            pointToLayer: function(feature, latlng)
            {
                var icon = iconVendor;

                return L.marker(latlng,
                {
                    title: feature.properties.nombre, 
                    //icon: icon
                });
			}
        });
        cluster_markers = L.markerClusterGroup();
        cluster_markers.addLayer(layer_vendors);
        map.addLayer(cluster_markers);

        generate_table (p_data);
    });
};

Map.prototype.products_filter = function (p_products_filter)
{
    let map = this.map;
    let product;
    let product_array = [];
    let index;

    for (index in p_products_filter)
    {
        product = p_products_filter[index].value;
        product_array.push(product);
    }

    cluster_markers.clearLayers();

    let products = JSON.stringify(product_array);
    let url = HOSTNAME_API + "vendors?products=" + products;

    $.getJSON(url, function(p_data)
    {
        let geojsonLayer = L.geoJson(p_data,
        {
    		onEachFeature: onEachFeature
        });
        cluster_markers.addLayer(geojsonLayer);
        map.addLayer(cluster_markers);

        generate_table (p_data);
    });
}

Map.prototype.marker_point = function (p_zoom)
{
    let map = this.map;
    let lng = DEFAULT_LNG;
    let lat = DEFAULT_LAT;

    clean_marker();
	
    marker_point = new L.marker([lat,lng],
    {
		id: 'vendor', 
	    draggable: 'true'
	});
    map.addLayer(marker_point);
    map.setView([lat, lng], p_zoom);

    marker_point.on("dragend", function(e) {
        let marker = e.target;
        let position = marker.getLatLng();
        let lat = position.lat;
        let lng = position.lng;
        let lat_lng = new L.LatLng(lat, lng);

        marker.setLatLng(lat_lng,
        {
            draggable: 'true'
        });
        map.panTo(lat_lng);

        document.getElementById('user_lat').value = lat;
        document.getElementById('user_lng').value = lng;
    });

    //addSearcher(map);
}


/////////////////////////
// Internal functions.
/////////////////////////

//
// To capitalize.
const capitalize = (s) =>
{
    if (typeof s !== 'string')
    {
        return '';
    }
    return s.charAt(0).toUpperCase() + s.slice(1);
}

// Show information in a popup.
function onEachFeature (p_feature, p_layer)
{
    if (p_feature.properties)
    {
        let v_popupString = '<div class="popup">';
        let propertie;

        for (propertie in p_feature.properties)
        {
            let value = p_feature.properties[propertie];

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
                    let product_name;
                    let product_type;
                    let product = '<ul>';
                    let index;

                    for (index in value)
                    {
                        product_name = value[index]['product_name'];
                        product_type = value[index]['product_type'];
                        product += '<li>' + capitalize(product_name) + '</li>';
                       
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

function addSearcher (map)
{
    let geocoder_options =
    {
        geocodingQueryParams:
        {
            countrycodes: 'PY',
            limit: 3
        }
    };
    let geocoder = L.Control.Geocoder.nominatim(geocoder_options);
    L.Control.geocoder(
    {
        defaultMarkGeocode: false,
        position: 'topleft',
        query: 'Pilar',
        placeholder: 'Buscar ...',
        geocoder: geocoder
    })
    .on('markgeocode', function (e)
    {
        var center = e.geocode.center;

        marker_point.setLatLng(center);
        map.setView(center, 18);
    })
    .addTo(map); 
}

function clean_marker ()
{
    if (marker_point)
    {
        marker_point.remove();
    }
}

function generate_table (p_data)
{
    let features = p_data.features;
    let index, propertie, coordinates, lat, lng;
    let table = [];
    let count = 0;

    for (index in features)
    {
        coordinates = features[index].geometry.coordinates;
        lat = coordinates[0];
        lng = coordinates[1];

        if (lat == null || lng == null)
        {
            propertie = features[index].properties;

            table.push(
            {
                numero: ++count,
                nombre: propertie.nombre,
                contacto: propertie.contacto,
                productos: propertie.productos
            })  
        }
    }
    let table_html = document.createElement("table");
    table_html.setAttribute('class', 'table')

    let row = table_html.insertRow(-1);
    let array_header =
    [
        '#',
        'Nombre',
        'Contacto',
        'Productos'
    ];
    let index_header;
    let propertie_header;
    for (index_header in array_header)
    {
        propertie_header = array_header[index_header];
        var headerCell = document.createElement("th");
        headerCell.innerHTML = propertie_header;
        row.appendChild(headerCell);
    }

    let i;
    for (i = 0; i < table.length; i++)
    {
        row = table_html.insertRow(-1);

        var cell = row.insertCell(-1);
        cell.innerHTML = table[i].numero;
        var cell = row.insertCell(-1);
        cell.innerHTML = table[i].nombre;
        var cell = row.insertCell(-1);
        cell.innerHTML = table[i].contacto;
        var cell = row.insertCell(-1);

        let index_tmp;
        let products = table[i].productos;
        let product = '';
        
        for (index_tmp in products)
        {
            product += products[index_tmp].product_name + ', ';
        }
        product = product.substr(0, product.length - 2);
        cell.innerHTML = product;
    }
    let dvTable = document.getElementById("table_vendors_without_geo");
    dvTable.innerHTML = "";
    dvTable.appendChild(table_html);
}