<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Policy Information');
$smarty->assign('page_name_location', '/images/titles/policy.png');
$smarty->assign('page_name_alt', 'Policy Information');

// Weston WSC Policy
$smarty->assign('tariff_title', 'Weston Water Supply Corporation Tariff');
$smarty->assign('tariff_file', 'Tariff_01-01-2014.pdf');

$smarty->assign('bylaws_title', 'Weston Water Supply Corporation By-Laws');
$smarty->assign('bylaws_file', 'bylaws_r2013-01.pdf');

$smarty->assign('drought_title', 'Drought Contingency Plan');
$smarty->assign('drought_file', 'drought_contingency_plan_10-27-2014.pdf');

$smarty->assign('privacy_title', 'Privacy Policy');
$smarty->assign('privacy_file', 'privacy.pdf');

// Display page
$smarty->display('policy.tpl');
?>