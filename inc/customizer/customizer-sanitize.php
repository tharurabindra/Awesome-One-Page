<?php
/**
 * Sanitize for all fields.
 *
 * @package Awesome_One_Page
 */

// site layout
// function aop_sanitize_site_layout( $input ) {
//     $valid_keys = array(
//         'box'   => esc_html__('Boxed layout', 'awesome-one-page'),
//         'wide'  => esc_html__('Wide layout', 'awesome-one-page')
//     );
//     if ( array_key_exists( $input, $valid_keys ) ) {
//         return $input;
//     } else {
//         return '';
//     }
// }

//Text
function aop_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//switch option
function aop_sanitize_switch_option( $input ) {
    $valid_keys = array(
            'show'  => esc_html__( 'Show', 'awesome-one-page' ),
            'hide'  => esc_html__( 'Hide', 'awesome-one-page' )
        );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

//Checkbox
function aop_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

// radio sanitization
function aop_sanitize_radio( $input, $setting ) {
    // Ensuring that the input is a slug.
    $input = sanitize_key( $input );
    // Get the list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    // If the input is a valid key, return it, else, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

// Sanitize Integer
function aop_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
      return intval( $input );
    }
}

// Sanitize Color
function aop_hex_color_sanitize( $color ) {
return sanitize_hex_color( $color );
}
// Escape Color
function aop_color_escaping_sanitize( $input ) {
$input = esc_attr($input);
return $input;
}