<!--<?php 
function monthSelect($name, $selected = null, $asc = true) {
?>
	<select name="<?php echo $name; ?>">
<?php for ($i = $asc ? 1 : 12; $asc ? $i <= 12 : $i > 0; $i += $asc ? 1 : -1) {
		$month = mktime(0, 0, 0, $i); ?>
		<option value="<?php echo date('M', $month); ?>"<?php 
			if (date('M', $month) == $selected) echo ' selected';
		?>><?php echo date('F', $month); ?></option>
<?php }?>
	</select>
<?php 
}

function daySelect($name, $selected = null, $asc = true) {
?>
	<select name="<?php echo $name; ?>">
<?php for ($i = $asc ? 1 : 31; $asc ? $i <= 31 : $i > 0; $i += $asc ? 1 : -1) { ?>
		<option value="<?php echo $i; ?>"<?php 
			if ($i == $selected) echo ' selected';
		?>><?php echo $i; ?></option>
<?php } ?>
	</select>
<?php 
}

$pdfs = getFilesList();
function fileSelect($name, $selected = null) {
	global $pdfs;
?>
	<select name="<?php echo $name; ?>">
<?php if ($selected === null) { ?>		<option value="" disabled selected>(Select PDF)</option><?php } ?>
<?php foreach ($pdfs as $f) { ?>
		<option value="<?php echo $f; ?>"<?php if ($selected === $f) echo ' selected'; ?>><?php echo $f; ?></option>
<?php } ?>
	</select>
<?php
}

function getConfigFile($filename) {
	$uri = "http://westonwater.com/website_config/$filename";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $uri);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$text = curl_exec($ch);
	return explode("\n", $text);
}

function getFilesList() {
	$ftp = ftp_connect('westonwater.com');
	$login = ftp_login($ftp, 'west7808', 'Water_b0ard');
	$result = ftp_nlist($ftp, 'downloads');
	array_splice($result, 0, 3);
	$readme_idx = array_search('readme.txt', $result);
	array_splice($result, $readme_idx, 1);
	return $result;
}

$meeting_dates = getConfigFile('meeting_dates');
$meeting_year = array_shift($meeting_dates);

$board = getConfigFile('board_members');
$board_members = array(
	'President' => array_shift($board),
	'Vice President' => array_shift($board),
	'Secretary-Treasurer' => array_shift($board),
	'Board Member' => $board
);

$rates = getConfigFile('rates');
$base_rate = array_shift($rates);

$links_config = getConfigFile('links');
$links = array('index' => array());
$ks = array('index', 'forms', 'policies', 'rates', 'about', 'links');
$c = 0;
foreach ($links_config as $line) {
	if (trim($line) == '--') {
		$c++;
		$links[$ks[$c]] = array();
		continue;
	}
	$line = explode('|', $line);
	if (count($line) === 1) {
		$links[$ks[$c]]['_'] = trim($line[0]);
	} else {
		$links[$ks[$c]][$line[0]] = trim($line[1]);
	}
}

$index_links = array('news' => '', 'files' => array(), 'links' => array());
foreach ($links['index'] as $k => $v) {
	if ($k == '_') $index_links['news'] = $v;
	else if (strpos($v, 'http') === 0) $index_links['links'][$k] = $v;
	else $index_links['files'][$k] = $v;
}
$links['index'] = $index_links;

$sidebar_config = getConfigFile('sidebar');
$sidebar = array();
$last = '';
foreach ($sidebar_config as $ln) {
	if ($ln[0] !== ' ') {
		$sidebar[$ln] = array();
		$last = $ln;
	} else {
		$sidebar[$last][] = trim($ln);
	}
}
?>-->
<!DOCTYPE html>
<html><head>
<title>WWSC Website Management</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="autosize.js"></script>
<script type="text/javascript" src="script.js"></script>
</head><body>
<h1>WWSC Website Management</h1>
<p><a href="/wiki/Office Duties">Procedures Manual wiki</a></p>
<p><a href="http://westonwater.com" rel="external">http://westonwater.com</a></p>
<fieldset>
	<legend>PDF File Uploads</legend>
	<form id="upload_file" enctype="multipart/form-data">
		<p>Note: Agendas should be in the form YYYY-MM-DD.pdf and minutes should be in the form YYYY-MM-DD.pdf or YYYY-MM-DD-annual.pdf.</p>
		<label>File: <input type="file" name="file" accept="application/pdf"></label>
		<div class="vspace">
			<button id="upload_agenda">Upload <strong>Agenda</strong></button>
			<button id="upload_minutes">Upload <strong>Minutes</strong></button>
			<button id="upload_other">Upload <strong>Other</strong></button>
		</div>
	</form>
</fieldset>
<fieldset>
	<legend>Set Meeting Dates</legend>
	<form id="meeting_dates">
		<div class="table">
			<div class="header">
				<div class="row">
					<div class="cell">Month</div>
					<div class="cell">Day</div>
				</div>
			</div>
			<div class="body">
<?php foreach ($meeting_dates as $i => $ln) {
		$ln = explode(' ', $ln); ?>
				<div class="row">
					<div class="cell">
<?php monthSelect('month[]', $ln[0]); ?>
					</div>
					<div class="cell">
<?php daySelect('day[]', $ln[1], false); ?>
					</div>
					<div class="cell">
						<button class="remove">&times;</button>
					</div>
				</div>
<?php } ?>
			</div>
		</div>
		<label>
			Year:
			<input type="number" id="year" name="year" value="<?php echo $meeting_year; ?>">
		</label>
		<button id="add_row">Add meeting</button>
		<button id="save_meetings">Save dates</button>
	</form>
</fieldset>
<fieldset>
	<legend>Update Board Members</legend>
	<form id="board">
		<div class="table">
			<div class="header">
				<div class="row">
					<div class="cell">Title</div>
					<div class="cell">Term Expires</div>
					<div class="cell">Name</div>
				</div>
			</div>
			<div class="body">
<?php foreach ($board_members as $title => $ln) {
		if (!is_array($ln)) {
			$ln = array($ln);
		}
		
		$lc_title = strtolower($title);
		foreach ($ln as $i => $m) {
			$m = explode(' ', $m);
			$month = array_shift($m);
			$year = array_shift($m);
			$name = implode(' ', $m);
			$member = count($ln) > 1 ? 'member'.($i + 4) : $lc_title;
?>
				<div class="row">
					<div class="cell"><?php echo $title; ?></div>
					<div class="cell">
<?php monthSelect("term[$member][month]", $month); ?>
						<input type="number" name="term[<?php echo $member; ?>][year]" min="2000" value="<?php echo $year; ?>">
					</div>
					<div class="cell"><input type="text" name="term[<?php echo $member; ?>][name]" value="<?php echo $name; ?>"></div>
				</div>
<?php 	}
	}?>
			</div>
		</div>
		<button id="save_board">Save board members</button>
	</form>
</fieldset>
<fieldset>
	<legend>Rates</legend>
	<form id="rates">
		<div class="table">
			<div class="header">
				<div class="row" style="background-color:#ccc">
					<div class="cell" style="text-align:right;padding:3px"><label for="base_rate">Base rate:</label></div>
					<div class="Cell" style="padding:3px"><input type="number" name="base" id="base_rate" step="0.01" value="<?php echo $base_rate; ?>"></div>
				</div>
				<div class="row">
					<div class="cell">Gallons</div>
					<div class="cell" style="padding-left:5px">Rate (per 1,000 gallons)</div>
				</div>
			</div>
			<div class="body">
<?php foreach ($rates as $i=>$r) {
			$rateparts = explode(' ', $r);
			$r = array_shift($rateparts);
			$g = implode(' ', $rateparts); ?>
				<div class="row">
					<div class="cell"><input style="text-align:right" type="text" name="gallons_<?php echo $i; ?>" value="<?php echo $g; ?>"></div>
					<div class="cell" style="text-align:center"><input type="number" name="rate_<?php echo $i; ?>" step="0.01" value="<?php echo $r; ?>"></div>
				</div>
<?php } ?>
			</div>
		</div>
		<button id="save_rates">Save rates</button>
	</form>
</fieldset>
<fieldset>
	<legend>Links</legend>
	Note: If you upload a file (see PDF File Uploads at the top of this page), you must refresh the page
	(press <kbd>[f5]</kbd>) in order to have that file available in the file select dropdowns below.
	<form id="links">
		<fieldset>
			<legend>Front page</legend>
			<label for="news" style="display:block">News</label>
			<textarea name="news"><?php echo $links['index']['news']; ?></textarea>
			<fieldset>
				<legend>Files</legend>
				<div class="table">
					<div class="header">
						<div class="row">
							<div class="cell">Text</div>
							<div class="cell">File</div>
						</div>
					</div>
					<div class="body" id="index-files">
<?php foreach ($links['index']['files'] as $name => $file) { ?>
						<div class="row">
							<div class="cell"><input type="text" name="index[file][text][]" value="<?php echo $name; ?>"></div>
							<div class="cell"><?php fileSelect('index[file][file][]', $file); ?></div>
							<div class="cell"><button class="remove">&times;</button></div>
						</div>
<?php } ?>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend>External links</legend>
				<div class="table">
					<div class="header">
						<div class="row">
							<div class="cell">Text</div>
							<div class="cell">Link</div>
						</div>
					</div>
					<div class="body" id="index-links">
<?php foreach ($links['index']['links'] as $name => $url) { ?>
						<div class="row">
							<div class="cell"><input type="text" name="index[link][text][]" value="<?php echo $name; ?>"></div>
							<div class="cell"><input type="text" name="index[link][link][]" value="<?php echo $url; ?>"></div>
							<div class="cell"><button class="remove">&times;</button></div>
						</div>
<?php } ?>
					</div>
				</div>
			</fieldset>
			<button class="add_file" data-for="index-files">Add file</button>
			<button class="add_link" data-for="index-links">Add link</button>
		</fieldset>
		<fieldset>
			<legend>Forms</legend>
			<div class="table">
				<div class="header">
					<div class="row">
						<div class="cell">Text</div>
						<div class="cell">File</div>
					</div>
				</div>
				<div class="body" id="forms-files">
<?php foreach ($links['forms'] as $name => $file) { ?>
					<div class="row">
						<div class="cell"><input type="text" name="forms[text][]" value="<?php echo $name; ?>"></div>
						<div class="cell"><?php fileSelect('forms[file][]', $file); ?></div>
						<div class="cell"><button class="remove">&times;</button></div>
					</div>
<?php } ?>
				</div>
			</div>
			<button class="add_file" data-for="forms-files">Add file</button>
		</fieldset>
		<fieldset>
			<legend>Policies</legend>
			<div class="table">
				<div class="header">
					<div class="row">
						<div class="cell">Text</div>
						<div class="cell">File</div>
					</div>
				</div>
				<div class="body" id="policies-files">
<?php foreach ($links['policies'] as $name => $file) { ?>
					<div class="row">
						<div class="cell"><input type="text" name="policies[text][]" value="<?php echo $name; ?>"></div>
						<div class="cell"><?php fileSelect('policies[file][]', $file); ?></div>
						<div class="cell"><button class="remove">&times;</button></div>
					</div>
<?php } ?>
				</div>
			</div>
			<button class="add_file" data-for="policies-files">Add file</button>
		</fieldset>
		<fieldset>
			<legend>Rates</legend>
			<div class="table">
				<div class="header">
					<div class="row">
						<div class="cell">Text</div>
						<div class="cell">File</div>
					</div>
				</div>
				<div class="body" id="rates-files">
<?php foreach ($links['rates'] as $name => $file) { ?>
					<div class="row">
						<div class="cell"><input type="text" name="rates[text][]" value="<?php echo $name; ?>"></div>
						<div class="cell"><?php fileSelect('rates[file][]', $file); ?></div>
						<div class="cell"><button class="remove">&times;</button></div>
					</div>
<?php } ?>
				</div>
			</div>
			<button class="add_file" data-for="rates-files">Add file</button>
		</fieldset>
		<fieldset>
			<legend>About us</legend>
			<div class="table">
				<div class="header">
					<div class="row">
						<div class="cell">Text</div>
						<div class="cell">File</div>
					</div>
				</div>
				<div class="body" id="about-files">
<?php foreach ($links['about'] as $name => $file) { ?>
					<div class="row">
						<div class="cell"><input type="text" name="about[text][]" value="<?php echo $name; ?>"></div>
						<div class="cell"><?php fileSelect('about[file][]', $file); ?></div>
						<div class="cell"><button class="remove">&times;</button></div>
					</div>
<?php } ?>
				</div>
			</div>
			<button class="add_file" data-for="about-files">Add file</button>
		</fieldset>
		<fieldset>
			<legend>Links</legend>
			<div class="table">
				<div class="header">
					<div class="row">
						<div class="cell">Text</div>
						<div class="cell">Link</div>
					</div>
				</div>
				<div class="body" id="links-links">
<?php foreach ($links['links'] as $name => $url) { ?>
					<div class="row">
						<div class="cell"><input type="text" name="links[text][]" value="<?php echo $name; ?>"></div>
						<div class="cell"><input type="text" name="links[link][]" value="<?php echo $url; ?>"></div>
						<div class="cell"><button class="remove">&times;</button></div>
					</div>
<?php } ?>
				</div>
			</div>
			<button class="add_link" data-for="links-links">Add link</button>
		</fieldset>
		<button id="save_links"><strong>Save links</strong></button>
	</form>
</fieldset>
<fieldset>
	<legend>Left Sidebar</legend>
	Up to one line in each group may be an email address prefixed with "email:". This email address will
	be listed below all other lines in the group on the website sidebar, and will be linked with a
	mailto: link. If you include an email without the "email:" prefix, or the email is not the only thing
	on the line, it will be treated as normal text.
	<form id="sidebar">
<?php foreach ($sidebar as $group => $data) { ?>
		<fieldset>
			<legend><input type="text" name="group[]" value="<?php echo $group; ?>"><button class="remove">&times;</button></legend>
			<textarea name="data[]"><?php echo implode($data, "\n"); ?></textarea>
		</fieldset>
<?php } ?>
		<button id="add-sidebar-group">Add group</button>
		<div class="vspace">
			<button id="save_sidebar"><strong>Save sidebar</strong></button>
		</div>
	</form>
</fieldset>
<p><a href="/info.php">phpinfo()</a></p>
</body>
</html>