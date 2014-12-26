<?php
/*
Template Name: Sidebar Left
*/
get_header(); 
?>
<div class="row">
<div class="widgets-left">
  <div class="span3">
    <?php get_sidebar(); ?>  
  </div>
</div>
  <div class="span9">
  <?php
  if ( get_post_format() == 'video' ){
    echo '<div class="video">' . wp_oembed_get( get_post_meta( get_the_ID(), 'cpt_post_video', true ) ) . '</div>';
  } elseif ( get_post_format() == 'audio' ){ 
    echo '<div class="soundcloud">' . wp_oembed_get( get_post_meta( get_the_ID(), 'cpt_post_soundcloud', true ) ) . '</div>';
  } elseif ( get_post_format() == 'quote' ){ 
    echo '<blockquote class="quote">'.get_post_meta( get_the_ID(), 'cpt_post_quote', true ) .'</blockquote>';  
  } elseif ( get_post_format() == false ){ ?>
    <?php if (has_post_thumbnail()) { ?>
      <div class="featured-img-full"><?php the_post_thumbnail('full'); ?></div> 
    <?php } ?>
  <?php } ?>
  <?php while ( have_posts() ) : the_post(); ?>  
   <article id="post-<?php the_ID(); ?>" class="page-content post-content-shadow <?php post_class(); ?>">  
      <h1 class="title"><?php the_title(); ?></h1> 
       <div class="page-body"> 
      <?php the_content(); ?>
      </div>
  </article>
  <?php endwhile; ?>  
  </div>
</div>
<div style="fix-alignment"></div>
<?php get_footer(); ?>