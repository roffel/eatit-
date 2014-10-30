<h1>Menu's</h1>
<?php
$menus = $this->data;

foreach ($menus as $menu) {
	echo "<div onclick=\"location.href='menus/details/$menu[id]';\" class=\"active-menu\">";
    echo "	<h2>$menu[naam]</h2>\n";
    echo "	<p>$menu[omschrijving]</p>\n";
    echo "</div>";
}
?>
<div style="clear: both;"></div>
