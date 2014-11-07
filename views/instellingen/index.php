<?php
	$data = $this->data[0];
	if(isset($this->melding))
	{
		$melding = $this->melding;
	}
	else
	{
		$melding = "";
	}
?>
<h1>Instellingen</h1>
<div id="melding"><?=$melding;?></div>
<form  method="post" action="<?= URL; ?>instellingen/opslaan">
	<table style="width: 100%;">
		<tr>
			<td>Voornaam:</td><td ><input value="<?=$data['voornaam'];?>"name="voornaam" type="text" /></td>
		</tr>
		<tr>
			<td>Tussenvoegsel:</td><td><input value="<?=$data['tussenvoegsel'];?>" name="tussenvoegsel" type="text" /></td>
		</tr>
		<tr>
			<td>Achternaam:</td><td><input value="<?=$data['achternaam'];?>" name="achternaam" type="text" /></td>
		</tr>
		<tr>
			<td >Adres:</td><td><input name="adres" value="<?=$data['adres'];?>" type="text" /></td>
		</tr>
		<tr>
			<td>Postcode:</td><td><input value="<?=$data['postcode'];?>" name="postcode" type="text" /></td>
		</tr>
		<tr>
			<td>Telefoonnummer:</td><td><input value="<?=$data['telefoon'];?>" name="telefoon" type="text" /></td>
		</tr>		
		<tr>
			<td>Woonplaats:</td><td><input value="<?=$data['woonplaats'];?>" name="woonplaats" type="text" /></td>
		</tr>
		<tr>
			<td>Wachtwoord:</td><td><input name="wachtwoord" type="text" /></td>
		</tr>		
		<tr>
			<td></td>
			<td><input type="submit" value="Opslaan" /></td>
		</tr>				
	</table>
</form>