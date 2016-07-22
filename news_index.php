<?php
if(!defined('COMMON_INCLUDED'))
	exit(1);

$wc_links = explode("\n", file_get_contents('website_config/links'));
$news = array_shift($wc_links);
$news_index_links = array();
while(true) {
	$line = array_shift($wc_links);
	if (strpos($line, '--') === 0) break;
	$line = explode('|', $line);
	if (strpos($line[1], 'http') === 0) {
		$news_index_links['external'][$line[0]] = trim($line[1]);
	} else {
		$news_index_links['file'][$line[0]] = trim($line[1]);
	}
}
$smarty->assign('news', 'Weston Water News');
$smarty->assign('news_text', $news);
$smarty->assign('text', $news_index_links['file']);
$smarty->assign('links', $news_index_links['external']);
?>