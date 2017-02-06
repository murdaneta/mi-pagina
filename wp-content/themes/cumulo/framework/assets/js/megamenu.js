'use strict';

;( function( $ ) {
	$(document).ready( function () {
		$(document).on( 'click', "p.megamenu-item.field-cmo_enable_megamenu input[type=checkbox]", function(e) {
			
			var parent = $(this).closest('li.menu-item');

			if ( $(this).is(":checked") ) {
				if ( ! parent.hasClass('menu-item-depth-0') ) {
					return;
				}

				showCustomFields( parent );
				while ( parent = parent.next() )
				{
					if( typeof parent.attr('class') == 'undefined' ) break;
					if ( parent.hasClass('menu-item') && parent.hasClass('menu-item-depth-0' ) ) break;

					showCustomFields ( parent );
				}
			}
			else {
				if ( ! parent.hasClass('menu-item-depth-0') ) {
					return;
				}

				hideCustomFields( parent );
				while ( parent = parent.next() )
				{
					if( typeof parent.attr('class') == 'undefined' ) break;
					if ( parent.hasClass('menu-item') && parent.hasClass('menu-item-depth-0' ) ) break;
					hideCustomFields ( parent );
				}
			}
		});

		function showCustomFields ( obj ) {
			obj.find('p.megamenu-item.field-cmo_disable_caption').removeClass('disabled-menu');
//			obj.find('p.megamenu-item.field-cmo_mega_background').removeClass('disabled-menu');
		}

		function hideCustomFields ( obj ) {
			obj.find('p.megamenu-item.field-cmo_disable_caption').addClass('disabled-menu');
//			obj.find('p.megamenu-item.field-cmo_mega_background').addClass('disabled-menu');
		}

		$( "#menu-to-edit" ).on( "sortstop", function( event, ui ) {
			setTimeout ( function ( ) { 
				var obj = $( ui.item[0] );
				var origin = obj;

				if ( obj.hasClass( 'menu-item-depth-0') ) {
					if ( obj.find('p.megamenu-item.field-cmo_enable_megamenu input[type=checkbox]').is(':checked') )
						showCustomFields( obj );
				}
				else if ( obj.hasClass('menu-item-depth-1') || obj.hasClass('menu-item-depth-2') )
				{
					while ( ( obj = obj.prev() ) != null && obj.hasClass('menu-item') && !obj.hasClass('menu-item-depth-0') ) {}

					if ( obj.find( 'p.megamenu-item.field-cmo_enable_megamenu input[type=checkbox]' ).is(':checked') ) {
						showCustomFields( origin );
					}
					else
						hideCustomFields( origin );
				}
			}, 100 );
		} );

		var chkBoxes = $('input[type=checkbox]', 'p.megamenu-item.field-cmo_enable_megamenu');

		for ( var ci = 0; ci<chkBoxes.length; ci++ ) {
			var obj = $( chkBoxes[ci] ).closest('li.menu-item');
			var origin = obj;

			if ( obj.find('p.megamenu-item.field-cmo_enable_megamenu input[type=checkbox]').is(':checked') ) {
				showCustomFields( obj );
			}
			else if ( obj.hasClass('menu-item-depth-1') || obj.hasClass('menu-item-depth-2') )
			{
				while ( ( obj = obj.prev() ) != null && obj.hasClass('menu-item') && !obj.hasClass('menu-item-depth-0') ) {}

				if ( obj.find( 'p.megamenu-item.field-cmo_enable_megamenu input[type=checkbox]' ).is(':checked') ) {
					showCustomFields( origin );
				}
				else
					hideCustomFields( origin );
				}
			}
		
		// load jquery.select2 
		$("select[id^='edit-menu-item-cmo_fa_icons']").select2(
		{
			width: "100%",
			templateResult: select2Formatter,
			templateSelection: select2Formatter
		});
		
		function select2Formatter ( icon ) {
				var original = icon.element;
				return $( '<span><i class="fa fa-fw ' + $(original).data('icon') + '"></i> ' + icon.text + '</span>');
		}
		
		$(document).ajaxComplete( function() {
			$("select[id^='edit-menu-item-cmo_fa_icons']").select2(
			{
				width: "100%",
				templateResult: select2Formatter,
				templateSelection: select2Formatter
			});
		});
		
		$(document).on('click', ".megam-file-upload", function(e) {
			e.preventDefault();
			var self = $(this);

			var file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Select Image',
				button: {
					text: 'Select Image',
				},
				frame: 'post',

				multiple: false  // Set to true to allow multiple files to be selected
			});

			file_frame.open();

			$('.media-menu a:contains(Insert from URL)').remove();
			$('.media-menu a:contains(Create Gallery)').remove();

			file_frame.on( 'select', function() {
				var selection = file_frame.state().get('selection');
				selection.map( function( attachment ) {
					attachment = attachment.toJSON();
					self.parent().find('.megam-file-upload-path').val( attachment.url );
				});

				$('.media-modal-close').trigger('click');
			});

			file_frame.on( 'insert', function() {
				var selection = file_frame.state().get('selection');
				selection.map( function( attachment ) {
					attachment = attachment.toJSON();
					self.parent().find('.megam-file-upload-path').val( attachment.url );
				});
	
				$('.media-modal-close').trigger('click');
			});
		});

	});
})( jQuery );