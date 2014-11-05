<?php 
	$data = $this->data;
?>
<h1>Details (Order: <?=$data['ordernr'];?>)</h1>
Status: <strong id="orderstatus"><?=$data['status'];?></strong> <a href="#orderstatus" id="showeditstatus">[Aanpassen]</a>
<form id="statusform" method="post">
	<select name="editstatus">
		<option value="geplaatst">Geplaatst</option>
		<option value="klaar">Klaar</option>
		<option value="afgehandeld">Afgehandeld</option>
	</select>
	<input type="submit" value="opslaan" />
</form>
<br />
<span>Order geplaats op: <?=$data['tijd'];?></span>
<h2>Klantgegevens:</h2>
<address>
	<?=$data['klant']['voornaam']." ".$data['klant']['tussenvoegsel']." ".$data['klant']['achternaam']."<br />"; ?>
	<?=$data['klant']['adres']."<br />";?>
	<?=$data['klant']['postcode']." ".$data['klant']['woonplaats']; ?>
</address>
<h2>Bestelling:</h2>
<table class="striped-table">
	<tr><td>Naam:</td><td>Aantal:</td><td>Prijs:</td></tr>
<?php
	foreach ($data['orderregels'] as $orderregel)
	{
		echo "<tr><td>".$orderregel['menu']."".$orderregel['side']."</td><td></td><td>&euro; ".$orderregel['prijs']."</td></tr>";
	}
	echo "<tr><td></td><td>Subtotaal:</td><td>&euro; ".$data['subtotaal']."</td></tr>";
?>
</table>

<script>
	$(document).ready(function(){
		$("#showeditstatus").click( function(){
			$("#orderstatus").hide();
			$(this).hide();
			$("#statusform").css("display","inline");
		});
	});
</script>