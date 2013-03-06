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
        <?php
            include 'utility/getStopList1.php';

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