$(document).ready(function($) {
	$("table.container").on("click", "tr.table-tr", function() {
		window.location = $(this).data("url");
	});	

	$('.rubric-tile.criteria').click( function() {
		var row = $(this).closest('.row');
		var criteria_name = row.data('criteria-name');
		var semester = $('#semester').val();

		row.children('.rubric-tile.criteria').each(function() {
			$(this).removeClass(semester);
		});

		$('#' + criteria_name).val($(this).data('value'));

		$(this).addClass(semester);
	});

	$('.dual-option-tile').click( function() {
		var row = $(this).closest('.row');
		var criteria_name = row.data('criteria-name');
		var semester = $('#semester').val();

		row.children('.dual-option-tile').each(function() {
			$(this).removeClass(semester);
		});

		$('#' + criteria_name).val($(this).data('value'));

		$(this).addClass(semester);
	});

	$('.semester-option-tile').click( function() {
		var row = $(this).closest('.row');
		var checked = $(this).data('checked');
		var value = $(this).data('value');
		var criteria_name = row.data('criteria-name');
		var semester = $('#semester').val();

		if ( (value === 1 && semester === 'spring') || (value === 2 && semester === 'fall') ) {
			return;
		}

		if (checked == null) {
			checked =	0;
		}

		checked++;
		checked = (checked > 1) ? 0 : checked;	

		switch(checked) {
			case 0:
				$(this).removeClass(semester);	
				break;
			case 1:
				$(this).addClass(semester);
				break;
		}

		$('#' + criteria_name).val(checked);	

		$(this).data('checked', checked);
	});

	$('.tri-option-tile').click( function() {
		var row = $(this).closest('.row');
		var criteria_name = row.data('criteria-name');
		var semester = $('#semester').val();

		row.children('.tri-option-tile').each(function() {
			$(this).removeClass(semester);
		});

		$('#' + criteria_name).val($(this).data('value'));	

		$(this).addClass(semester);
	});

	$('.rubric-selection').click( function() {
		var semester = $('#semester').val();
		var value = $(this).data('value');
		var type = $(this).data('type');
		var selection = $(this).html().toLowerCase();
 	
		if (value == null) {
			value =	0;
		}

		value++;

		value = (value > 1) ? 0 : value;	

		switch(value) {
			case 0:
				$(this).removeClass(semester);	
				break;
			case 1:
				$(this).addClass(semester);
				break;
		}

		console.log('#' + type + '_' + selection);

		$('#' + type + '_' + selection).val(value);

		console.log($('#' + type + '_' + selection).val());

		$(this).data('value', value);
	});
	
	$('#eval-submit').click( function() {
		var isFilled = $("input.required").filter(function () {
			return $.trim($(this).val()).length == 0
		}).length == 0;
		if (!isFilled) {
			alert('All fields must be filled out to submit. You may save your evaluation and return to it later.');
			return false;
		}
		return true;
	});
	
	$('.go-back').click( function() {
		return confirm('Are you sure you wish to leave this page? Any changes made will be lost.');
	});
});