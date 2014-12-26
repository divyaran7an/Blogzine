<?php

class Author_Data_Widget extends WP_Widget {
  function Author_Data_Widget() {
    $widget_ops = array(
      'description' => 'A widget that displays author info on single posts.' 
    );
    $this->WP_Widget('author_data', 'Author Data', $widget_ops);
  }

  function form($instance) {
    $title = esc_attr($instance['title']);

    ?>
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>">Title: 
        <input class="widefat" 
               id="<?php echo $this->get_field_id('title'); ?>" 
               name="<?php echo $this->get_field_name('title'); ?>" 
               type="text" 
               value="<?php echo attribute_escape($title); ?>" />
        </label>
      </p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);

    return $instance;
  }

  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    
    if (is_single()) {
    
      echo $before_widget;
      $title = apply_filters('widget_title', $instance['title']);
  
      if (!empty($title)) { echo $before_title . $title . $after_title; };
      echo '<article id="post" post_class(full-author-box post-content-shadow) >';
      echo '<div class="author-avatar">'. get_avatar(get_the_author_meta('user_email'), 100) .'</div>';
      echo '<h1 class="title"> by '. get_the_author_meta('display_name') .'</h1>';
      echo '<div class="post-body">';
      if (get_the_author_meta('description')) {
        echo '<div class="description"><p>' . get_the_author_meta('description') . '</p></div>';
      }
      if (get_the_author_meta('facebook')) {
        echo '<div class="badge badge-fb">
          <a href="' . get_the_author_meta('facebook') . '" target="_blank"><i class="icon-facebook"></i> Facebook</a>
        </div>';
      }
      if (get_the_author_meta('twitter')) {
        echo '<div class="badge badge-twitter">
          <a href="http://twitter.com/' . get_the_author_meta('twitter') . '" target="_blank"><i class="icon-twitter"></i> Twitter</a>
        </div>';
      }
      if (get_the_author_meta('gplus')) {
        echo '<div class="badge badge-gplus">
          <a href="' . get_the_author_meta('gplus') . '" target="_blank"><i class="icon-google-plus"></i> Google+</a>
        </div>';
      }
      if (get_the_author_meta('user_url')) {
        echo '<div class="badge badge-website">
          <a href="' . get_the_author_meta('user_url') . '" target="_blank"><i class="icon-cloud"></i> Website</a>
        </div>';
      }
      echo '</div></article>';
      echo $after_widget;
    }
  }
}

register_widget('Author_Data_Widget');

?>