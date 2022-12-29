
<?php get_header(); ?>
<section class="container mx-auto px-6 md-px-0 my-16 text-gray-600 body-font">   
  <div class="flex flex-wrap w-full mb-20">
    <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Lessen Esotherie</h1>
      <div class="h-1 w-20 bg-primary rounded"></div>
    </div>
    <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eaque, et porro eveniet odio illo eum vero 
      temporibus aut at consequuntur quibusdam illum dignissimos numquam, quidem repellendus obcaecati quos enim iure!
    </p>
  </div>   
  
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 lg:gap-8">
  <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
  <div class="rounded-lg border border-gray-300">
    <img
      class="rounded-t object-cover w-full h-48"
      src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>"
      alt="image"
    />
    <div class="px-6 py-4">
      <h1 class="mb-3 text-xl font-bold text-primary">
        <?php echo get_the_title(); ?>
      </h1>
      <!-- <h1 class="title-font text-lg font-medium text-gray-900 mb-3"><?php echo get_the_title(); ?></h1> -->
        <p class="leading-relaxed mb-3"><?php echo get_the_excerpt( ); ?></p>
      <a href="<?php echo get_the_permalink( );?>" class="text-white inline-flex items-center bg-primary px-4 py-2 rounded">
        <?php _e('Bekijken', 'mixpress'); ?>
      </a>

    </div>
  </div>
  <?php endwhile; endif; ?>
</div>
</section>
<?php
get_footer();
