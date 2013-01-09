<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>
    <?= (isset($title) ? $title : 'Untitled Document' . PHP_EOL); ?>
</title>

<script type="text/javascript" src="js/jquery-1.8.0.js"></script>
<script type="text/javascript" src="js/utility.js"></script>
<!-- custom ui: hide, tabs -->
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>

<link href="css/positioning.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="css/top-menu-bar.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/base/jquery.ui.all.css"/>

<!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* this 1px negative margin can be placed on any of the columns in this layout with the same corrective effect. */
ul.nav a { zoom: 1; }  /* the zoom property gives IE the hasLayout trigger it needs to correct extra whiltespace between the links */
</style>
<![endif]-->

<!-- PHP directives -->
<? error_reporting(E_ALL); ?>

<!-- PHP classes -->
<?

class topMenuItem {

    // property declaration
    public $name = '_';
    public $href = '#';
    public $lista;

    public function __construct($name, $href, $lista) {
        $this->name = $name;
        $this->href = $href;
        $this->lista = $lista;
    }

}
?>

<!-- PHP VARIABLES -->
<?
$topMenuItems = array(
    new topMenuItem('Path', '\\', [])
    , new topMenuItem('Ticket', '#', [])
    , new topMenuItem('Touristic', '#', ['Straight to the point' => '#'
        , 'Half day tours' => '#'
        , 'Full day tours' => '#'
        , 'Events' => '#'])
    , new topMenuItem('Info', '#', ['Routes and timetables' => '#'
        , 'Prices' => '#'
        , 'News and alerts' => '#'
        , 'Ticket offices' => '#'
        , 'Zones' => '#'
        , 'Stops' => '#'
        , 'Fleat' => '#'])
    , new topMenuItem('Feedbacks', '#', ['General' => '#'
        , 'Carriers' => '#'
        , 'Routes' => '#'
        , 'Stops' => '#'])
);
?>

<!-- PHP functions -->
<? include 'utility.php'; ?>