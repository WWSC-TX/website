<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Policy Information');
$smarty->assign('page_name_location', 'images/titles/policy.png');
$smarty->assign('page_name_alt', 'Policy Information');

// Weston WSC Policy
$wc_links = explode("\n", file_get_contents('website_config/links'));
$policy_links = array();
$c = 0;
while (true) {
	$line = array_shift($wc_links);
	if (strpos($line, '--') === 0) {
		$c++;
		continue;
	}
	if ($c > 2) break;
	if ($c < 2) continue;
	$line = explode('|', $line);
	$policy_links[$line[0]] = trim($line[1]);
}
$smarty->assign('policy_links', $policy_links);

// Display page
$smarty->display('policy.tpl');
?>