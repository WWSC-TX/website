$(function() {
	'use strict';
	
	$('#upload_agenda,#upload_minutes,#upload_other').click(function(event) {
		event.preventDefault();
		if ($('#upload_file :file').val().length === 0) return;
		$.ajax({
			type: 'POST',
			url: 'upload.php?u=' + this.id.substring(7),
			data: new FormData($('#upload_file')[0]),
			processData: false,
			contentType: false,
			success: function(data){
				console.log(data);
				alert('Upload successful!');
				$('#upload_file')[0].reset();
			},
			error: function(xhr, status, error) {
				console.log(xhr);
				alert('ERROR! ' + xhr.status + ' ' + error);
			}
		});
	});
	
	$('#add_row').click(function(event) {
		event.preventDefault();
		let row = $('#meeting_dates .table .body .row:last-child').clone(true);
		$('#meeting_dates .table .body').append(row);
	});
	$('.remove').click(function(event) {
		event.preventDefault();
		$(this).parents('.row').remove();
	});
	
	$.get('proxy.php', {
		u: 'http://westonwater.com/website_config/meeting_dates'
	}, function(data) {
		var lines = data.split('\n'),
			year = parseInt(lines.shift());
		$.each(lines, function(idx, elem) {
			lines[idx] = elem.split(' ')
		});
		do {
			let row = $('#meeting_dates .table .body .row:last-child'),
				date = lines.shift();
			$(row.find('select')[0]).val(date[0]);
			$(row.find('select')[1]).val(date[1]);
			if (lines.length > 0) {
				row = row.clone(true);
				$('#meeting_dates .table .body').append(row);
			}
		} while (lines.length > 0);
		$('#year').val(year);
	});
	$('#save_meetings').click(function(event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'configure.php?u=' + this.id,
			data: new FormData($('#meeting_dates')[0]),
			processData: false,
			contentType: false,
			success: function(data){
				console.log(data);
				alert('Meeting dates saved!');
			},
			error: function(xhr, status, error) {
				console.log(xhr);
				alert('ERROR! ' + xhr.status + ' ' + error);
			}
		});
	});
	
	$('#save_board').click(function(event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'configure.php?u=' + this.id,
			data: new FormData($('#board')[0]),
			processData: false,
			contentType: false,
			success: function(data) {
				console.log(data);
				alert('Board members saved!');
			},
			error: function(xhr, status, error) {
				console.log(xhr);
				alert('ERROR! ' + xhr.status + ' ' + error);
			}
		});
	});
});