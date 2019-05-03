$(document).ready(function($) {
	$("table.container").on("click", "tr.table-tr", function() {
		window.location = $(this).data("url");
	});	

	$("table.container").on("click", "td.table-td", function() {
		window.location = $(this).data("url");
	});

	$('.confirm-delete').click(function() {
		return confirm('Are you sure you would like to ' + $(this).val().toLowerCase() + ' ' +  $(this).data('name') + '?');
	});

	$('[id^=student_list_]').DataTable( {
		'lengthChange': false,
		'pageLength': 25,
		'columns': [
			{ 'orderable': true, 'searchable': false },
			{ 'orderable': true, 'searchable': true },
			{ 'orderable': true, 'searchable': false },
			{ 'orderable': true, 'searchable': false },
			{ 'orderable': true, 'searchable': false },
			{ 'orderable': true, 'searchable': false },
			{ 'orderable': true, 'searchable': false }
		]
	});
	$('.dataTables_length').addClass('bs-select');

});

window.addEventListener("load", function() {
	
	// store tabs variables
	var tabs = document.querySelectorAll("ul.navigation-tabs > li");

	for (i = 0; i < tabs.length; i++) {
		tabs[i].addEventListener("click", switchTab);
	}

	function switchTab(event) {
		event.preventDefault();

		document.querySelector("ul.navigation-tabs li.active").classList.remove("active");
		document.querySelector(".tab-pane.active").classList.remove("active");

		var clickedTab = event.currentTarget;
		var anchor = event.target;
		var activePaneID = anchor.getAttribute("href");

		clickedTab.classList.add("active");
		document.querySelector(activePaneID).classList.add("active");

	}
});
