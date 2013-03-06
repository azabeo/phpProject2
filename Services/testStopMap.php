<!--
Lanciare il curl per passare i post data e salvare il risultato in una pagina di test:
curl --data "lat=45.088187&lon=7.651792&dist=2&agid=id1&limitTo=10&isUk=false" http://localhost/PhpProject2/services/stopsMap.php > /Applications/MAMP/htdocs/PhpProject2/Services/testStopMap.php

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
        
<script type="text/javascript">
var stops = new Array(); 
var stopContents = new Array();
stopContents[0] = "51542011";
stopContents[1] = "Fermata 3413 - REGINA MARGHERITA";
stopContents[2] = "0.018";
stopContents[3] = "45.088090000000001";
stopContents[4] = "7.6519700000000004";
stops[0] = stopContents;
var stopContents = new Array();
stopContents[0] = "51542009";
stopContents[1] = "Fermata 105 - REGINA MARGHERITA";
stopContents[2] = "0.019";
stopContents[3] = "45.088189999999997";
stopContents[4] = "7.6520400000000004";
stops[1] = stopContents;
var stopContents = new Array();
stopContents[0] = "51542010";
stopContents[1] = "Fermata 106 - REGINA MARGHERITA";
stopContents[2] = "0.025";
stopContents[3] = "45.088070000000002";
stopContents[4] = "7.6520599999999996";
stops[2] = stopContents;
var stopContents = new Array();
stopContents[0] = "51511005";
stopContents[1] = "Fermata 2626 - LECCE";
stopContents[2] = "0.165";
stopContents[3] = "45.087110000000003";
stopContents[4] = "7.6503399999999999";
stops[3] = stopContents;
var stopContents = new Array();
stopContents[0] = "51463006";
stopContents[1] = "Fermata 1095 - VIGILI DEL FUOCO";
stopContents[2] = "0.234";
stopContents[3] = "45.088549999999998";
stopContents[4] = "7.6488500000000004";
stops[4] = stopContents;
var stopContents = new Array();
stopContents[0] = "51463000";
stopContents[1] = "Vigili del Fuoco";
stopContents[2] = "0.243";
stopContents[3] = "45.088272000000003";
stopContents[4] = "7.6486979999999996";
stops[5] = stopContents;
var stopContents = new Array();
stopContents[0] = "51504006";
stopContents[1] = "Fermata 108 - APPIO CLAUDIO";
stopContents[2] = "0.302";
stopContents[3] = "45.085630000000002";
stopContents[4] = "7.6504599999999998";
stops[6] = stopContents;
var stopContents = new Array();
stopContents[0] = "51504005";
stopContents[1] = "Fermata 107 - APPIO CLAUDIO";
stopContents[2] = "0.339";
stopContents[3] = "45.085380000000001";
stopContents[4] = "7.65008";
stops[7] = stopContents;
var stopContents = new Array();
stopContents[0] = "51504007";
stopContents[1] = "Fermata 2625 - APPIO CLAUDIO";
stopContents[2] = "0.340";
stopContents[3] = "45.085259999999998";
stopContents[4] = "7.6505099999999997";
stops[8] = stopContents;
var stopContents = new Array();
stopContents[0] = "51653005";
stopContents[1] = "Fermata 1724 - SVIZZERA";
stopContents[2] = "0.368";
stopContents[3] = "45.088459999999998";
stopContents[4] = "7.6564800000000002";
stops[9] = stopContents;
</script>
        
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