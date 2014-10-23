<h1>Menu's</h1>
<?php
$menus = $this->data;

foreach ($menus as $menu) {
	echo "<div onclick=\"location.href='menus/details/$menu[id]';\" class=\"active-menu\">";
    echo "	<h2>$menu[titel]</h2>\n";
    echo "	<p>$menu[beschrijving]</p>\n";
    echo "</div>";
}
?>
<div style="clear: both;"></div>
