$(document).ready(function() {
	var users = new Bloodhound({
		datumTokenizer:  Bloodhound.tokenizers.obj.whitespace('Animal_Name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		remote: {
		    url: 'animals.php?query=%QUERY',
		    wildcard: '%QUERY'
		}	
	});
	users.initialize();
	$('#users').typeahead({
		hint: true,
		highlight: true,
		minLength: 2
	}, {
		name: 'users',
		displayKey: 'Animal_Name',
		source: users.ttAdapter()
	});
});