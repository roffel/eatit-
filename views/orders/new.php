<div class="bleft floatl">
	<h1>Bestellijst</h1>
	<?php
	$orderregels = $this->data;
	echo "<table class=\"striped-table\">";
	echo "<tr><td>Naam:</td><td>Aantal:</td><td>Prijs:</td><td>Totaal:</td></tr>";
	foreach ($orderregels as $orderregel)
	{
		if(isset($orderregel['naam']))
		{
			echo "
			<tr>
				<td>".$orderregel["naam"]."</td>
				<td>".$orderregel["aantal"]."x</td>
				<td>&euro; ".$orderregel["prijs"]."</td>
				<td>&euro; ".$orderregel["totaal"]."</td>
			</tr>";
		}
	}
	echo "<tr><td></td><td></td><td>Subtotaal:</td><td>&euro; ".$orderregels['subtotaal']."</td></tr>";
	echo "</table>";
	?>
	<div class="big-btn floatr">Bestellen</div>
</div>
<div class="bright floatr">
	<strong>Nog iets te drinken?</strong>
</div>
<div style="clear: both;"></div>
<script>
	$(document).ready(function() {
		$("#wrapper").css("background-color","transparent");
	});
</script>
