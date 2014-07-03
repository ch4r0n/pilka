<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns:php="http://php.net/xsl" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns="http://www.w3.org/1999/xhtml">';
?>

<!--<!DOCTYPE html>-->
<!--<html>-->
<head>
    <meta charset="utf-8">
    <title>Weather layer</title>
    <style>
        html, body, #map-canvas {
            height: 100%;
            margin: 0px;
            padding: 0px
        }
    </style>
    <script type="text/javascript" src="js/jquery-1.6.4.js"></script>
    <script type="text/javascript" src="js/showhidearona.js"/></script>

    //<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-28926553-2']);
        _gaq.push(['_setDomainName', 'skoki24.info']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather"></script>
    <script>
        function initialize() {
            var mapOptions = {
                zoom: 9,
                center: new google.maps.LatLng(52.4447656780619, 16.940948484116234),
                mapTypeId: google.maps.MapTypeId.SATELLITE
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

            var weatherLayer = new google.maps.weather.WeatherLayer({
                temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
            });
            weatherLayer.setMap(map);

            var cloudLayer = new google.maps.weather.CloudLayer();
            cloudLayer.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>

</head>
<body>
<div id="map-canvas"></div>
</body>
</html>

