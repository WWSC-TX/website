<?php
if (!isset($_GET['u'])) {
	header('HTTP/1.0 400 Bad request');
	die('You are not allowed to access this file.');
}

$tmp = tmpfile();
switch ($_GET['u']) {
	case 'save_meetings':
		if (!isset($_POST['month'], $_POST['day'])
			|| count($_POST['month']) != count($_POST['day'])) {
				header('HTTP/1.0 400 Bad request');
				die('You are not allowed to access this file.');
		}
		$dates = array();
		for ($i = 0; $i < count($_POST['month']); $i++) {
			$dates[] = $_POST['month'][$i].' '.$_POST['day'][$i];
		}
		fwrite($tmp, intval($_POST['year'])."\n");
		fwrite($tmp, implode("\n", $dates));
		$remote = 'website_config/meeting_dates';
		break;
	case 'save_board':
		if (!isset($_POST['term'], $_POST['president_name'], $_POST['vice_president_name'],
			$_POST['treasurer_secretary_name'], $_POST['member4_name'], $_POST['member5_name'],
			$_POST['term']['president'], $_POST['term']['president']['month'],
			$_POST['term']['president']['year'], $_POST['term']['vice_president'],
			$_POST['term']['vice_president']['month'], $_POST['term']['vice_president']['year'],
			$_POST['term']['treasurer/secretary'],
			$_POST['term']['treasurer/secretary']['month'],
			$_POST['term']['treasurer/secretary']['year'], $_POST['term']['member4'],
			$_POST['term']['member4']['month'], $_POST['term']['member4']['year'],
			$_POST['term']['member5'], $_POST['term']['member5']['month'],
			$_POST['term']['member5']['year'])) {
				header('HTTP/1.0 400 Bad request');
				die('You are not allowed to access this file.');
		}
		$term = $_POST['term'];print_r($term);
		$text = <<<BOARD
{$term['president']['month']} {$term['president']['year']} {$_POST['president_name']}
{$term['vice_president']['month']} {$term['vice_president']['year']} {$_POST['vice_president_name']}
{$term['treasurer/secretary']['month']} {$term['treasurer/secretary']['year']} {$_POST['treasurer_secretary_name']}
{$term['member4']['month']} {$term['member4']['year']} {$_POST['member4_name']}
{$term['member5']['month']} {$term['member5']['year']} {$_POST['member5_name']}
BOARD;
		fwrite($tmp, $text);
		$remote = 'website_config/board_members';
		break;
	default:
		header('HTTP/1.0 400 Bad request');
		die('You are not allowed to access this file.');
}

$conn = ftp_connect('westonwater.com');
$login = ftp_login($conn, 'west7808', 'Water_b0ard');
$file = stream_get_meta_data($tmp)['uri'];
print_r($path);
if (ftp_put($conn, $remote, $file, FTP_ASCII)) {
	echo 'success!';
} else {
	header('HTTP/1.0 500 Internal server error');
	die("There was a problem uploading to $remote");
}
ftp_close($conn);