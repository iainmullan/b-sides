
var BS = BS || {}

$(document).ready(function() {

	$('table.playlist input').on('change', function(e) {
//		console.log(e.currentTarget);

		$(e.currentTarget).parents('tr').toggleClass('unchecked');

	});

});
