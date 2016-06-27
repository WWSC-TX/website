<?php
if (!isset($_FILES['file'], $_GET['u'])) {
	header('HTTP/1.0 400 Bad request');
	die('You are not allowed to access this file.');
}

$file = $_FILES['file']['tmp_name'];
switch ($_GET['u']) {
	case 'agenda':
		if (!preg_match('/[0-9]{4}-[01]?[0-9]-[0-3]?[0-9]\.pdf/', $_FILES['file']['name'])) {
			header('HTTP/1.0 400 Bad request');
			die('Agendas must be in the form YYYY-MM-DD.pdf');
		}
		$remote = 'agendas/';
		break;
	case 'minutes':
		if (!preg_match('/[0-9]{4}-[01]?[0-9]-[0-3]?[0-9](-annual)?\.pdf/', $_FILES['file']['name'])) {
			header('HTTP/1.0 400 Bad request');
			die('Minutes must be in the form YYY-MM-DD.pdf or YYYY-MM-DD-annual.pdf');
		}
		$remote = 'minutes_archive/';
		break;
	case 'other':
		$remote = 'downloads/';
		break;
	default:
		header('HTTP/1.0 400 Bad request');
		die('You are not allowed to access this file.');
}
$remote .= $_FILES['file']['name'];

$conn = ftp_connect('westonwater.com');
$login = ftp_login($conn, 'west7808', 'Water_b0ard');
if (ftp_put($conn, $remote, $file, FTP_BINARY)) {
	echo 'success!';
} else {
	header('HTTP/1.0 500 Internal server error');
	die("There was a problem uploading to $remote");
}
ftp_close($conn);