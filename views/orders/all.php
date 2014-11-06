<a href="<?= URL; ?>orders/all" title="bestellingen">Bestellingen</a> | <a href="<?= URL; ?>users" title="klanten">Klanten</a> 
<h1>Bestellingen</h1>
<table class="striped-table">
	<tr><td>#</td><td>Klantnummer</td><td>Status:</td><td>Geplaatst op:</td><td>Actie</td></tr>
<?php
	foreach ($this->data as $order)
	{
		echo "<tr><td>".$order['ordernr']."</td><td><abbr title=\"".$order['voornaam']." ".$order['tussenvoegsel']." ".$order['achternaam']."\">".$order['klantnr']." (".$order['achternaam'].")</abbr></td><td>".$order['status']."</td><td>".$order['tijd']."</td><td><a href=\"".URL."orders/details/".$order['ordernr']."\">Details</a> | Verwijderen</td></tr>";
	}
?>
</table>