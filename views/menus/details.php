<?php
$menus = $this->data;

foreach ($menus as $menu) {
    echo "	<h1>Menu: $menu[titel]</h1>\n";
    echo "	<span>Categorie: Vegetarisch</span><br /> \n";
    echo "	<span>Prijs: &euro;$menu[prijs]</span>";
    echo "	<p>$menu[beschrijving]</p>\n";
    echo ' 	<div class="detail-order-btn"><a href="bestel/'.$menu['id'].'">Bestellen</a></div>';
}
?>
<div style="clear: both;"></div>
