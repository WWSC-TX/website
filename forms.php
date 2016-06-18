<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Forms');
$smarty->assign('page_name_location', 'images/titles/forms.png');
$smarty->assign('page_name_alt', 'Forms');

// Forms listing
$smarty->assign('form_links', array(
	'Standard Application and Agreement Form' => 'standard_application_form.pdf',
	'Membership Transfer Authorization' => 'membership_transfer_authorization.pdf',
	'Alternative Billing Agreement for Rental Account' => 'alternative_billing_agreement.pdf',
	'Application for Board of Directors Position' => 'application_for_board_of_directors.pdf',
));

// Display page
$smarty->display('forms.tpl');
?>