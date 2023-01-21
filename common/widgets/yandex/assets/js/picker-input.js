ymaps.ready(initYandexMap);
var myMap;
/*
const mapObjectModel = {
    coordsCenter: [52.789555, 27.5150169],
    coords: [52.79193990295489,52.79193990295489],
    zoom: 14,
    title: "Точка"
};*/
function initYandexMap() {
    myMap = new ymaps.Map("yandexMapPicker", {
        center: mapObjectModel.coordsCenter,
        zoom: mapObjectModel.zoom, controls: []
    });
    if (mapObjectModel.coords ) {
        myMap.geoObjects.add(new ymaps.Placemark(mapObjectModel.coords, {
            balloonContent: mapObjectModel.title
        }));
    }
    myMap.events.add('click', function (e) {
        myMap.geoObjects.removeAll()
        var coords = e.get('coords');
        myPlacemarkWithContent = new ymaps.Placemark(coords, {

        });
        myMap.geoObjects.add(myPlacemarkWithContent);
        $('#geoPosLat').val(coords[0]);
        $('#geoPosLng').val(coords[1]);
    });
    myMap.events.add('boundschange', function(e){
        if (e.get('newZoom') !== e.get('oldZoom')) {
            $('#geoPosZoom').val(e.get('newZoom'));
        }
    })
}