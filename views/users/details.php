<a href="<?= URL; ?>orders/all" title="bestellingen">Bestellingen</a> | <a href="<?= URL; ?>users" title="klanten">Klanten</a> 
<?php
foreach ($this->data as $klant)
{
	echo "<h1>Klant (".$klant['klantnr'].")</h1>";
	echo "<address>";
	echo "<strong>".$klant['voornaam']." ".$klant['tussenvoegsel']." ".$klant['achternaam']."</strong><br />";
	echo $klant['adres']."<br />";
	echo $klant['postcode']." ".$klant['woonplaats']."<br />";
	echo "Tel: <a href=\"tel: ".$klant['telefoon']."\">".$klant['telefoon']."</a><br />";
	echo "E-mail: <a href=\"mailto: ".$klant['email']."\">".$klant['email']."</a><br />";
	echo "</address>";
}
?>
<div style="clear: both;"></div>
