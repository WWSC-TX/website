<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Forms');
$smarty->assign('page_name_location', 'images/titles/forms.png');
$smarty->assign('page_name_alt', 'Forms');

// Forms listing
$wc_links = explode("\n", file_get_contents('website_config/links'));
$forms_links = array();
$c = 0;
while (true) {
	$line = array_shift($wc_links);
	if (strpos($line, '--') === 0) {
		$c++;
		continue;
	}
	if ($c > 1) break;
	if ($c < 1) continue;
	$line = explode('|', $line);
	$form_links[$line[0]] = trim($line[1]);
}

$smarty->assign('form_links', $form_links);

// Display page
$smarty->display('forms.tpl');
?>