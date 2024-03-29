<?php
$menus = $this->data;
foreach ($menus as $menu)
{
    echo "	<h1>Menu: $menu[naam]</h1>\n";
    echo "	<span>Categorie: Vegetarisch</span><br /> \n";
    echo "	<span>Prijs: &euro;$menu[prijs]</span>";
    echo "	<p>$menu[omschrijving]</p>\n";
    if(!$menu['beschikbaar'])
    {
        echo "<div class=\"error\">Dit menu is uitverkocht. Excuses voor het ongemak.</div>";
    }
    else
    {
        if(@$_SESSION['user']['rang'] != "gebruiker")
        {
            echo '<div class="big-btn"><a href="'.URL.'login">Inloggen om te bestellen.</a></div>';
        }
        else
        {
            echo '<div class="big-btn"><a href="'.URL.'orders/addtoorder/'.$menu['menunr'].'-menu">Bestellen</a></div>';
        }
    }
}

echo "<h2>Op dit menu:</h2>";
foreach ($menus[0]['gerechten'] as $gerecht)
{
	echo "<div class=\"gerecht\">";
    echo "	<h3>".$gerecht['naam']."</h3>";
    echo "	<p>".$gerecht['omschrijving']."</p>";
    echo "</div>";
}
echo "<h2>In deze gerechten:</h2>";
echo "<ul>";
foreach ($menus[0]['ingredienten'] as $ingredient)
{
	echo "<li>".$ingredient['naam']." </li>";
}
echo "</ul>";
?>
<div style="clear: both;"></div>
