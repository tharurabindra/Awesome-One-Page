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

	/* Shows a live preview of changing the readmore text. */
	wp.customize( 'awesome_one_page_blog_read_more_text', function( value ) {
		value.bind( function( to ) {
			$( '.read-more a' ).html( to ) ;
		});
	});
	
} )( jQuery );
