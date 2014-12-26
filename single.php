<?php get_header(); ?>
<div class="row">
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
    <?php } else { ?>
     <div class="featured-img-full "><img src="<?php bloginfo('template_url'); ?>/assets/img/noimg-full.png"></div> 
    <?php } ?>
  <?php } ?>
  <?php while ( have_posts() ) : the_post(); ?>  
   <article id="post-<?php the_ID(); ?>" class="full-post-content post-content-shadow <?php post_class(); ?>">  
      <h1 class="title"><?php the_title(); ?></h1> 
       <div class="post-body"> 
        <div class="post-details">
          By <strong><?php the_author_posts_link(); ?> / <?php the_time( 'M j Y' ); ?> / <?php the_category(', ') ?><?php $site = get_post_custom_values('projLink'); if($site[0] != ""){ ?> <a href="<?php echo $site[0] ?>">Visit the link</a> <?php } ?>  
      </strong>
        </div>  
      </div>
      <?php the_content(); ?>
      <div class="tags-post"><?php the_tags('#',' #'); ?></div>
     <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('post-bottom')) : ?> 
     <?php endif; ?>
  </article>
    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('after-post')) : ?> 
    <?php endif; ?>
  <?php comments_template( '', true ); ?>   
  <?php endwhile; ?>  
  </div>
    <div class="widgets-right">
    <div class="span3">
      <?php get_sidebar(); ?>  
    </div>
    </div>
</div>
<div style="fix-alignment"></div>
<?php get_footer(); ?>