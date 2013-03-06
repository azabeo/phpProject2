<?php

function getStopList() {
    /*
    $mysql_host = "mysql5.000webhost.com";
    $mysql_database = "a4622219_ip2";
    $mysql_user = "a4622219_user2";
    $mysql_password = "ipm0bman";
    */
    
    $mysql_host = "localhost";
    $mysql_database = "ipmobman2";
    $mysql_user = "root";
    $mysql_password = "root"; 
    

    // Check for required parameters
    if (isset($_POST["lon"]) && isset($_POST["lat"]) && isset($_POST["dist"]) && isset($_POST["agid"]) && isset($_POST["limitTo"]) && isset($_POST["isMetric"])) {

        // Put parameters into local variables
        $lat = $_POST["lat"];
        $lon = $_POST["lon"];
        $dist = $_POST["dist"];
        $agid = $_POST["agid"];
        $lim = $_POST["limitTo"];
        $isMetric = $_POST["isMetric"];

        $rad = 0;

        // earth's radius in the unit of measure you want the results to be. 3956 for miles, 6356 for chilometers
        if ($isMetric) {
            $rad = 6356;
        } else {
            $rad = 3965;
        }

        // calculate lon and lat for the rectangle:
        $lon1 = $lon - $dist / abs(cos(deg2rad($lat)) * 69);
        $lon2 = $lon + $dist / abs(cos(deg2rad($lat)) * 69);
        $lat1 = $lat - ($dist / 69);
        $lat2 = $lat + ($dist / 69);

        $db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

        $stmt = $db->prepare(
            'SELECT 
                stop_id, 
                stop_name,
                FORMAT(
                    ? * 2 * ASIN(SQRT( POWER(SIN((? - stop_lat) * pi()/180 / 2), 2) 
                    +COS(? * pi()/180) * COS(stop_lat * pi()/180) 
                    *POWER(SIN((? - stop_lon) * pi()/180 / 2), 2) )) , 3) 
                as distance,
                stop_lat, 
                stop_lon
            FROM 
                stops
            WHERE
                agency_global_id = ?
                and stop_lon between ? and ? 
                and stop_lat between ? and ? 
            HAVING distance < ?
            ORDER BY distance
            LIMIT ?;'
        );

        $stmt->bind_param("ddddsddddii", $rad, $lat, $lat, $lon, $agid, $lon1, $lon2, $lat1, $lat2, $dist, $lim);
        $stmt->execute();

        $result = array();

        $stmt->bind_result($stop_id, $stop_name, $distance, $lat3, $lon3);
        while ($stmt->fetch()) {
            $row = array($stop_id, $stop_name, $distance, $lat3, $lon3);
            array_push($result, $row);
            //printf("%s - %f<br/>",$stop_name, $distance);
        }

        //echo json_encode($result, JSON_FORCE_OBJECT); //per ottenere un dictionary
        //echo json_encode($result);

        $stmt->close();
        $db->close();
        return $result;
    }

    return NULL;
}
?>

