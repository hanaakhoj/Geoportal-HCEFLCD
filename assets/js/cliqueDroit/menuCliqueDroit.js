/* var mapAdvancedSearch_AddressStyleM = new ol.style.Style({
    image: new ol.style.Icon({
        anchor: [0.5, 1],
        src: 'assets/img/marker.png'
    })
});

var mapAdvancedSearch_AddressGeometryVector_M = new ol.layer.Vector(
    {
        name: 'MapAdvancedSearch_Address',
        source: new ol.source.Vector(),
        style: mapAdvancedSearch_AddressStyleM
    }); */


var map;
var refresh_icon = 'assets/images/refresh-64.png';
var center_icon = 'assets/images/pointeur.png';
var zoomIn = 'assets/images/zoomIn.png';
var zoomIn = 'assets/images/zoomOut.png';
var gliss_icon = 'assets/images/glissementTerrain.png';


//MENU 

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


map = L.map('map', {
    contextmenu : true,
    contextmenuWidth : 210,
    contextmenuItems : [{
        text: 'Glissement à proximité',
        classname: 'bold',
        icon: gliss_icon,
      
    },
    {
        text: 'Show coordinates',
        callback: showCoordinates
    },
    {
        text: 'Centrer la carte ici',
        classname: 'bold',
        icon: center_icon,
        callback: centerMap
    }, 

    {
        text: 'Zoom In',
        classname: 'bold',
        icon: zoomIn,
        callback: zoomIn
    },
    {
        text: 'Zoom Out',
        classname: 'bold',
        icon: zoomOut,
        callback: zoomOut
    },
    {
        text: 'Rafraichir',
        icon: refresh_icon,
    
    }]
});




