<?php get_header(); ?>

<section class="container mx-auto p-12">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <?php //echo the_title( '<h1>', '</h1>' ); ?>
  <?php echo the_content( ); ?>
<?php endwhile; endif; ?>

</section>

<?php
get_footer();
