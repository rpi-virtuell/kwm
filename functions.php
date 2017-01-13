<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'chld_thm_cfg_parent' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION

/**
 * Zusätzliche Tags im tiny-mce erlauben
*/
add_action( 'init', function () { 
    global $allowedposttags;

   $allowedposttags['iframe'] = array(
        'src'    => array(),
        'height' => array(),
        'widdiv'  => array(),
    );
  
    $allowedposttags['i'] = array(
        'class'    => array()
    );
});

add_filter('tiny_mce_before_init', 'vipx_filter_tiny_mce_before_init');
function vipx_filter_tiny_mce_before_init( $options ) {
 
    if ( ! isset( $options['extended_valid_elements'] ) ) {
        $options['extended_valid_elements'] = '';
    } else {
        $options['extended_valid_elements'] .= ',';
    }
 
    if ( ! isset( $options['custom_elements'] ) ) {
        $options['custom_elements'] = '';
    } else {
        $options['custom_elements'] .= ',';
    }
 
    $options['extended_valid_elements'] .= 'i[class|id|style],iframe[class|id|style|widdiv|height]';
    $options['custom_elements']         .= 'i[class|id|style],iframe[class|id|style|widdiv|height]';
    return $options;
}




function kwm_mce_css( $mce_css ) {
	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	#$mce_css .= plugins_url( 'editor.css', __FILE__ );
	$mce_css .= '/wp-content/themes/kwm/ctc-style.css';

	return $mce_css;
}
add_filter( 'mce_css', 'kwm_mce_css' );

add_action( 'password_protected_login_head', 'kwm_login_logo' );
function kwm_login_logo(){
	?>
	<style>
		.login h1 a{
			background-image: none;
			background: none;
			text-indent: 0;
			width: auto;
			font-size:130%;
		}
	</style>
	<?php
}