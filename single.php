<?php get_header(); ?>
<h1>single.php</h1>

<div class="mx-auto mt-10 px-8">
  <div class="bg-primary mix-blend-overlay rounded h-48 sm:h-64 xl:h-80" id="hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero.jpg');">

  </div>
</div>

<section class="container mx-auto text-gray-600 body-font overflow-hidden">
	<div class="px-8 py-24 mx-auto">
		<div class="-my-8 divide-y-2 divide-gray-100">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="py-8 flex flex-wrap md:flex-nowrap">
		  <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
		    <span class="font-semibold title-font text-gray-700 uppercase"><?php echo the_category( $post->ID ) ?></span>
		    <span class="mt-1 text-gray-500 text-sm"><?php echo get_the_date(); ?></span>
		  </div>
		  <div class="md:flex-grow">
		    <h2 class="text-2xl font-medium text-gray-900 title-font mb-2"><?php echo get_the_title(); ?></h2>
         <?php echo the_content( ); ?>
		    <a href="javascript:history.back()" class="text-primary inline-flex items-center mt-4"><i class="mr-2 fas fa-long-arrow-alt-left"></i> Ga terug
		    </a>
		  </div>
		</div>
		<?php endwhile; endif; ?>
		</div>
	</div>
</section>

<?php
get_footer();
