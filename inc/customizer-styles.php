<?php
/**
 * @package Awesome One Page
 */

/**
 * Convert hexdec color string to rgb(a) string
 */
function awesome_one_page_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if( empty( $color ) )
		return $default;

	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map( 'hexdec', $hex );

	//Check if opacity is set(rgba or rgb)
	if( $opacity ){
		if( abs( $opacity ) > 1 )
			$opacity = 1.0;
		$output = 'rgba( '.implode( ",",$rgb ).','.$opacity.' )';
	} else {
		$output = 'rgb( '.implode( ",",$rgb ).' )';
	}

	//Return rgb(a) color string
	return $output;
}

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function awesome_one_page_darkcolor($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0,min(255,$color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

add_action( 'wp_head', 'awesome_one_page_custom_style' );
/**
 * Hooks the Custom Internal CSS to head section
 */
function awesome_one_page_custom_style() {

	$theme_color = get_theme_mod( 'awesome_one_page_theme_color', '#9b59b6' );

    if ( $theme_color == 'watermelon' ) {
        $theme_primary_color = '#ef717a';
    } elseif ( $theme_color == 'red' ) {
        $theme_primary_color = '#e74c3c';
    } elseif ( $theme_color == 'orange' ) {
        $theme_primary_color = '#e67e22';
    } elseif ( $theme_color == 'yellow' ) {
        $theme_primary_color = '#ffcd02';
    } elseif ( $theme_color == 'lime' ) {
        $theme_primary_color = '#a5c63b';
    } elseif ( $theme_color == 'green' ) {
        $theme_primary_color = '#2ecc71';
    } elseif ( $theme_color == 'mint' ) {
        $theme_primary_color = '#1abc9c';
    } elseif ( $theme_color == 'teal' ) {
        $theme_primary_color = '#3a6f81';
    } elseif ( $theme_color == 'sky-blue' ) {
        $theme_primary_color = '#00bcd4';
    } elseif ( $theme_color == 'blue' ) {
        $theme_primary_color = '#5065a1';
    } elseif ( $theme_color == 'purple' ) {
        $theme_primary_color = '#745ec5';
    } elseif ( $theme_color == 'pink' ) {
        $theme_primary_color = '#f47cc3';
    } elseif ( $theme_color == 'magenta' ) {
        $theme_primary_color = '#9b59b6';
    } elseif ( $theme_color == 'plum' ) {
        $theme_primary_color = '#5e345e';
    } elseif ( $theme_color == 'brown' ) {
        $theme_primary_color = '#5e4534';
    } else {
        $theme_primary_color = '#79302a';
    }

    // Custom Primary Color
    $custom_primary_color = get_theme_mod( 'awesome_one_page_custom_primary_color' );
	if ( $custom_primary_color != '' ) {
        $theme_primary_color = $custom_primary_color;
    }

    $primary_opacity = awesome_one_page_hex2rgba($theme_primary_color);
	$theme_secondary_color    = awesome_one_page_darkcolor($theme_primary_color, -20);

	// Custom Secondary Color
    $custom_secondary_color = get_theme_mod( 'awesome_one_page_custom_secondary_color' );
	if ( $custom_secondary_color != '' ) {
        $theme_secondary_color = $custom_secondary_color;
    }

	$custom = '';
	if( $custom_primary_color != '#faa71d' ) {
		$custom .= ".site-title a { color:" . esc_attr($theme_primary_color) . "}"."\n";

		$custom .= ".site-title a:hover { color:" . esc_attr($theme_secondary_color) . "}"."\n";
	}

	if( !empty( $custom ) ) {
		echo '<!-- '.get_bloginfo('name').' Internal Styles -->';
	?>
		<style type="text/css"><?php echo esc_attr( $custom ); ?></style>
	<?php
	}

	$awesome_one_page_custom_css_value = get_theme_mod( 'awesome_one_page_custom_css', '' );
	if( !empty( $awesome_one_page_custom_css_value ) ) {
		echo '<!-- '.get_bloginfo('name').' Custom Styles -->';
	?>
		<style type="text/css"><?php echo esc_html( $awesome_one_page_custom_css_value ); ?></style>
	<?php
	}
}
