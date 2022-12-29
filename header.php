<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-gray-900 antialiased' ); ?>>

	<div @click.away="open = false" x-data="{ open: false }" class="sticky top-0 z-30 login-bar px-8 py-4 bg-secondary flex items-center flex-row justify-between">

		<div class="login-bar-left text-white">
			<!-- <a class="mr-4" href="#"><i class="mr-2 fa-solid fa-house"></i><span class="hidden md:inline-block">0186-84 30 46</span></a> -->
			<a href="#"><i class="mr-2 fas fa-house"></i><span class="hidden md:inline-block">Home</span></a>
		</div>

		<div class="login-bar-right flex flex-row">
			<div class="language text-white mr-4 text-sm">
				<?php
					wp_nav_menu(
						array(
							'container_id'    => '',
							'container_class' => 'py-1',
							'menu_class'      => 'flex',
							'theme_location'  => 'langmenu',
							'li_class'        => '',
							'fallback_cb'     => false,
						)
					);
				?>
			</div>

			<span @mouseenter="open = true" class="flex items-center ml-2 text-lg text-white focus:outline-none">
				<?php
					// if ( is_user_logged_in() ) { $usr_id = get_current_user_id(); $usr_data = get_user_by( 'id', $usr_id );
					// 	echo '<a href="'.get_permalink( wc_get_page_id( 'myaccount' ) ).'"class="flex items-center"><i class="mr-2 fas fa-user-circle"></i> <span class="text-sm">'. $usr_data->user_email .'</span></a>';
					// } else {
					// 	echo '<a href="'. wp_login_url() .'" class="flex items-center"><i class="mr-2 fas fa-user-circle"></i> <span class="text-sm">Dashboard</span></a>';
					// }
				?>
				<i class="ml-2 fas fa-caret-down"></i>
			</span>
			<div x-show="open" @mouseleave.debounce.250 = "open = false" class="z-50 absolute right-0 mt-8 mr-6 origin-top-right rounded shadow-lg w-48" >
				<div class="px-2 py-2 bg-white rounded shadow">
					<?php if(! is_user_logged_in()): ?>
						<a class="block px-4 py-2 mt-2  bg-transparent rounded text-sm md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
							href="<?php echo wp_login_url(); ?>">
							Login
						</a>
						<a class="block px-4 py-2 mt-2  bg-transparent rounded  text-sm md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
							href="<?php //echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
							Registreer
						</a>
					<?php else: ?>
						<a class="block px-4 py-2 mt-2  bg-transparent rounded  text-sm md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
							href="<?php //echo get_permalink( woocommerce_get_page_id( 'myaccount' ) ); ?>">
							Dashboard
						</a>
						<a class="block px-4 py-2 mt-2  bg-transparent rounded  text-sm md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
							href="<?php echo wp_logout_url(); ?>">
							<?php _e( 'Uitloggen', 'mixpress' ); ?>
						</a>
					<?php endif;?>
					<!-- <a class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
						href="forum.html">
						Forum
					</a> -->
				</div>
			</div>
		</div>
  </div>




	<main>
