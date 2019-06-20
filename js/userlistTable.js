	$(document).ready(function() {
		$('#ListofUsers').DataTable({
			"aoColumnDefs": [
	  { 'bSortable': false, 'aTargets': [ 4,5 ] }
   ]
		});
	} );
