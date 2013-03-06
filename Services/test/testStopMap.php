<!--
Lanciare il curl per passare i post data e salvare il risultato in una pagina di test:
curl --data "lat=45.088187&lon=7.651792&dist=2&agid=id1&limitTo=10" http://localhost/PhpProject2/services/stopsmap.php > /Applications/MAMP/htdocs/PhpProject2/Services/testStopMap.php

curl --data "lat=45.088187&lon=7.651792&dist=2&agid=id1&limitTo=10" http://ipmobman.comze.com/Services/stopsList.php > /Applications/MAMP/htdocs/PhpProject2/Services/testStops.php
-->

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>stops</title>
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0; padding: 0 }
            #map_canvas { height: 100% }
        </style>
        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCgtOJrO3H80rrg5GMs-GJIAolH78j5fZw&libraries=geometry&sensor=false">
        </script>
        <script type="text/javascript" src="utility/mapUtilities.js"></script>
        
