<?php $data = $this->data; ?>
<h1>Bedankt!</h1>
<p>Uw order is geplaats, bedankt voor het bestellen bij EatIT.
Binnen een half uur zal een bezorger de order afleveren bij:</p>

<address>
<?=$data[0]['adres'];?><br />
<?=$data[0]['postcode']." ".$data[0]['woonplaats'];?>
</address>
