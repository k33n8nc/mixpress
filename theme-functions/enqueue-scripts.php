<?php
function mixpress_enqueue_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	$theme = wp_get_theme();
	wp_enqueue_style( 'mixpress', mixpress_get_mix_compiled_asset_url( '/css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'mixpress', mixpress_get_mix_compiled_asset_url( '/js/app.js' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'gsap-js', 'https://unpkg.com/gsap@latest/dist/gsap.min.js', array(), $theme->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'mixpress_enqueue_scripts' );
