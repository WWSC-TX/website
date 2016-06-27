<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('page_name_location', 'images/titles/home.png');
$smarty->assign('page_name_alt', 'Weston Water');

// Right Column text
$wc_meeting_dates = explode("\n", file_get_contents('website_config/meeting_dates'));
$meeting_dates_year = intval(array_shift($wc_meeting_dates));
$meeting_dates = array_fill_keys($wc_meeting_dates, array());

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