<a href="<?= URL; ?>orders/all" title="bestellingen">Bestellingen</a> | <a href="<?= URL; ?>users" title="klanten">Klanten</a> 
<h1>Alle klanten</h1>
<table class="striped-table">
	<tr>
		<td>Klantnr</td>
		<td>Naam</td>
		<td>Adres</td>
		<td>Actie</td>
	</tr>
	<?php
		foreach($this->data as $klant)
		{
			echo "
				<tr>
					<td>".$klant['klantnr']."</td>
					<td>".$klant['voornaam']." ".$klant['tussenvoegsel']." ".$klant['achternaam']."</td>
					<td>".$klant['adres']."<br />".$klant['postcode']." ".$klant['woonplaats']."</td>
					<td><a href=\"".URL."users/details/".$klant['klantnr']."\">Details</a></td>
				</tr>
			";
		}
	?>
</table>