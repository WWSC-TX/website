<?php
if(!defined('PUBLIC_PAGE'))
	exit(1);

require('cgi/Smarty.class.php');
// Create Smarty object
$smarty = new Smarty;
$smarty->caching = false;

define('COMMON_INCLUDED', true);

include('header.php');
include('footer.php');
include('news.php');
?>