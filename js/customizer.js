/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'awesome_one_page_custom_primary_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).css('color', to );
		} );
	} );


	/* Shows a live preview of changing the breadcrumbs text. */
	wp.customize( 'aop_breadcrumb_home_text', function( value ) {
		value.bind( function( to ) {
			$( '#aop-breadcrumbs' ).find('span:first').html( to ) ;
		});
	});
	
} )( jQuery );
