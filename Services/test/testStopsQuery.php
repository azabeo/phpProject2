<?php

$lat = 45.088187;
$lon = 7.651792;
$dist = 10;
$agid = "id1";
$lim = 5;
$isUk = true;
$rad = 0;

// earth's radius in the unit of measure you want the results to be. 3956 for miles, 6356 for chilometers
if($isUk){
    $rad = 3965;
}  else {
    $rad = 6356;
}

// calculate lon and lat for the rectangle:
$lon1 = $lon - $dist / abs(cos(deg2rad($lat))*69);
$lon2 = $lon + $dist /abs(cos(deg2rad($lat))*69);
$lat1 = $lat - ($dist/69); 
$lat2 = $lat + ($dist/69);

$db = new mysqli('localhost', 'root', 'root', 'ipmobman2');

$stmt = $db->prepare('
    SELECT 
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

?>
