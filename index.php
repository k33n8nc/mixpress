<?php get_header(); ?>
<h1>index.php</h1>

<div class="mx-auto mt-10 px-8">
  <div class="bg-primary mix-blend-overlay rounded h-48 sm:h-64 xl:h-80" id="hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero.jpg');">

  </div>
</div>

<section class="text-gray-600 body-font">
  <div class="px-5 py-24 mx-auto">
    <div class="flex flex-wrap w-full mb-20">
      <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Niet raden, maar weten</h1>
        <div class="h-1 w-20 bg-primary rounded"></div>
      </div>
      <p class="lg:w-1/2 w-full leading-relaxed text-gray-800">
				Stichting de Pyramide publicieert artikelen in het kader van (Esotherische) kennis en zelfontiwkkeling.
				Door studie en het verbinden van kennis met je dagelijkse leven, kun jij je als persoon innerlijk ontwikkelen
			</p>
    </div>

    <div class="flex flex-wrap -m-4">
      <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
      <div class="p-4 md:w-1/3">
        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
          <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="blog">
          <div class="p-6">
            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1 uppercase"><?php echo get_the_category()[0]->name ?></h2>
            <h1 class="title-font text-lg font-medium text-gray-900 mb-3"><?php echo get_the_title(); ?></h1>
            <p class="leading-relaxed mb-3"><?php echo get_the_excerpt( ); ?></p>
            <div class="flex items-center flex-wrap ">
              <a href="<?php echo get_the_permalink( );?>" class="text-primary inline-flex items-center md:mb-2 lg:mb-0">
                <?php _e('Lees verder', 'mixpress'); ?>
              </a>
              <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                <i class="mr-2 fas fa-eye"></i> 1.2K
              </span>
              <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                <i class="mr-2 fas fa-comments"></i> 89
              </span>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>



<?php
get_footer();
