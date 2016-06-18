<?php
define('PUBLIC_PAGE', true);
include('common.php');

$smarty->assign('title', 'Weston Water :: Archives');
$smarty->assign('page_name_location', 'images/titles/archives.png');
$smarty->assign('page_name_alt', 'Archives');

$smarty->assign('title', 'Archive of Meeting Minutes');
$smarty->assign('annual_display', 'Annual Meeting');

$minutes_archive = scandir('minutes_archive');

class ArchiveSection
{
	public $year;
	public $minutes;
	public $annual;
}

$archive_year = NULL;
$sections = array();

foreach($minutes_archive as $date)
{
	// Skip the file if it's not a PDF
	if(!preg_match('/.pdf$/', $date)) continue;
	
	// Split the filename into year/month/day
	$date_name = substr($date, 0, strpos($date, '.'));
	$dateparts = explode('-', $date_name);
	$year = $dateparts[0];
	$month = $dateparts[1];
	$day = $dateparts[2];
	$annual = FALSE;
	if(sizeof($dateparts) == 4)
		$annual = TRUE;
	
	// If the year isn't the same as the previous file, start a new section for the archive
	if($archive_year === NULL || $archive_year->year != $year)
	{
		if($archive_year !== NULL) $sections[] = $archive_year;
		
		$archive_year = new ArchiveSection();
		$archive_year->year = $year;
		
	}
	// Add the minutes to the list
	$archive_year->minutes[strtotime($year.'/'.$month.'/'.$day)] = $year.'-'.$month.'-'.$day.($annual ? '-annual' : '').'.pdf';
	$archive_year->annual[strtotime($year.'/'.$month.'/'.$day)] = $annual;
}
$sections[] = $archive_year;

$smarty->assign('minutes', $sections);

// Display page
$smarty->display('archives.tpl');
?>