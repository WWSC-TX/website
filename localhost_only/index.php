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

function getConfigFile($filename) {
	$uri = "http://westonwater.com/website_config/$filename";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $uri);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$text = curl_exec($ch);
	return explode("\n", $text);
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
?>-->
<!DOCTYPE html>
<html><head>
<title>WWSC Website Management</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
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
	<form id="links">
		<button id="save_links">Save links</button>
	</form>
</fieldset>
<p><a href="/info.php">phpinfo()</a></p>
</body>
</html>