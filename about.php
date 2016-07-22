<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: About Us');
$smarty->assign('page_name_location', 'images/titles/about.png');
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
	
	function BoardMember($title, $line) {
		$this->title = $title;
		$line = explode(' ', $line);
		$this->expires = strtotime(array_shift($line).' '.array_shift($line));
		$line = implode(' ', $line);
		$this->name = $line;
	}
}

$wc_board_members = explode("\n", file_get_contents('website_config/board_members'));

$president = new BoardMember('President', array_shift($wc_board_members));
$vicepres = new BoardMember('Vice President', array_shift($wc_board_members));
$secretary = new BoardMember('Treasurer/Secretary', array_shift($wc_board_members));

// No title
$untitled = array();
$member = new BoardMember(null, array_shift($wc_board_members));
$untitled[] = $member;

$member = new BoardMember(null, array_shift($wc_board_members));
$untitled[] = $member;

$board = array(
	$president,
	$vicepres,
	$secretary
);
foreach($untitled as $mem)
{
	$board[] = $mem;
}

// Members list
$smarty->assign('members', array(
	'title' => 'Our Board Members',
	'th_name' => 'Name',
	'th_title' => 'Title',
	'th_expires' => 'Expires',
	'board' => $board,
));

// Links
$wc_links = explode("\n", file_get_contents('website_config/links'));
$about_links = array();
$c = 0;
while (true) {
	$line = array_shift($wc_links);
	if (strpos($line, '--') === 0) {
		$c++;
		continue;
	}
	if ($c > 4) break;
	if ($c < 4) continue;
	$line = explode('|', $line);
	$about_links[$line[0]] = trim($line[1]);
}
$smarty->assign('about_links', $about_links);

// Map
$smarty->assign('ccn_small', 'service_map_cropped_reduced.jpg');
$smarty->assign('ccn_large', 'service_map_cropped.jpg');
$smarty->assign('office', 'Office Location');
$smarty->assign('ccn_area', 'Service Area (Click for larger image)');

// Display page
$smarty->display('about.tpl');
?>