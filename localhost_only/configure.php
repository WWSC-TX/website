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
		if (!isset($_POST['term'], $_POST['term']['president'], $_POST['term']['president']['month'],
			$_POST['term']['president']['year'], $_POST['term']['president']['name'],
			$_POST['term']['vice president'], $_POST['term']['vice president']['month'],
			$_POST['term']['vice president']['year'], $_POST['term']['vice president']['name'],
			$_POST['term']['secretary-treasurer'], $_POST['term']['secretary-treasurer']['month'],
			$_POST['term']['secretary-treasurer']['year'],
			$_POST['term']['secretary-treasurer']['name'], $_POST['term']['member4'],
			$_POST['term']['member4']['month'], $_POST['term']['member4']['year'],
			$_POST['term']['member4']['name'], $_POST['term']['member5'],
			$_POST['term']['member5']['month'], $_POST['term']['member5']['year'],
			$_POST['term']['member5']['name'])) {
				header('HTTP/1.0 400 Bad request');
				die('You are not allowed to access this file.');
		}
		$term = $_POST['term'];
		$text = <<<BOARD
{$term['president']['month']} {$term['president']['year']} {$term['president']['name']}
{$term['vice president']['month']} {$term['vice president']['year']} {$term['vice president']['name']}
{$term['secretary-treasurer']['month']} {$term['secretary-treasurer']['year']} {$term['secretary-treasurer']['name']}
{$term['member4']['month']} {$term['member4']['year']} {$term['member4']['name']}
{$term['member5']['month']} {$term['member5']['year']} {$term['member5']['name']}
BOARD;
		fwrite($tmp, $text);
		$remote = 'website_config/board_members';
		break;
	case 'save_rates':
		if (!isset($_POST['base'], $_POST['gallons_0'], $_POST['gallons_1'], $_POST['gallons_2'],
			$_POST['gallons_3'], $_POST['gallons_4'], $_POST['rate_0'], $_POST['rate_1'],
			$_POST['rate_2'], $_POST['rate_3'], $_POST['rate_4'])) {
			header('HTTP/1.0 400 Bad request');
			die('You are not allowed to access this file.');
		}
		$base = $_POST['base'];
		foreach ($_POST as $k=>$v) {
			if (strpos($k, 'gallons_') == 0 || strpos($k, 'rate_') == 0) {
				$$k = $v;
			}
		}
		$text = <<<RATES
$base
$rate_0 $gallons_0
$rate_1 $gallons_1
$rate_2 $gallons_2
$rate_3 $gallons_3
$rate_4 $gallons_4
RATES;
		fwrite($tmp, $text);
		$remote = 'website_config/rates';
		break;
	case 'save_links':
		if (!isset($_POST['news'], $_POST['index'], $_POST['index']['file'],
			$_POST['index']['file']['text'], $_POST['index']['file']['file'], $_POST['index']['link'],
			$_POST['index']['link']['text'], $_POST['index']['link']['link'],
			$_POST['forms'], $_POST['forms']['text'], $_POST['forms']['file'],
			$_POST['policies'], $_POST['policies']['text'], $_POST['policies']['file'],
			$_POST['rates'], $_POST['rates']['text'], $_POST['rates']['file'],
			$_POST['about'], $_POST['about']['text'], $_POST['about']['file'],
			$_POST['links'], $_POST['links']['text'], $_POST['links']['link'])) {
			header('HTTP/1.0 400 Bad request');
			die('You are not allowed to access this file.');
		}
		$text = $_POST['news']."\n";
		$groups = array($_POST['index']['file'], $_POST['index']['link'], $_POST['forms'],
			$_POST['policies'], $_POST['rates'], $_POST['about'], $_POST['links']);
		foreach ($groups as $k => $g) {
			$col2 = isset($g['file']) ? $g['file'] : $g['link'];
			foreach ($g['text'] as $i => $t) {
				$text .= $t.'|'.$col2[$i]."\n";
			}
			if ($k !== 0 && $k !== 6) $text .= "--\n";
		}
		fwrite($tmp, trim($text));
		$remote = 'website_config/links';
		break;
	case 'save_sidebar':
		if (!isset($_POST)) {
			header('HTTP/1.0 400 Bad request');
			die('You are not allowed to access this file.');
		}
		$text = '';
		fwrite($tmp, $text);
		$remote = 'website_config/sidebar';
		break;
	default:
		header('HTTP/1.0 400 Bad request');
		die('You are not allowed to access this file.');
}

$conn = ftp_connect('westonwater.com');
$login = ftp_login($conn, 'west7808', 'Water_b0ard');
$file = stream_get_meta_data($tmp)['uri'];

if (ftp_put($conn, $remote, $file, FTP_ASCII)) {
	echo 'success!';
} else {
	header('HTTP/1.0 500 Internal server error');
	die("There was a problem uploading to $remote");
}
ftp_close($conn);