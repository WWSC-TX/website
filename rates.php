<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Rates & Fees');
$smarty->assign('page_name_location', 'images/titles/rates.png');
$smarty->assign('page_name_alt', 'Rates and Fees');

// Rates
$wc_rates = explode("\n", file_get_contents('website_config/rates'));
$smarty->assign('base', array(
	'label' => 'Base Rate:',
	'cost' => array_shift($wc_rates),
	'caption' => 'Household Base Rates (Up to 3/4" Meter)'
));
$smarty->assign('header', array('Gallons', 'Amount (per 1,000 gal)'));
$prices = array();
foreach ($wc_rates as $ln) {
	$ln = explode(' ', $ln);
	$price = array_shift($ln);
	$label = implode(' ', $ln);
	$prices[$label] = $price;
}
$smarty->assign('prices', $prices);

// Links
$wc_links = explode("\n", file_get_contents('website_config/links'));
$rates_links = array();
$c = 0;
while (true) {
	$line = array_shift($wc_links);
	if (strpos($line, '--') === 0) {
		$c++;
		continue;
	}
	if ($c > 3) break;
	if ($c < 3) continue;
	$line = explode('|', $line);
	$rates_links[$line[0]] = trim($line[1]);
}
$smarty->assign('rates_links', $rates_links);

// Display page
$smarty->display('rates.tpl');
?>