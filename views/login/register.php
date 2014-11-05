<?= $this->text; ?>
<h1>Registreren</h1>
<form method="post" id="regform">
	<table style="width: 100%;">
		<tr>
			<td>Voornaam:</td><td colspan="3"><input name="voornaam" type="text" /></td>
		</tr>
		<tr>
			<td>Tussenvoegsel:</td><td colspan="3"><input name="tussenvoegsel" type="text" /></td>
		</tr>
		<tr>
			<td>Achternaam:</td><td colspan="3"><input name="achternaam" type="text" /></td>
		</tr>
		<tr>
			<td>E-mailadres:</td><td colspan="3"><input name="email" type="email" /></td>
		</tr>
		<tr>
			<td>Straat:</td><td><input name="straat" type="text" /></td><td>Huisnummer:</td><td><input name="huisnummer" type="text" /></td>
		</tr>
		<tr>
			<td>Postcode:</td><td colspan="3"><input name="postcode" type="text" /></td>
		</tr>
		<tr>
			<td>Woonplaats:</td><td colspan="3"><input name="woonplaats" type="text" /></td>
		</tr>
		<tr>
			<td colspan="3"><a href="index" title="inloggen">Ik heb al een account</a></td>
			<td><input type="submit" value="Registreren" /></td>
		</tr>				
	</table>
</form>