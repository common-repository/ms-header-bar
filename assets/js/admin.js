(function($) {

	$(document).ready(function() { 


		$('#msh-popup-elist').DataTable( {

			dom: 'Bfrtip',

			buttons: [

				'copy', 'csv', 'excel', 'print'

			]

		} );



	
		$('#msh-header-callback-elist').DataTable( {

			dom: 'Bfrtip',

			buttons: [

				'copy', 'csv', 'excel', 'print'

			]

		} );


        $('#msh-popup-elist').css({

            paddingLeft: 0,

            paddingRight: 0

        })

        $('#msh-header-callback-elist').css({

            paddingLeft: 0,

            paddingRight: 0

        })


	} );

})(jQuery);