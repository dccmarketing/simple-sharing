(function( $ ) {
	'use strict';

	/**
	 * Creates a modal over the content with the URL in the link's href attribute
	 *
	 * @link
	 *
	 * @param 	string 		url 			A URL
	 * @param 	float 		width			The width in pixels
	 * @param 	float 		height 			The height in pixels
	 *
	 * @return 	void 						Creates a modal
	 */
	/*$(function(){

		$( '.modal' ).on( 'click', function( e ){

			e.preventDefault();

			var link = $( this ).attr( 'href' );

			// https://forum.jquery.com/topic/how-to-load-a-page-into-a-modal-dialog
			$( '.modal-content' ).load( link, function() {
				$( this ).dialog({
					modal: true,
					buttons: {
						'Close': function() { $( this ).dialog( 'close' ); }
					}
				});
			});



			$( '.modal-content, .modal-background' ).toggleClass( 'active' );


		});

		$( '.modal-background, .modal-close' ).on('click', function() {

			$( '.modal-content, .modal-background' ).toggleClass( 'active' );

		});

	});*/

	// http://stackoverflow.com/a/14021220
	/*$(function() {

		$( '.modal' ).on( 'click', function( e ){

			e.preventDefault();

			var link = $( this ).attr( 'href' );

			var $dialog = $( '.modal-content' )
				.html( '<iframe style="border: 0px; " src="' + link + '" width="100%" height="100%"></iframe>' )
				.dialog({
					autoOpen: false,
					modal: true,
					height: 625,
					width: 500,
					title: "Some title"
			});

			$dialog.dialog('open');

		});

	});*/

	/*$(".modal").click(function () {
        $("#thedialog").attr('src', $(this).attr("href"));
        $(".modal-content").dialog({
            width: 400,
            height: 450,
            modal: true,
            close: function () {
                $("#thedialog").attr('src', "about:blank");
            }
        });
        return false;
    });*/



	/*$('.modal').on('click', function(e){
		e.preventDefault();
        var $link = $(this);
        var $dialog = $('<div></div>')
            .load($link.attr('href') + ' #content')
            .dialog({
                autoOpen: false,
                modal: true,
                resizable: false,
                draggable: false,
                overflow: scroll,
                title: $link.attr('title'),
                width: $link.attr('width')
            });

        $link.click(function(){
            $dialog.dialog('open');
            return false;
        });
    });*/

	/*$('.modal').on('click', function() {
		e.preventDefault();

        var href = $(this).attr('href');

        $('<div>').append('<iframe src="' + href + '"></iframe>').dialog();
        return false;
    });*/

    /*$( '.modal' ).dialog({
		open: function(e) {
			e.preventDefault();
			var href = $(this).attr('href');
			$('#divInDialog').load( href, function() {
				alert('Load was performed.');
			});
		}
	});*/

	/*$( '.modal' ).on( 'click', function(e) {
		e.preventDefault();
		$( '.modal-background' ).dialog( 'open' );
	});
	$( '.modal-background' ).dialog({
		autoOpen: false,
		position: 'center' ,
		title: 'EDIT',
		draggable: false,
		width : 800,
		height : 700,
		resizable : true,
		modal : true,
	});*/

})( jQuery );