<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Rates & Fees');
$smarty->assign('page_name_location', '/images/titles/rates.png');
$smarty->assign('page_name_alt', 'Rates and Fees');

// Rates
$smarty->assign('base', array(
	'label' => 'Base Rate:',
	'cost' => '$20.93',
	'caption' => 'Household Base Rates (Up to 3/4" Meter)'
));
$smarty->assign('header', array('Gallons', 'Amount (per 1,000 gal)'));
$smarty->assign('prices', array(
	'0-3,000' => '$2.80',
	'3,001-10,000' => '$3.69',
	'10,001-15,000' => '$5.04',
	'15,001-20,000' => '$6.40',
	'20,000 or more' => '$8.06'
));
$smarty->assign('see_more', 'See Tariff for Additional Rates');
$smarty->assign('tariff_document', 'tariffs_r2012-12.pdf');

// Display page
$smarty->display('rates.tpl');
?>