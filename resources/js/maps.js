function addMarker(position, icon, map, value)
{
    var infowindow = new google.maps.InfoWindow({
      content: value.hint
    });

    var marker = new google.maps.Marker({
        position: position,
        icon: icon,
        map: map
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });    
}

function initMap()
{
    var stringData = document.getElementById('notam-data');
    var jsonData = JSON.parse(stringData.innerHTML);
    var map;
    var icon = 'resources/warning.png';

    jsonData.forEach(function(value, index) {
        var position = {lat: value.coord.lat, lng: value.coord.lng};
        if(index == 0)
        {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: position,
                mapTypeId: 'roadmap'
            });
        }

        addMarker(position, icon, map, value);
    });
}