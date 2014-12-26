<?php
/* Template Name: Portfolio */
get_header(); 
query_posts('post_type=portfolio&posts_per_page=12');
?>
<div class="row">
  <div class="span12">
  <h5 class="results"><?php the_title(); ?></h5>
  <div class="display-posts clearfix">
  <?php while (have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class('portfoio-item'); ?>>
  <div class="featured-img-full image-effect portfolio-thumbnail"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a></div>
  <div class="post-body">
  <div class="title-portfolio"><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></div>
    <div class="post-details">
    <div class="cat-portfolio"><?php echo get_the_term_list($post->ID, 'project-type'); ?></div>
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
</div>
<div style="fix-alignment"></div>
<?php get_footer(); ?>