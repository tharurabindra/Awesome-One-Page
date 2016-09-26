/**
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
jQuery(document).ready(function() {
	jQuery('.controls#aop-img-container li img').click(function(){
		jQuery('.controls#aop-img-container li').each(function(){
			jQuery(this).find('img').removeClass ('aop-radio-img-selected') ;
		});
		jQuery(this).addClass ('aop-radio-img-selected') ;
	});

	// Toggle active class for design content
	jQuery( document.body ).on( 'click', '.aop-design-options-title', function() {
		jQuery(this).closest( ".widget" ).find( ".accordion-content" ).toggleClass( "active" );
	});
});
