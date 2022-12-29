<?php get_header(); ?>
<!-- <h1>single-sfwd-courses.php</h1> -->

<div class="bg-primary w-full sticky top-[62px] z-30">
	<div class="container mx-auto p-8 lg:px-12">
		<div class="relative w-full">
				<?php $terms = wp_get_post_terms( $post->ID, 'ld_course_category' ); ?>
			<span class="uppercase text-white font-bold text-sm">
				<?php
					foreach( $terms as $term) { 
						echo $term->name; 
					} 
				?>
			</span>
			<h1 class="text-white text-xl"><?php echo get_the_title(); ?></h1>
			<div class="flex items-center w-full lg:w-2/3 pt-4 lg:pr-20 text-white">
				
				<div class="flex items-center	mr-6">
					<div class="text-white rounded-full flex items-center justify-center text-sm px-4 py-2" style="background: rgba(0,0,0,0.1);" >
						<i class="mr-2 fas fa-book-open"></i>
						<p class="text-sm">8 <span class="hidden lg:inline">hoofdstukken</span></p>
					</div>					
				</div>

				<div class="flex items-center	mr-6">
					<div class="text-white rounded-full flex items-center justify-center text-sm px-4 py-2" style="background: rgba(0,0,0,0.1);" >
						<i class="mr-2 fas fa-video"></i>
						<p class="text-sm">34 <span class="hidden lg:inline">lesvideo's</span></p>
					</div>
				</div>

				<div class="flex items-center	">
					<div class="text-white rounded-full flex items-center justify-center text-sm px-4 py-2" style="background: rgba(0,0,0,0.1);" >
						<i class="mr-2 fas fa-graduation-cap"></i>
						<p class="text-sm">12 <span class="hidden lg:inline">opdrachten</span></p>
					</div>	
				</div>

			</div>
			<div class="hidden lg:block bg-white w-full lg:w-1/3 lg:absolute lg:top-8 lg:right-0 shadow rounded">
				<img
					class="rounded-t object-cover h-70"
					src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
					alt="image"
				/>
				<div class="px-4 pt-8 pb-4">
					<!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, necessitatibus?</p> -->
					<h1 class="text-xl text-primary"><?php echo get_the_title(); ?></h1>
					<?php
						$course_id = get_the_id();
						$course_link = get_the_permalink();
					?>
					<?php echo do_shortcode( '[learndash_course_progress course_id="'.$course_id.'"]' ); ?>



					<?php
					// course not started
						$lessons = learndash_get_lesson_list( );
						echo do_shortcode('[course_notstarted course_id="'.$course_id.'"] <a href="'.get_permalink( $lessons[0]->ID ).'" class="block w-full text-center text-white bg-primary px-4 py-2 rounded">Start</a> [/course_notstarted]');
						
						// course in progress
						echo do_shortcode( '[course_inprogress course_id="'.$course_id.'"]'. do_shortcode( '[ld_course_resume course_id="'.$course_id.'" button="false" html_class="block w-full text-center text-white bg-primary px-4 py-2 rounded" label="'. __('Hervat', 'mixpress') .'"]' ) .'[/course_inprogress]' );

						// course completed
						echo do_shortcode('[course_complete course_id="'.$course_id.'"] <a href="'.get_permalink( get_adjacent_post(false,'',true)->ID ).'" class="block w-full text-center text-white bg-primary px-4 py-2 rounded">'. __( 'Volgende module', 'mixpress' ) .' <i class="fas fa-arrow-right ml-2"></i> </a> [/course_complete]');
					?>
					
					<?php if( wcs_user_has_subscription() ): ?>
						<p class="text-center pt-4 text-sm underline text-gray-500"><a href="<?php echo get_permalink( woocommerce_get_page_id('myaccount'));?>">Naar dashboard</a></p>
					<?php else:  ?>
					<p class="my-2">Registreer en krijg volledige toegang tot alle modules!</p>
					<a class="block w-full text-center text-white bg-primary px-4 py-2 rounded" href="<?php echo home_url( '/abonnementen' ); ?>">Registreren</a>
					<?php endif; ?>

				</div>
			</div>

		</div>
	</div>
</div>

<div class="container mx-auto p-8 lg:p-12">
	<div class="w-3/3 lg:w-2/3 lg:pr-20 lg:min-h-[350px]">
		<?php echo do_shortcode( '[course_content]' );?>
	</div>
</div>		


</section>

<?php
get_footer();
