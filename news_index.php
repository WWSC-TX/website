<?php
if(!defined('COMMON_INCLUDED'))
	exit(1);

$smarty->assign('news', 'Weston Water News');
$smarty->assign('text', array(
	'Rate Increase from North Texas Groundwater Conservation District' => 'notification_of_rate_increase.pdf',
	'Consumer Confidence Report' => 'CCR 2014.pdf'
));
$smarty->assign('links', array(
	'Water IQ: Know your Water' => 'http://www.wateriq.org/',
	'Water, Use it Wisely' => 'http://www.wateruseitwisely.com/index.php',
	'Texas Water Conservation Association' => 'http://www.twca.org/',
	'Texas Water Development Board' => 'http://www.twdb.texas.gov/',
	'North Texas Groundwater Conservation District' => 'http://northtexasgcd.org/',
	'Texas Commission on Environmental Quality (TCEQ)' => 'http://www.tceq.state.tx.us/'
))
?>