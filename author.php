<?php get_header(); ?>
<div class="row">
  <div class="span9">
   <article id="post" <?php post_class('full-author-box post-content-shadow'); ?>>
    <div class="author-avatar"><?php echo get_avatar( get_the_author_meta('user_email'), '150', '' ); ?></div>
    <?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
      <h1 class="title">About: <?php echo $curauth->display_name; ?></h1>
      <div class="post-body"> 
        <p><?php echo $curauth->user_description; ?></p>
        <?php if( $curauth->facebook ){ ?>
        <div class="badge badge-fb">
          <a href="<?php echo $curauth->facebook; ?>"><i class="icon-facebook"></i> Facebook</a>
        </div>
        <?php } ?>
        <?php if( $curauth->twitter ){ ?>
        <div class="badge badge-twitter">
          <a href="<?php echo 'http://twitter.com/'.$curauth->twitter; ?>"><i class="icon-twitter"></i> Twitter</a>
        </div>
        <?php } ?>
        <?php if( $curauth->gplus ){ ?>
        <div class="badge badge-gplus">
          <a href="<?php echo $curauth->gplus; ?>"><i class="icon-google-plus"></i> Google+</a>
        </div>
        <?php } ?>
        <?php if( $curauth->user_url ){ ?>
        <div class="badge badge-website">
          <a href="<?php echo $curauth->user_url; ?>"><i class="icon-cloud"></i> Website</a>
        </div>
        <?php } ?>
      </div>
      <div class="space"></div>
  </article>
  <div class="space"></div>
  <h5 class="results">All the posts by <?php echo $curauth->display_name; ?></h5>
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