<div id="header">
    <div id="top-menu-bar">
<?php
      foreach ($topMenuItems as $topMenuItem) {
      	echo '      <a class="top-menu-item" id="top-menu-item-' , $topMenuItem->name , '" href="' , $topMenuItem->href , '">' , $topMenuItem->name , '</a>' , PHP_EOL;
      }
?>
    </div>
<?php 
	foreach ($topMenuItems as $topMenuItem) {
	  if (count($topMenuItem->lista) >=1 ) {  
		echo '    <div class="top-menu-dropdown" id="top-menu-dropdown-' , $topMenuItem->name , '">' , PHP_EOL;
		echo '      <div class="top-menu-dropdown-inner">', PHP_EOL;
		foreach ($array_expression as $key => $value) {
			;
		}
		foreach ($topMenuItem->lista as $name => $href) {
			echo '        <a href="', $href, '">', $name, '</a>', PHP_EOL;
		}
		echo '      </div>', PHP_EOL;
		echo '    </div>', PHP_EOL;
	  }
	}
?>
</div>

<script type="text/javascript">
<?php
	foreach ($topMenuItems as $topMenuItem) { 
	  if (count($topMenuItem->lista) >=1 ) {
		echo '  $(document).ready(activateDropDown("top-menu-","', $topMenuItem->name, '"));', PHP_EOL;
	  }
	}
?>
</script>

