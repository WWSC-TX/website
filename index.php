<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('page_name_location', 'images/titles/home.png');
$smarty->assign('page_name_alt', 'Weston Water');

// Right Column text
$meeting_dates_year = 2016;
$meeting_dates = array(
	'Jan 18' => array(),
	'Feb 29' => array(),
	'Mar 28' => array(),
	'Apr 25' => array(),
	'May 30' => array(),
	'Jun 27' => array(),
	'Jul 25' => array(),
	'Aug 29' => array(),
	'Sep 26' => array(),
	'Oct 24' => array(),
	'Nov 28' => array(),
	'Dec 19' => array()
);
$smarty->assign('meeting_dates_heading', $meeting_dates_year.' Meeting Dates');
$smarty->assign('meeting_time', 'Meetings held at 7:00pm.');

$minutes = scandir('minutes_archive');
$agendas = scandir('agendas');

foreach($agendas as $date)
{
	// Skip the file if it's not a PDF
	if(!preg_match('/.pdf$/', $date)) continue;
	
	// Split the filename into year/month/day
	$date_name = substr($date, 0, strpos($date, '.'));
	$dateparts = explode('-', $date_name);
	$year = $dateparts[0];
	$month = $dateparts[1];
	$day = $dateparts[2];
	
	// Skip the file if it's the wrong year
	if($year != $meeting_dates_year) continue;
	
	foreach($meeting_dates as $meet_day=>$link)
	{
		// We can set the link to an agenda
		if(strtotime($meet_day.', '.$meeting_dates_year) == strtotime($year.'/'.$month.'/'.$day))
		{
			$meeting_dates[$meet_day]['agenda'] = $date;
			break;
		}
	}
}

foreach($minutes as $date)
{
	// Skip the file if it's not a PDF
	if(!preg_match('/.pdf$/', $date)) continue;
	
	// Split the filename into year/month/day
	$date_name = substr($date, 0, strpos($date, '.'));
	$dateparts = explode('-', $date_name);
	$year = $dateparts[0];
	$month = $dateparts[1];
	$day = $dateparts[2];
	
	// Skip the file if it's the wrong year
	if($year != $meeting_dates_year) continue;
	
	foreach($meeting_dates as $meet_day=>$link)
	{
		// We can set the link to an agenda
		if(strtotime($meet_day.', '.$meeting_dates_year) == strtotime($year.'/'.$month.'/'.$day))
		{
			$meeting_dates[$meet_day]['minutes'] = $date;
			break;
		}
	}
}

$smarty->assign('meeting_dates', $meeting_dates);

// Center column is news
include('news_index.php');

// Display page
$smarty->display('index.tpl');
?>