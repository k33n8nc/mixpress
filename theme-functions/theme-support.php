<?php
// ****************************************
// Add compiled assets and manifest to html
// ****************************************
function mixpress_get_mix_compiled_asset_url( $path ) {
	$path                = '/assets' . $path;
	$stylesheet_dir_uri  = get_stylesheet_directory_uri();
	$stylesheet_dir_path = get_stylesheet_directory();

	if ( ! file_exists( $stylesheet_dir_path . '/mix-manifest.json' ) ) {
		return $stylesheet_dir_uri . $path;
	}

	$mix_file_path = file_get_contents( $stylesheet_dir_path . '/mix-manifest.json' );
	$manifest      = json_decode( $mix_file_path, true );
	$asset_path    = ! empty( $manifest[ $path ] ) ? $manifest[ $path ] : $path;

	return $stylesheet_dir_uri . $asset_path;
}

// **************************************************************************
// Add defer="defer" to app.js for Alpine JS delayed component initialisation
// **************************************************************************
add_filter( 'script_loader_tag', function ( $tag, $handle ) {
 if ( 'mixpress' !== $handle ){
   return $tag;
 }
 return str_replace( ' src', ' defer="defer" src', $tag );
}, 10, 2 );

// ***************************
// Setup theme support and nav
// ***************************
function mixpress_setup() {
	add_theme_support( 'title-tag' );
	register_nav_menus(
		array(
			'primary' => __( 'Mixpress topbar menu', 'mixpress' ),
			'langmenu' => __( 'Mixpress lang menu', 'mixpress' ),
		)
	);
	add_theme_support(
		'html5',
		array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);
	add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'mixpress_setup' );

// **************************************
// Setup translation support for mixpress
// **************************************
add_action('after_setup_theme', 'load_translations');
function load_translations(){
	load_theme_textdomain( 'mixpress', get_template_directory() .'/languages' );
}
