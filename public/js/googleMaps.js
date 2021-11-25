function initMap(lat, lng, drag = true, capa='map') {
    let map;
    map = new google.maps.Map(document.getElementById(capa), {
        center: {lat: lat, lng: lng },
        zoom: 10,
    });
    var marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,
        draggable:drag
    });
    marker.addListener('dragend', function (event) {
        Livewire.emit('getLatitudeForInput',  this.getPosition().lat());
        Livewire.emit('getLongitudeForInput',  this.getPosition().lng());

    })
}

function resetMap(lat, lng, drag = true, capa='map'){
    document.getElementById(capa).innerHTML='';
    initMap(lat, lng, drag, capa);
}