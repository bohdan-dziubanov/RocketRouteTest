function initMap() {
    var uluru = {lat: 51.4700, lng: -0.4564};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: uluru
    });

    var marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}