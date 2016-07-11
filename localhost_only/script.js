$(function() {
	'use strict';
	
	$('a[rel=external]').attr('target', '_blank');
	
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
	
	$('#save_meetings,#save_board,#save_rates,#save_links').click(function(event) {
		var self = this;
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'configure.php?u=' + this.id,
			data: new FormData($(this).parent('form')[0]),
			processData: false,
			contentType: false,
			success: function(data) {
				console.log(data);
				alert(self.id.substring(5, 6).toUpperCase() + self.id.substring(6) + ' saved!');
			},
			error: function(xhr, status, error) {
				console.log(xhr);
				alert('ERROR! ' + xhr.status + ' ' + error);
			}
		});
	});
});