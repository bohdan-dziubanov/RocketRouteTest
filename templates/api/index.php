<form action="/search" method="GET">
    <span><?php echo $text?>* </span>
    <input type="text" placeholder="<?php echo $placeholder?>" name="code" maxlength="4" class="code">
    <input type="submit" value="<?php echo $button?>">
</form>
<div id="map"></div>
<script>
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
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key= AIzaSyDzvOzADLpCkfmw6LhK6K6i6FUzc7z4E0I&callback=initMap">
</script>
