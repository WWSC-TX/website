<?php
if(!defined('COMMON_INCLUDED'))
	exit(1);

$smarty->assign('menu', array(
		'Home'					=> '',
		'Archives'			=> 'archives.php',
		'Forms'					=> 'forms.php',
		'Policies'			=> 'policy.php',
		'Rates & Fees'	=> 'rates.php',
		'About Us'			=> 'about.php',
		'Links'					=> 'links.php'
	));

$smarty->assign('welcome', 'Welcome!');
$smarty->assign('welcome_text', 'We are a non-profit rural water company that
	serves over 200 customers near Weston, Texas with one well and one water
	tower.');
?>