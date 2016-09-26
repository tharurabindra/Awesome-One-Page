// ( function( $ ){
// 	function initColorPicker( widget ) {
// 		widget.find( '.aop-color-picker' ).wpColorPicker( {
// 			change: _.throttle( function() {
// 				$(this).trigger( 'change' );
// 			}, 1500 ),

//             clear: _.throttle( function() {
// 				$(this).trigger( 'change' );
// 			}, 1500 ),
// 		});
// 	}

// 	function onFormUpdate( event, widget ) {
// 		initColorPicker( widget );
// 	}

// 	$( document ).on( 'widget-added widget-updated', onFormUpdate );

// 	$( document ).ready( function() {
// 		$( '.aop-color-picker' ).each( function () {
// 			initColorPicker( $( this ) );
// 		} );
// 	} );
// }( jQuery ) );

(function ($) {
function initColorPicker(widget) {
   widget.find('.aop-color-picker').wpColorPicker({
      change: _.throttle(function () { // For Customizer
         $(this).trigger('change');
      }, 3000)
   });
}
function onFormUpdate(event, widget) {
   initColorPicker(widget);
}
$(document).on('widget-added widget-updated', onFormUpdate);

$(document).ready(function () {
   $('#widgets-right .widget:has(.aop-color-picker)').each(function () {
      initColorPicker($(this));
   });
});
}(jQuery));