<?php
if(!defined('COMMON_INCLUDED'))
	exit(1);

$smarty->assign('office_hours', array(
	'label' => 'Office Hours:',
	'text' => array('Mondays and Wednesdays',
									'10:00am - 2:00pm')
));
$smarty->assign('office_location', array(
	'label' => 'Office Location:',
	'text' => array('406 Chicken Street', 'Weston, TX 75097')
));
$smarty->assign('office_phone', array(
	'label' => 'Phone:',
	'text' => '972-382-2445'
));
$smarty->assign('office_manager', array(
	'label' => 'Office Manager:',
	'text' => 'Carmen Laguardia',
	'email' => 'westonwater@gmail.com'
));
$smarty->assign('emergency_contact', array(
	'label' => 'Emergency Contact:',
	'text' => array('James Atkins', '214-733-0585', '(In case of water leak or other emergency)')
));
?>