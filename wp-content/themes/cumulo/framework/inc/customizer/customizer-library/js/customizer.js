/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
'use strict';

( function( $ ) {

	function customize ( val, innerfunction ) {
		if ( innerfunction == undefined ) return ;
		if ( ! $.isFunction(innerfunction) ) return;

		wp.customize( val, function( value ) {
			value.bind( function( to ) {
				innerfunction( to );
			} );
		} );
	}

	/* --- header --- */
	customize ("header-logo-margin-top", function( content ) {
		if ( content.trim() == '' ) {
			$("#logo-header").css('margin-top', "31.5px");
		}
		else {
			$("#logo-header").attr('style', 'margin-top: ' + content.concat( "px !important;" ) );
		}
	});

	customize ("header-infobar-phone", function( content ) {
		if ( content.trim() == '' )
			$("span.info-phone", "#header-info-bar").html( "" );
		else  {
			var parent = $( "span.info-phone", "#header-info-bar .container" );
			parent.html( "<span class=\"info-phone\"><span class=\"info-icon-wrapper\"><i class=\"fa fa-phone\"></i></span><span>" + content + "</span></span>" );
			
		}
	});

	customize ("header-infobar-email", function( content ) {
		if ( content.trim() == '' )
			$("span.info-email", "#header-info-bar").html( "" );
		else {
			var parent = $( "span.info-email", "#header-info-bar div.container" );
			parent.html( "<span class=\"info-email\"><span class=\"info-icon-wrapper\"><i class=\"fa fa-envelope-o\"></i></span><span>" + content + "</span></span>" );
		}
	});

	var social_container = $("ul.header-social", "#header-info-bar");
	customize('header-social-twitter', function( content ) {
		customize_social( social_container, "twitter", content, 1 );
	} );
	customize('header-social-linkedin', function( content ) {
		customize_social( social_container, "linkedin", content, 2 );
	} );
	customize('header-social-facebook', function( content ) {
		customize_social( social_container, "facebook", content, 3 );
	} );
	customize('header-social-skype', function( content ) {
		customize_social( social_container, "skype", content, 4 );
	} );
	customize('header-social-google-plus', function( content ) {
		customize_social( social_container, "google-plus", content, 5 );
	} );
	customize('header-social-dribbble', function( content ) {
		customize_social( social_container, "dribbble", content, 6 );
	} );
	customize('header-social-pinterest', function( content ) {
		customize_social( social_container, "pinterest", content, 7 );
	} );
	customize('header-social-apple', function( content ) {
		customize_social( social_container, "apple", content, 8 );
	} );
	customize('header-social-instagram', function( content ) {
		customize_social( social_container, "instagram", content, 9 );
	} );
	customize('header-social-youtube', function( content ) {
		customize_social( social_container, "youtube", content, 10 );
	} );
	customize('header-social-vimeo-square', function( content ) {
		customize_social( social_container, "vimeo-square", content, 11 );
	} );
	customize('header-social-rss', function( content ) {
		customize_social( social_container, "rss", content, 12 );
	} );

	/* footer social */
	var social_container2 = $("ul.cmo-footer-social", "#cmo-footer");
	customize('footer-social-twitter', function( content ) {
		customize_social( social_container2, "twitter", content, 1 );
	} );
	customize('footer-social-linkedin-square', function( content ) {
		customize_social( social_container2, "linkedin-square", content, 2 );
	} );
	customize('footer-social-facebook-square', function( content ) {
		customize_social( social_container2, "facebook-square", content, 3 );
	} );
	customize('footer-social-skype', function( content ) {
		customize_social( social_container2, "skype", content, 4 );
	} );
	customize('footer-social-google-plus', function( content ) {
		customize_social( social_container2, "google-plus", content, 5 );
	} );
	customize('footer-social-dribbble', function( content ) {
		customize_social( social_container2, "dribbble", content, 6 );
	} );
	customize('footer-social-pinterest', function( content ) {
		customize_social( social_container2, "pinterest", content, 7 );
	} );
	customize('footer-social-apple', function( content ) {
		customize_social( social_container2, "apple", content, 8 );
	} );
	customize('footer-social-instagram', function( content ) {
		customize_social( social_container2, "instagram", content, 9 );
	} );
	customize('footer-social-youtube', function( content ) {
		customize_social( social_container2, "youtube", content, 10 );
	} );
	customize('footer-social-vimeo-square', function( content ) {
		customize_social( social_container2, "vimeo-square", content, 11 );
	} );
	customize('footer-social-rss', function( content ) {
		customize_social( social_container2, "rss", content, 12 );
	} );

	function customize_social ( social_container, socialname , content, index ) {
		var si = social_container.find( "a.social-" + socialname );
		if ( si.length > 0 ) { 
			if ( content.trim() == "" ) {
				si.parent().remove();
			}
			else {
				si.attr('href', content);
			}
		}
		else {
			var sl = social_container.find( 'li:nth-child(' + index + ')' );
			var newLi = $( "\n<li><a href=\"" + content + "\" class=\"social-" + socialname + "\"><i class=\"fa fa-" + socialname + "\"></i></a></li>\n" );

			if ( sl.length > 0 ) {
				newLi.insertBefore ( sl );
			}
			else {
				social_container.append( newLi );
			}
		}
	}

	customize ("footer-copyright-text", function( content ) {
		if ( content.trim() == '' )
			$("#footer-copyright-text").html( "&copy; 2015 Cumulo, Theme-Paradise" );
		else  {
			$("#footer-copyright-text").html( content );
		}
	});

} )( jQuery );
