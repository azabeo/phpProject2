<!--
Lanciare il curl per passare i post data e salvare il risultato in una pagina di test:
curl --data "lat=45.088187&lon=7.651792&dist=2&agid=id1&limitTo=10&isMetric=false&byName=true" http://localhost/PhpProject2/services/testGetStopList1.php > /Applications/MAMP/htdocs/PhpProject2/Services/testGetStopList_prod.php

-->

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>testGetStopList1</title>
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0; padding: 0 }
            #map_canvas { height: 100% }
        </style>
        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCgtOJrO3H80rrg5GMs-GJIAolH78j5fZw&libraries=geometry&sensor=false">
        </script>
        <script type="text/javascript" src="utility/mapUtilities.js"></script>
        
SELECT stop_id, stop_name, stop_lat, stop_lon, LEFT (stop_name,1) as k, FORMAT(
                    ? * 2 * ASIN(SQRT( POWER(SIN((? - stop_lat) * pi()/180 / 2), 2) 
                    +COS(? * pi()/180) * COS(stop_lat * pi()/180) 
                    *POWER(SIN((? - stop_lon) * pi()/180 / 2), 2) )) , 3) 
                as distance FROM stops WHERE agency_global_id = ? HAVING distance < ?  ORDER BY stop_name LIMIT ?<br/>execute<br/><script type="text/javascript">
var stops = new Array(); 
</script>
        
        <script type="text/javascript">
            
            function log(text){
                var myDiv = document.getElementById("log");
                myDiv.innerHTML = myDiv.innerHTML + "<br/>" + text;
            }

            function initialize() {
                
                for(var i = 0; i < stops.length; i++){
                    var text = "";
                    for(var j = 0; j < stops[i].length; j++){
                        text += stops[i][j] + " ";
                    }
                    log(text);
                }
                
                
            };
        
        </script>
    </head>
    <body onload="initialize()">
        <div id="log">LOG:<br/></div>
        <div id="map_canvas" style="width:100%; height:100%;"></div>
    </body>
</html>