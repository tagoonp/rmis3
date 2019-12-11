/*FormWizard Init*/
$(function(){
	// "use strict";

	/* Basic Wizard Init*/
	if($('#example-basic').length >0)
		$("#example-basic").steps({
			headerTag: "h3",
			bodyTag: "section",
			transitionEffect: "fade",
			autoFocus: true,
			titleTemplate: '<span class="number">#index#</span> #title#',
		});

	$('#datable_1').DataTable({
		 "bFilter": false,
		 "bLengthChange": false,
		 "bPaginate": false,
		 "bInfo": false,
		  "footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;

				// Remove the formatting to get integer data for summation
				var intVal = function ( i ) {
					return typeof i === 'string' ?
						i.replace(/[\$,]/g, '')*1 :
						typeof i === 'number' ?
							i : 0;
				};

				// Total over all pages
				var total = api
					.column( 3 )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );

				// Total over this page
				var pageTotal = api
					.column( 3, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );

				// Update footer
				$( api.column( 3 ).footer() ).html(
					'$'+pageTotal
				);
			}
	});

});
