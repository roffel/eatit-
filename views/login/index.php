<h1>Inloggen</h1>
<form action="login/run" method="post">
	E-mail:<br />
	<input type="text" name="email" /><br /><br />
	Wachtwoord:<br />
	<input type="password" name="password" /><br /><br />
	<br /><br />
	<a href="<?php echo URL; ?>/login/register" title="Registreren">Geen account? Registreer hier!</a> <input class="floatr" type="submit" value="Inloggen" />
</form>