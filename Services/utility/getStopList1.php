<?php

class BindParam{
    private $values = array(), $types = '';
   
    public function add( $type, &$value ){
        $this->values[] = $value;
        $this->types .= $type;
    }
   
    public function get(){
        return array_merge(array($this->types), $this->values);
    }
} 

function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}

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
    if (isset($_POST["agid"]) && isset($_POST["isMetric"]) && isset($_POST['byName'])) {

        // Put parameters into local variables

        $agid = $_POST["agid"];
        $isMetric = $_POST["isMetric"];
        $byName = ($_POST["byName"] === 'true');
        
        $db = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

        $bindParam = new BindParam(); 
        $queryString = 'SELECT stop_id, stop_name, stop_lat, stop_lon';
        
        if($byName){
             $queryString .= ', LEFT (stop_name,1) as k';
         }else{
             if (isset($_POST["lon"]) && isset($_POST["lat"])){
                $queryString .= ', FORMAT(FLOOR(
                    ? * 2 * ASIN(SQRT( POWER(SIN((? - stop_lat) * pi()/180 / 2), 2) 
                    +COS(? * pi()/180) * COS(stop_lat * pi()/180) 
                    *POWER(SIN((? - stop_lon) * pi()/180 / 2), 2) ))), 0) 
                    as k';
                $bindParam->add('d', $rad);
                $bindParam->add('d', $_POST["lat"]);
                $bindParam->add('d', $_POST["lat"]);
                $bindParam->add('d', $_POST["lon"]);
             }
         }
        
        if (isset($_POST["lon"]) && isset($_POST["lat"]) ){
            
            $rad = 0;

            // earth's radius in the unit of measure you want the results to be. 3956 for miles, 6356 for chilometers
            if ($isMetric) {
                $rad = 6356;
            } else {
                $rad = 3965;
            }

            /*
            // calculate lon and lat for the rectangle:
            $lon1 = $_POST["lon"] - $_POST["dist"] / abs(cos(deg2rad($_POST["lat"])) * 69);
            $lon2 = $_POST["lon"] + $_POST["dist"] / abs(cos(deg2rad($_POST["lat"])) * 69);
            $lat1 = $_POST["lat"] - ($_POST["dist"] / 69);
            $lat2 = $_POST["lat"] + ($_POST["dist"] / 69);
             */
            
            $queryString .= ', FORMAT(
                    ? * 2 * ASIN(SQRT( POWER(SIN((? - stop_lat) * pi()/180 / 2), 2) 
                    +COS(? * pi()/180) * COS(stop_lat * pi()/180) 
                    *POWER(SIN((? - stop_lon) * pi()/180 / 2), 2) )) , 3) 
                as distance';
            $bindParam->add('d', $rad);
            $bindParam->add('d', $_POST["lat"]);
            $bindParam->add('d', $_POST["lat"]);
            $bindParam->add('d', $_POST["lon"]); 
        }
        
        $queryString .= ' FROM stops WHERE agency_global_id = ?';
        $bindParam->add('s', $agid); 
        
        /*
        if (isset($_POST["lon"]) && isset($_POST["lat"]) ){
            $queryString .= ' and stop_lon between ? and ? 
                and stop_lat between ? and ? ';
            $bindParam->add('d', $lon1); 
            $bindParam->add('d', $lon2); 
            $bindParam->add('d', $lat1); 
            $bindParam->add('d', $lat2); 
        }
         *
         */
        
        if (isset($_POST["dist"])){
            $queryString .= ' HAVING distance < ? ';
            $bindParam->add('i', $_POST["dist"]); 
        }
        
        $queryString .= ' ORDER BY ';
        
         if($byName){
             $queryString .= 'stop_name';
         }else{
             if (isset($_POST["lon"]) && isset($_POST["lat"])){
                 $queryString .= 'distance';
             }
         }
        
        if ( isset($_POST["limitTo"]) ){
            $queryString = $queryString . ' LIMIT ?';
            $bindParam->add('i', $_POST["limitTo"]);
        }
        
        printf($queryString . '<br/>');

        $stmt = $db->prepare($queryString);

        call_user_func_array( array($stmt, 'bind_param'), $bindParam->get());
        
        $stmt->execute();
        
        printf("execute<br/>");
        
        $result = array();
        
        // VERIFICARE!!!

        if(!$byName && isset($_POST["lon"]) && isset($_POST["lat"])){
            $stmt->bind_result($stop_id, $stop_name, $lat, $lon, $k, $distance);
            while ($stmt->fetch()) {
                $row = array($stop_id, $stop_name, $lat, $lon, $k, $distance);
                array_push($result, $row);
                //printf("%s - %f<br/>",$stop_name, $distance);
            }
        }else {
            $stmt->bind_result($stop_id, $stop_name, $lat, $lon, $k);
            while ($stmt->fetch()) {
                $row = array($stop_id, $stop_name, $lat, $lon, $k);
                array_push($result, $row);
                //printf("%s - %f<br/>",$stop_name, $distance);
            }
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

