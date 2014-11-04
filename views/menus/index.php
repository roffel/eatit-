<h1>Menu's</h1>
<?php
$menus = $this->data;
echo "<h2>Vandaag</h2>";
echo "<table>";
foreach ($menus as $menu)
{
	echo "	<tr>";
	echo "		<td style=\"text-align: top;\"><img src=\"".URL."/public/img/icon-".$menu['soort'].".png\" alt=\"".$menu['naam']."\" style=\"margin-right: 50px; margin-top: -100px;\"  /></td>";
	echo "		<td>";
    echo "			<h3>$menu[naam]</h3>\n";
    echo "			Soort: <span>$menu[soort]</span>\n";
    echo "			<p>$menu[omschrijving]</p>\n";
    echo "			<div class=\"big-btn\" onclick=\"location.href='menus/details/$menu[menunr]';\">Meer informatie</div><br /><br />";
    echo "		</td>";
    echo "	</tr>";
}
echo "</table>";
echo '<div style="clear:both;"></div>';
?>
<div style="clear: both;"></div>
