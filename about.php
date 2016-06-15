<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: About Us');
$smarty->assign('page_name_location', '/images/titles/about.png');
$smarty->assign('page_name_alt', 'About Us');

// Google Map; see http://code.google.com/apis/maps/documentation/staticmaps/ for more information
$smarty->assign('show_service_area', true);
$smarty->assign('center', ''); // Center of the map. Required unless markers is supplied
$smarty->assign('zoom', ''); // Zoom level, from 0 (Earth) to 21 (buildings). Required unless markers is supplied
$smarty->assign('size', '300x300'); // Image size {width}x{height}. Required
$smarty->assign('scale', ''); // 1, 2 or 4. Defines resolution of the image. Optional
$smarty->assign('format', ''); // png, png8, png32, gif, jpg, or jpg-baseline. Optional
$smarty->assign('maptype', ''); // roadmap, satellite, terrain, or hybrid. Optional
$smarty->assign('language', ''); // Optional
$smarty->assign('markers', '406 chicken st weston, tx 75097'); // Places markers on the map. Removes the requirement for center and zoom. Optional
$smarty->assign('path', ''); // Defines a path to show on the map. Optional
$smarty->assign('visible', ''); // Specify locations that should remain visible. Optional
$smarty->assign('style', ''); // Modify the appearance of features on the map. Optional
$smarty->assign('sensor', 'false'); // Declare whether the user's position should be reported. Required

// Keep track of board member information more easily when
// passing to the templating engine
class BoardMember
{
	public $name;
	public $title;
	public $expires;
	public $address;
	public $email;
	public $phone;
}

// President
$president = new BoardMember();
$president->name = 'Tony Del Plato';
$president->title = 'President';
$president->expires = strtotime('March 2018');
$president->address = array('P.O. Box 237',
															'Weston, Texas 75097');
$president->email = array('Tdelplato@Karlee.com');
$president->phone = array('Home' => '972-740-8561');

// Vice President
$vicepres = new BoardMember();
$vicepres->name = 'Kevin Thomson';
$vicepres->title = 'Vice President';
$vicepres->expires = strtotime('March 2019');
$vicepres->address = array('9704 Lake Trail',
														'Celina, Texas 75009');
$vicepres->email = array('eldoradovet@sbcglobal.net');
$vicepres->phone = array('Home' => '972-529-1367',
													'Cell' => '',
													'Work' => '');

// Treasurer/Secretary
$secretary = new BoardMember();
$secretary->name = 'Linne Shields';
$secretary->title = 'Treasurer/Secretary';
$secretary->expires = strtotime('March 2019');
$secretary->address = array('3600 Windy Hill Rd.',
																'Celina, Texas 75009');
$secretary->email = array('linne@ojodeagua.com');
$secretary->phone = array('Cell' => '469-964-1571');

// No title
$untitled = array();
$member = new BoardMember();
$member->name = 'Larry McNeny';
$member->expires = strtotime('March 2017');
$member->address = array('',
													'');
$member->email = array('');
$member->phone = array('' => '');
$untitled[] = $member;

$member = new BoardMember();
$member->name = 'Jason Cole';
$member->expires = strtotime('March 2017');
$member->address = array('',
													'');
$member->email = array('');
$member->phone = array('Cell' => '');
$untitled[] = $member;

$board = array(
	$president,
	$vicepres,
	$secretary
);
foreach($untitled as $mem)
	$board[] = $mem;

// Members list
$smarty->assign('members', array(
	'title' => 'Our Board Members',
	'term' => '',
	'th_name' => 'Name',
	'th_title' => 'Title',
	'th_expires' => 'Expires',
	'th_address' => 'Address',
	'th_phone' => 'Contact',
	'board' => $board,
));

$smarty->assign('bylaws', 'Bylaws');
$smarty->assign('bylaws_link', 'bylaws_r2003-04.pdf');

// Map
$smarty->assign('ccn_small', 'service_map_cropped_reduced.jpg');
$smarty->assign('ccn_large', 'service_map_cropped.jpg');
$smarty->assign('office', 'Office Location');
$smarty->assign('ccn_area', 'Service Area (Click for larger image)');

// Display page
$smarty->display('about.tpl');
?>