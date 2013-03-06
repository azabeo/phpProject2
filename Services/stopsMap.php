<!--
Lanciare il curl per passare i post data e salvare il risultato in una pagina di test:
curl --data "lat=45.088187&lon=7.651792&dist=2&agid=id1&limitTo=10&isMetric=false" http://localhost/PhpProject2/services/stopsMap.php > /Applications/MAMP/htdocs/PhpProject2/Services/testStopMap.php

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
        <?php
            include 'utility/getStopList.php';

            $result = getStopList();
            
            echo '<script type="text/javascript">', PHP_EOL;
            
            echo 'var stops = new Array(); ', PHP_EOL;

            for ($i = 0; $i < count($result); $i++) {
                echo 'var stopContents = new Array();', PHP_EOL;
                for($j=0; $j < count($result[$i]); $j++){
                    echo 'stopContents[', $j ,'] = "',$result[$i][$j], '";', PHP_EOL;
                }
                
                echo 'stops[', $i, '] = stopContents;', PHP_EOL;
            }
            echo '</script>', PHP_EOL;
        ?>
        
        <script type="text/javascript">
            
            function log(text){
                var myDiv = document.getElementById("log");
                myDiv.innerHTML = myDiv.innerHTML + "<br/>" + text;
            }

            function initialize() {
                
                var markers = new Array();
                
                for(var i = 0; i < stops.length; i++){
                    markers[i] = getMarker(stops[i][3],stops[i][4],"B");
                }
                
                var bounds = new google.maps.LatLngBounds();
                markers.forEach(function(e) {
                    bounds = bounds.extend(e.getPosition());
                });
                
                map = new google.maps.Map(document.getElementById('map_canvas'), {
                    center: bounds.getCenter(),
                    zoom: 0, 
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                
                map.fitBounds(bounds);   

                markers.forEach(function(e) {
                    e.setMap(map);
                });
                
            };
        
        </script>
    </head>
    <body onload="initialize()">
        <div id="map_canvas" style="width:100%; height:100%;"></div>
    </body>
</html>