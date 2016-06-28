<!DOCTYPE html>
<html><head>
<title>WWSC Website Management</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head><body>
<h1>WWSC Website Management</h1>
<p><a href="/wiki/Office Procedures">Procedures Manual wiki</a></p>
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
				<div class="row">
					<div class="cell">
						<select name="month[]">
							<option value="Jan">January</option>
							<option value="Feb">February</option>
							<option value="Mar">March</option>
							<option value="Apr">April</option>
							<option value="May">May</option>
							<option value="Jun">June</option>
							<option value="Jul">July</option>
							<option value="Aug">August</option>
							<option value="Sep">September</option>
							<option value="Oct">October</option>
							<option value="Nov">November</option>
							<option value="Dec">December</option>
						</select>
					</div>
					<div class="cell">
						<select name="day[]">
							<option value="31">31</option>
							<option value="30">30</option>
							<option value="29">29</option>
							<option value="28">28</option>
							<option value="27">27</option>
							<option value="26">26</option>
							<option value="25">25</option>
							<option value="24">24</option>
							<option value="23">23</option>
							<option value="22">22</option>
							<option value="21">21</option>
							<option value="20">20</option>
							<option value="19">19</option>
							<option value="18">18</option>
							<option value="17">17</option>
							<option value="16">16</option>
							<option value="15">15</option>
							<option value="14">14</option>
							<option value="13">13</option>
							<option value="12">12</option>
							<option value="11">11</option>
							<option value="10">10</option>
							<option value="9">9</option>
							<option value="8">8</option>
							<option value="7">7</option>
							<option value="6">6</option>
							<option value="5">5</option>
							<option value="4">4</option>
							<option value="3">3</option>
							<option value="2">2</option>
							<option value="1">1</option>
						</select>
					</div>
					<div class="cell">
						<button class="remove">&times;</button>
					</div>
				</div>
			</div>
		</div>
		<label>
			Year:
			<input type="number" id="year" name="year">
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
				<div class="row">
					<div class="cell">President</div>
					<div class="cell">
						<select name="term[president][month]">
							<option value="Jan">January</option>
							<option value="Feb">February</option>
							<option value="Mar">March</option>
							<option value="Apr">April</option>
							<option value="May">May</option>
							<option value="Jun">June</option>
							<option value="Jul">July</option>
							<option value="Aug">August</option>
							<option value="Sep">September</option>
							<option value="Oct">October</option>
							<option value="Nov">November</option>
							<option value="Dec">December</option>
						</select>
						<input type="number" name="term[president][year]" min="2000">
					</div>
					<div class="cell"><input type="text" name="president_name"></div>
				</div>
				<div class="row">
					<div class="cell">Vice President</div>
					<div class="cell">
						<select name="term[vice_president][month]">
							<option value="Jan">January</option>
							<option value="Feb">February</option>
							<option value="Mar">March</option>
							<option value="Apr">April</option>
							<option value="May">May</option>
							<option value="Jun">June</option>
							<option value="Jul">July</option>
							<option value="Aug">August</option>
							<option value="Sep">September</option>
							<option value="Oct">October</option>
							<option value="Nov">November</option>
							<option value="Dec">December</option>
						</select>
						<input type="number" name="term[vice_president][year]" min="2000">
					</div>
					<div class="cell"><input type="text" name="vice_president_name"></div>
				</div>
				<div class="row">
					<div class="cell">Treasurer/Secretary</div>
					<div class="cell">
						<select name="term[treasurer/secretary][month]">
							<option value="Jan">January</option>
							<option value="Feb">February</option>
							<option value="Mar">March</option>
							<option value="Apr">April</option>
							<option value="May">May</option>
							<option value="Jun">June</option>
							<option value="Jul">July</option>
							<option value="Aug">August</option>
							<option value="Sep">September</option>
							<option value="Oct">October</option>
							<option value="Nov">November</option>
							<option value="Dec">December</option>
						</select>
						<input type="number" name="term[treasurer/secretary][year]" min="2000">
					</div>
					<div class="cell"><input type="text" name="treasurer_secretary_name"></div>
				</div>
				<div class="row">
					<div class="cell">Board Member</div>
					<div class="cell">
						<select name="term[member4][month]">
							<option value="Jan">January</option>
							<option value="Feb">February</option>
							<option value="Mar">March</option>
							<option value="Apr">April</option>
							<option value="May">May</option>
							<option value="Jun">June</option>
							<option value="Jul">July</option>
							<option value="Aug">August</option>
							<option value="Sep">September</option>
							<option value="Oct">October</option>
							<option value="Nov">November</option>
							<option value="Dec">December</option>
						</select>
						<input type="number" name="term[member4][year]" min="2000">
					</div>
					<div class="cell"><input type="text" name="member4_name"></div>
				</div>
				<div class="row">
					<div class="cell">Board Member</div>
					<div class="cell">
						<select name="term[member5][month]">
							<option value="Jan">January</option>
							<option value="Feb">February</option>
							<option value="Mar">March</option>
							<option value="Apr">April</option>
							<option value="May">May</option>
							<option value="Jun">June</option>
							<option value="Jul">July</option>
							<option value="Aug">August</option>
							<option value="Sep">September</option>
							<option value="Oct">October</option>
							<option value="Nov">November</option>
							<option value="Dec">December</option>
						</select>
						<input type="number" name="term[member5][year]" min="2000">
					</div>
					<div class="cell"><input type="text" name="member5_name"></div>
				</div>
			</div>
		</div>
		<button id="save_board">Save board members</button>
	</form>
</fieldset>
<fieldset>
	<legend>Rates</legend>
</fieldset>
<fieldset>
	<legend>Links</legend>
</fieldset>
<p><a href="/info.php">phpinfo()</a></p>
</body>
</html>
<?php
