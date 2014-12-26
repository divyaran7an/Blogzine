<?php get_header(); ?>
<div class="row">
  <div class="span9">
  <?php if( of_get_option('slider') == '1') get_template_part('slider'); ?>
  <h5 class="results"><?php single_cat_title(__('Showing posts from: ', 'blogzine'), true); ?></h5>
  <div class="display-posts clearfix">
  <?php while (have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
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
    <div class="post-body">
      <div class="title title-block"><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
    <div class="post-details">
    By <strong><?php the_author_posts_link(); ?></strong> - <strong><?php the_time( 'M j Y' ); ?></strong>
    </div>
      <div class="post-text">
      <?php the_excerpt(); ?>
      </div>
      </div>
    </article>    
  <?php endwhile; ?>   
  </div>
  <?php if ( $wp_query->max_num_pages > 1 ) : ?>
  <ul class="pager fix-alignment">
    <li class="previous">                 
     <?php previous_posts_link('&larr; Newer Posts'); ?>
    </li>
    <li class="next">
     <?php next_posts_link('Older Posts &rarr;'); ?>
    </li>
  </ul>
  <?php endif; ?> 
  </div>
    <div class="widgets-right">
    <div class="span3">
      <?php get_sidebar(); ?>   
    </div>
    </div>
</div>
<div style="fix-alignment"></div>
<?php get_footer(); ?>