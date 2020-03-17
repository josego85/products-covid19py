var map = null;

function loadMap()
{
    // Paraguay.
    var lon = -57.6309129;
	var lat = -25.2961407;
    var zoom = 6;
    var minZoom = 6;
    var maxZoom = 18;
    
    map = new L.map('map-container',
    {
        center: [lat, lon],
        minZoom: minZoom,
        zoom: zoom,
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
	L.tileLayer(url, {
        minZoom: minZoom,
        maxZoom: maxZoom,
		attribution: 'Data \u00a9 <a href="http://www.openstreetmap.org/copyright">' +
          'OpenStreetMap Contributors </a> Tiles \u00a9 HOT'
	}).addTo(map);

	var layer_departament;
	$.getJSON("assets/data/Departamentos.geojson", function(data_departament){
		layer_departament = L.geoJson(data_departament).addTo(map);
		layer_departament.setStyle({
			fillColor: '#aaaa00',
			"color": "#b1b100",
			"weight": 2,
			"opacity": 0.65
		}) 
	});

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
    $.getJSON("http://api-products-covid19py/api/vendors", function(data_vendors)
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
}

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

            if(value != null && value.trim() !== "")
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