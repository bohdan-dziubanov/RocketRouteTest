<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title><?php echo $title ?></title>
        <?php $protocol = !empty($_SERVER['HTTPS']) ? 'https' : 'http'; ?>
        <link rel="stylesheet" href="<?php echo $protocol?>://<?php echo $_SERVER['HTTP_HOST']?>/resources/css/styles.css" type="text/css">
        <script src="resources/js/maps.js"></script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key= AIzaSyDzvOzADLpCkfmw6LhK6K6i6FUzc7z4E0I&callback=initMap">
        </script>
    </head>
    <body>
        <div class="header">
        </div>
        <div class="container">