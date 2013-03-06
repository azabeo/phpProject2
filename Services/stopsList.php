<?php
include 'utility/getStopList.php';

$result = getStopList();

if (!is_null($result) ){
    echo json_encode($result);
}

?>
