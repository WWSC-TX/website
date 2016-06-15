<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Links');
$smarty->assign('page_name_location', '/images/titles/links.png');
$smarty->assign('page_name_alt', 'Links');

$smarty->assign('introduction', 'The following links may be of interest to you, our member or prospective member.');

$smarty->assign('links', array(
	'Texas Rural Water Association' => 'http://trwa.org/',
	'Texas Commission on Environmental Quality (Formerly Texas Natural Resource Conservation Commission)' => 'http://www.tceq.state.tx.us/',
	'North Texas Groundwater Conservation District' => 'http://northtexasgcd.org/'
));

// Display page
$smarty->display('links.tpl');
?>