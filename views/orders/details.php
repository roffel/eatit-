<?php 
	$data = $this->data;
?>
<h1>Details (Order: <?=$data['ordernr'];?>)</h1>
<span>Status: <strong><?=$data['status'];?></strong></span><br />
<span>Order geplaats op: <?=$data['tijd'];?></span>
<h2>Klantgegevens:</h2>
<address>
	<?=$data['klant']['voornaam']." ".$data['klant']['tussenvoegsel']." ".$data['klant']['achternaam']."<br />"; ?>
	<?=$data['klant']['adres']."<br />";?>
	<?=$data['klant']['postcode']." ".$data['klant']['woonplaats']; ?>
</address>
<h2>Bestelling:</h2>
<table class="striped-table">
	<tr><td>Naam:</td><td>Aantal:</td></tr>
<?php
	foreach ($data['orderregels'] as $orderregel)
	{
		echo "<tr><td>".$orderregel['menu']."".$orderregel['side']."</td><td></td></tr>";
	}
?>
</table>