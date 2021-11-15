function initMap(lat, lng, capa='map') {
    let map;
    map = new google.maps.Map(document.getElementById(capa), {
        center: {lat: lat, lng: lng },
        zoom: 10,
    });
    var marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,
        draggable:true
    });
    marker.addListener('dragend', function (event) {
        Livewire.emit('getLatitudeForInput',  this.getPosition().lat());
        Livewire.emit('getLongitudeForInput',  this.getPosition().lng());

    })
}

function resetMap(lat, lng, capa='map'){
    document.getElementById(capa).innerHTML='';
    initMap(lat, lng, capa);
}

function showMap(lat, lng, capa='map') {
    let map;
    map = new google.maps.Map(document.getElementById(capa), {
        center: {lat: lat, lng: lng },
        zoom: 10,
    });
    var marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,
        draggable:false
    });
}