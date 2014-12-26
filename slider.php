<div class="flexslider">
    <ul class="slides">
      <?php 
        $loop = new WP_Query(array('post_type' => 'slider', 'posts_per_page' => -1, 'orderby'=> 'ASC')); 
      ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <li>
          <?php $url = get_post_meta($post->ID, "url", true);
          if($url!='') { 
            echo '<a href="'.$url.'">';
            echo the_post_thumbnail('large');
            echo '</a>';
          } else {
            echo the_post_thumbnail('large');
          } ?>
          <div class="sider-content">
            <h4 class="title"><?php the_title(); ?></h4>
            <div class="space"></div>  
            <?php the_excerpt();?>
          </div>
        </li>
      <?php endwhile; ?>
      <?php wp_reset_query(); ?>
    </ul>
</div>