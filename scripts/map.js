function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 8.8606, lng: 76.8670},
        zoom: 5
    });

    var marker = new google.maps.Marker({
        map: map,
        position: {lat: 8.8606, lng: 76.8670}
    });
}