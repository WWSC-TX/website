<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Frequently Asked Questions');
$smarty->assign('page_name_location', 'images/titles/faq.png');
$smarty->assign('page_name_alt', 'Frequently Asked Questions');

// Display page
$smarty->display('faq.tpl');
?>