<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>


<?php if( wcs_user_has_subscription() ): ?>
	<?php
	$post_type = 'sfwd-courses';
	// Get all the taxonomies for this post type
	$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );
	
	foreach( $taxonomies as $taxonomy ) :
    // Gets every "category" (term) in this taxonomy to get the respective posts
    $terms = get_terms( $taxonomy );
 
    foreach( $terms as $term ) : ?>

        <?php
        $args = array(
                'post_type' => $post_type,
								'post_status' => 'publish',
								'order' => 'DESC',
								'orderby' => 'date',
								'mycourses' => false,
                'posts_per_page' => -1,  //show all posts
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $term->slug,
                    )
                )
 
            );
        $posts = new WP_Query($args);
 
        if( $posts->have_posts() ): ?>
				
				<section class="container mx-auto text-gray-600 body-font">   
					<h1 class="mt-6 mb-4 border-l-4 border-primary pl-4"><?php echo $term->name; ?></h1>
  				<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-8">				
						
						<?php while( $posts->have_posts() ) : $posts->the_post(); ?>
							<?php
								$course_id = get_the_id();
								$course_link = get_the_permalink();
							?>

						  <div class="rounded-lg border border-gray-300">
								<a href="<?php echo get_the_permalink( );?>">
									<img
										class="rounded-t object-cover w-full h-48"
										src="<?php echo get_the_post_thumbnail_url($course_id, 'full'); ?>"
										alt="image"
									/>
								</a>
								<div class="px-6 py-4">
									<a href="<?php echo get_the_permalink( );?>">
										<h1 class="mb-3 text-xl font-bold text-primary">
											<?php echo get_the_title(); ?>
										</h1>
									</a>

									<?php echo do_shortcode( '[learndash_course_progress course_id="'.$course_id.'"]' ); ?>

									<?php
									// course not started
										echo do_shortcode('[course_notstarted course_id="'.$course_id.'"] <a href="'.$course_link.'" class="text-white inline-flex items-center bg-primary px-4 py-2 rounded">Start</a> [/course_notstarted]');
									
										// course in progress
										echo do_shortcode( '[course_inprogress course_id="'.$course_id.'"]'. do_shortcode( '[ld_course_resume course_id="'.$course_id.'" button="false" html_class="text-white inline-flex items-center bg-primary px-4 py-2 rounded" label="'. __('Hervat', 'mixpress') .'"]' ) .'[/course_inprogress]' );

										// course completed
										echo do_shortcode('[course_complete course_id="'.$course_id.'"] <a href="'.$course_link.'" class="text-white inline-flex items-center bg-primary px-4 py-2 rounded"><i class="fas fa-user-graduate mr-2"></i> '. __( 'Voltooid', 'mixpress' ) .'</a> [/course_complete]');
									?>
									
								</div>
							</div>
		
						<?php endwhile; endif; ?>
					</div>
				</section>
    <?php endforeach; ?>
	<?php endforeach; ?>

<?php endif; ?>



<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */



