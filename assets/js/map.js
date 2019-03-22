function showCoordinates (e) {
    alert(e.latlng);
}

function centerMap (e) {
    map.panTo(e.latlng);
}

function zoomIn (e) {
    map.zoomIn();
}

function zoomOut (e) {
    map.zoomOut();
}

function reloadMap(obj) {
    location.reload();
}

// Initialisation de la carte avec un menu de click droit
var map = L.map('map', {
    center: [35.431879, -5.201654],
    zoom: 9,
    contextmenu : true,
    contextmenuWidth : 150,
    contextmenuItems : [{
        text: 'GT à proximité',
        classname: 'bold',
        icon: 'assets/images/glissementTerrain.png',
    
    },
    {
        text: 'Show coordinates',
        classname : 'bold',
        icon: 'assets/images/localisation.png',
        callback: showCoordinates
    },
    {
        text: 'Centrer la carte ici',
        classname: 'bold',
        icon: 'assets/images/center.png',
        callback: centerMap
    }, 

    {
        text: 'Zoom In',
        classname: 'bold',
        icon: 'assets/images/zoomIn.png',
        callback: zoomIn
    },
    {
        text: 'Zoom Out',
        classname: 'bold',
        icon: 'assets/images/zoomOut.png',
        callback: zoomOut
    },
    {
        text: 'Rafraichir',
        icon: 'assets/images/refresh-64.png',
        callback : reloadMap
    
    }]
});
//AJOUTEZ LA POSITION DE LA SOURIS À LA CARTE
L.control.mousePosition({position: 'bottomleft'}).addTo(map);

//Afficher la barre d'échelle
L.control.scale().addTo(map);

//Ajouter le menu de navigation : retour à la carte de base (Tanger) 
L.control.navbar({position: 'topleft'}).addTo(map);

//LOCALISATION
L.control.locate().addTo(map);



// Animation des entités
function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#FF0000',
        dashArray: '',
        fillOpacity: 0
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }

    info.update(layer.feature.properties);
}

function resetHighlight(e) {
    WFSLayer.resetStyle(e.target);
    info.update();
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

//Importer le découpage administratif sous format GeoJSON en utilisant le service WFS 
var rootUrl = 'http://localhost:8060/geoserver/geoportail/ows';

var defaultParameters = {
    service: 'WFS',
    version: '1.0.0',
    request: 'GetFeature',
    typeName: 'geoportail:decoupage_administratif',
    outputFormat: 'text/javascript',
    format_options: 'callback: getJson'

};

var parameters = L.Util.extend(defaultParameters);

var WFSLayer;
var ajax = $.ajax({
    url : rootUrl + L.Util.getParamString(parameters),
    dataType : 'jsonp',
    jsonpCallback : 'getJson',
    success : function (response) {
        console.log(rootUrl + L.Util.getParamString(parameters));
        WFSLayer =L.geoJson(response, {
            style: function(feature) {
                    return {
                        color: '#fff',
                        weight: 2,
                        opacity: 1,
                        dashArray: '3',
                        fillOpacity: 0
                        };
            },
            onEachFeature: onEachFeature
        }).addTo(map);
    }
});

var info = L.control();

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
};

// method that we will use to update the control based on feature properties passed
info.update = function (props) {
    this._div.innerHTML = '<h6>Informations</h6>' +  (props ?
        '<b>' + props.type + '</b><br />' + props.nom
        : 'Survoler une commune');
};

info.addTo(map);

//Base maps toggle
var baselayers = {
    'EsriWorldImagery': L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy;<a href="https://www.esri.com/en-us/homem">ESRI</a>'
    }),

    'OpenStreetMap': L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'
    })
};

var overlays;
var layersControl = L.control.layers.minimap(baselayers, overlays ,{
/*collapsed: false,*/
    position: 'topright',
    topPadding: 10,
    bottomPadding: 40,
    overlayBackgroundLayer: L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy;<a href="https://www.esri.com/en-us/homem">ESRI</a>'})
}).addTo(map);

var filter = function () {
    var hash = window.location.hash;
    var filterIndex = hash.indexOf('filter=');
    if (filterIndex !== -1) {
        var filterString = hash.substr(filterIndex + 7).trim();
        layersControl.filter(filterString);
    }
};

baselayers.EsriWorldImagery.addTo(map);

L.DomEvent.on(window, 'hashchange', filter);
filter();

// La loupe 

// Fond de base pour la loupe: Normal et Sattelitaire
var glass_map=L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}');

var magnifyingGlass = L.magnifyingGlass({
    zoomOffset: 3,
    layers: [glass_map]
});

L.control.magnifyingglass(magnifyingGlass, {
    forceSeparateButton: true
}).addTo(map);

// Overview (Mini map)

var baselayers_minimap = {
    EsriWorldImagery: L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy;<a href="https://www.esri.com/en-us/homem">ESRI</a>'
    }),
    OpenStreetMap: L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'
    })
};

var rect1 = {color: "#b6dc3b", weight: 3};
var rect2 = {color: "#6194c1", weight: 1, opacity:0, fillOpacity:0};

var miniMap = new L.Control.MiniMap(baselayers_minimap.EsriWorldImagery, { toggleDisplay: true, collapsedWidth: 27, collapsedHeight: 27, aimingRectOptions : rect1, shadowRectOptions: rect2 }).addTo(map);

map.on('baselayerchange', function (e) {
    miniMap.changeLayer(baselayers_minimap[e.name]);
})

// Barre de recherche
var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider();

var searchControl = L.esri.Geocoding.geosearch({
    providers: [
    arcgisOnline,
    L.esri.Geocoding.mapServiceProvider({
        label: 'States and Counties',
        url: 'https://sampleserver6.arcgisonline.com/arcgis/rest/services/Census/MapServer',
        layers: [2, 3],
        searchFields: ['NAME', 'STATE_NAME']
    })
    ]
}).addTo(map);	

var results = L.layerGroup().addTo(map);

searchControl.on('results', function(data){
    results.clearLayers();
    for (var i = data.results.length - 1; i >= 0; i--) {
    results.addLayer(L.marker(data.results[i].latlng));
    }
});

//Outils de dessin
var drawnItems = new L.FeatureGroup().addTo(map),
    editActions = [
        L.Toolbar2.EditAction.Popup.Edit,
        L.Toolbar2.EditAction.Popup.Delete,
        L.Toolbar2.Action.extendOptions({
            toolbarIcon: { 
                className: 'leaflet-color-picker', 
                html: '<span class="fa fa-eyedropper"></span>' 
            },
            subToolbar: new L.Toolbar2({ actions: [
                L.ColorPicker.extendOptions({ color: '#007bff' }),
                L.ColorPicker.extendOptions({ color: '#dc3545' }),
                L.ColorPicker.extendOptions({ color: '#ffc107' }),
                L.ColorPicker.extendOptions({ color: '#b6dc3b' })
            ]})
        })
    ];

new L.Toolbar2.DrawToolbar({
    position: 'topleft',
}).addTo(map);

map.on('draw:created', function(evt) {
    var	type = evt.layerType,
        layer = evt.layer;

    drawnItems.addLayer(layer);

    layer.on('click', function(event) {
        new L.Toolbar2.EditToolbar.Popup(event.latlng, {
            actions: editActions
        }).addTo(map, layer);
    });
});

// Géosignets (Bookmarks)
var control = new L.Control.Bookmarks().addTo(map);