// Usage

$.fn.dataTable.ext.search.push(
	function(settings, data, dataIndex){

		var interviewed = data[4];
		var $checkedOption = $( "input[type=radio][name=filterintdate]:checked" ).val();
		
		if($checkedOption == "showall"){
			return true;
		
		}
		else if($checkedOption == "notinterviewed"){
			if(interviewed == "Not interviewed"){
				return true;
			
			}
			else{
				return false;
				
			}
		}
		else{
			if(interviewed != "Not interviewed"){
				return true;
				
			}
			else{
				return false;
			
			}
		}
	}
);

$(document).ready(function() {
	
	//var $radios = $('input[name=filterintdate]');
	if($('#ListofApplications').length){
		var table = $('#ListofApplications').DataTable({
		"aoColumnDefs": [
			{ 'bSortable': false, 'aTargets': [ 4,5,6,7 ] }
		]
	}) ;
	}else{
		var table = $('#ListofApplicationsAdmin').DataTable({
			"aoColumnDefs": [{
				'bSortable': false, 'aTargets': [ 4,5 ]
			}]
		});	
	}
	

	$( "div.dataTables_length>label" ).wrap("<div class='row'></div>");
	$( "div.dataTables_length>label" ).addClass("inline-div");
	$('div.dataTables_length>div').append('<div id = \"interviewFilter\" class = \"interview-filter inline-div left-align-text\"></div>');
	$('#interviewFilter').prepend('<input type=\"radio\" name=\"filterintdate\" id = \"r\" value=\"notinterviewed\"> <b>Not interviewed</b>' );
	$('#interviewFilter').prepend('<input type=\"radio\" name=\"filterintdate\" id = \"r\" value=\"interviewed\"> <b>Interviewed</b><br>' );
	$('#interviewFilter').prepend('<input type=\"radio\" name=\"filterintdate\" id = \"r\" value=\"showall\"/> <b>Show all</b><br>' );
	$('input:radio[name="filterintdate"]').filter('[value="showall"]').attr('checked', true);
	// $('div.dataTables_length>div').prepend('<div class = "col-sm-6"');
	// $('div.dataTables_length>div').append('</div>');
	
	table.draw();
	$('input[type=radio][name=filterintdate]').change(function() {
		
		table.draw();
		
	} );
	
	//add margin to the right and reset clear
	$(".dataTables_length").css('clear', 'none');
	$(".dataTables_length").css('margin-right', '20px');

	//reset clear and padding
	$(".dataTables_info").css('clear', 'none');
	$(".dataTables_info").css('padding', '0');
} );

// $(document).ready(function() {
	
	
	// table.draw();
	
	// $('input[type=radio][name=filterintdate]').change(function() {
		
		// table.draw();
		
	// } );
	// //$("div.toolbar").html('<b>ma jar! Text/images etc.</b>');
	// //add margin to the right and reset clear
	// $(".dataTables_length").css('clear', 'none');
	// $(".dataTables_length").css('margin-right', '20px');

	// //reset clear and padding
	// $(".dataTables_info").css('clear', 'none');
	// $(".dataTables_info").css('padding', '0');
// } );
	
