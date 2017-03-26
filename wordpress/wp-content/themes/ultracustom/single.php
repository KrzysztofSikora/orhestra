<?php
/**
 * The template for displaying all single posts.
 *
 * @package ultrabootstrap
 */

get_header(); ?>
<div class="spacer">
<div class="container background-color-white lead">
  <div class="row">
      <div class="col-sm-2"></div>
        <div class="col-sm-8 border-dotted">
<section class="page-section">

      <div class="detail-content">

      	<?php while ( have_posts() ) : the_post(); ?>                    
  	      <?php get_template_part( 'template-parts/content', 'single' ); ?>
          

        <?php endwhile; // End of the loop. ?>

    
        <?php comments_template(); ?>


                  </div><!-- /.end of deatil-content -->
  			 
</section> <!-- /.end of section -->  
</div>
    <div class="col-sm-2"><?php get_sidebar(); ?>
    </div>
    </div>
</div>
</div>
<?php get_footer(); ?>