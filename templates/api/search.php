<form action="/search" method="GET">
    <span><?php echo $text?>* </span>
    <input type="text" value="<?php echo $value;?>" placeholder="<?php echo $placeholder?>" name="code" maxlength="4" class="code">
    <input type="submit" value="<?php echo $button?>">
</form>
<div id="map"></div>
<div class="notam-hidden-data" name="notam" id="notam-data"><?php echo $notams?></div>
