<?php
if(!defined('COMMON_INCLUDED'))
	exit(1);

$wc_sidebar = explode("\n", file_get_contents('website_config/sidebar'));
$sidebar = array();
while (($ln = array_shift($wc_sidebar)) !== null) {
	if ($ln[0] === ' ') {
		if (strpos($ln, 'email:') !== false) {
			$sidebar[sizeof($sidebar) - 1]['email'] = substr($ln, 7);
		} else {
			$sidebar[sizeof($sidebar) - 1]['text'][] = trim($ln);
		}
	} else {
		$sidebar[] = array('label' => $ln, 'text' => array(), 'email' => '');
	}
}
$smarty->assign('sidebar', $sidebar);
?>