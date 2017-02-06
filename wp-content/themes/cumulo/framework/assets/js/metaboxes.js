;( function( $ ) {
$(document).ready( function () {
	var minHeight = $('ul.cmo_metabox_tabs').height();
	
	function set_tab_height() {
		var height = $('div.cmo_metabox').height();
		$('ul.cmo_metabox_tabs').height(
			height > minHeight ? ( height + 40 ): minHeight	
		);
	}

	$(".cmo_metabox_tabs a").click ( function ( e ) {
		e.preventDefault();

		$(".cmo_metabox_tabs li").removeClass('active');
		$(this).closest( 'li' ).addClass('active');

		$('.cmo_metabox_tab').hide();

		var tabid = $(this).attr( 'href' );
		tabid = tabid.replace( '#', '' );

		$('#cmo_tab_' + tabid + '.cmo_metabox_tab').fadeIn( 300,
				function ( ) {
					set_tab_height();
				}
		);
	});

	$(".cmo_metabox_tabs li.active a").trigger('click');

	$('.cmo_metabox input.cmo_upload_button').click( function(e) {
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

				self.parent().parent().find('.upload_field').val( attachment.url );
			});

			$('.media-modal-close').trigger('click');
		});

		file_frame.on( 'insert', function() {
			var selection = file_frame.state().get('selection');
			var size = $('.attachment-display-settings .size').val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				if(!size) {
					attachment.url = attachment.url;
				} else {
					attachment.url = attachment.sizes[size].url;
				}

				self.parent().parent().find('.upload_field').val( attachment.url );
			});

			self.text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});
	});
	
	var custom_uploader;
	$('.cmo_multiple_images').each( function() {
		var multiple_image_wrapper = $(this);
		var id = multiple_image_wrapper.data('formid');
		$(this).find('.cmo_multiple_upload_button').click( function(e) {
			e.preventDefault();
			
			if (custom_uploader) {
		        custom_uploader.open();
		        return;
		    }
			
			custom_uploader = wp.media.frames.file_frame = wp.media({
		        title: 'Choose Image',
		        button: {
		            text: 'Choose Image'
		        },
		        multiple: true
		    });
		    custom_uploader.on('select', function() {
		    	var selection = custom_uploader.state().get('selection');
		    	var upload_container = multiple_image_wrapper.find('.cmo_uploaded_images');
		        selection.map( function( attachment ) {
			        attachment = attachment.toJSON();
			        var img_html = '';
			        img_html += '<div class="image">';
			        img_html += ( '<img src="' + attachment.sizes['thumbnail'].url + '">' );
			        img_html += ( '<input type="hidden" id="cmo_' + id + '" name="cmo_' + id + '[]" value="' + attachment.id + '">' );
			        img_html += '<i class="remove fa fa-close"></i>';
			        img_html += '</div>';
			        upload_container.append( img_html );
		        });
		        set_tab_height();
		    });
		    custom_uploader.open();
		} );
	} );
	$(document).on( 'click', '.cmo_uploaded_images .remove', function(){
		var img_container = $(this).closest('.image');
		img_container.remove();
	} );

	$('.cmo-metabox-color-picker').wpColorPicker();
});
})( jQuery );