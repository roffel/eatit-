<h1>Bestellijst</h1>
<?php
$orderregels = $this->data;
var_dump($orderregels);
foreach ($orderregels as $orderregel) {
	echo $orderregel[0];
}
?>
<div class="big-btn">Bestellen</div>
<div style="clear: both;"></div>
