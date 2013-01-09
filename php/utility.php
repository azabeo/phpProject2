<!-- PHP general utility functions -->
<?

define("LOG", 1);
define("ADMINS", "alex.zabeo@gmail.com");

// creates li list with highlited selected item 
function menuList($items, $selectedItem, $selectedItemStyleName) {
    $i = 0;
    foreach ($items as $item => $link) {
        echo '<li', ($i == $selectedItem) ? ' class = "' . $selectedItemStyleName . '"' : '', '><a href="', $link, '">', $item, '</a></li>', PHP_EOL;
        $i++;
    }
}

function mysqlConnect($isLocal) {
    if ($isLocal) {
        
        $mysqli = new mysqli("localhost", "root", "root", "ipmobman");
        if ($mysqli->connect_errno) {
            //echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return null;
        }
    }
    return $mysqli;
}

function log_string($string,$color,$alert){
    if(LOG == 0){
        return;
    }
    if ($alert!=0) {
        echo '<script type="text/javascript">';
        echo 'window.alert("' . $string . '");';
        echo '</script>';
    }  else {
        if (isset($color)) {
            echo '<FONT COLOR="'. $color . '">' . $string . '</FONT><br/>';
        }else{
            echo $string . '<br/>';
        }
    }
    
}

function send_mail_to_admin($string){
    // will send mails with errors
    log_string('Mail to: ' . ADMINS . ' -- "' . $string .'"');
}
?>