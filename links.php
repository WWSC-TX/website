<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Links');
$smarty->assign('page_name_location', 'images/titles/links.png');
$smarty->assign('page_name_alt', 'Links');

$smarty->assign('introduction', 'The following links may be of interest to you, our member or prospective member.');

$wc_links = explode("\n", file_get_contents('website_config/links'));
$links = array();
$c = 0;
while (sizeof($wc_links) > 0) {
	$line = array_shift($wc_links);
	if (strpos($line, '--') === 0) {
		$c++;
		continue;
	}
	if ($c < 5) continue;
	$line = explode('|', $line);
	$links[$line[0]] = trim($line[1]);
}
$smarty->assign('links', $links);

// Display page
$smarty->display('links.tpl');
?>