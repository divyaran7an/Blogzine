<div class="social-conection">
<?php
if( of_get_option("fb-icon") ) {
  echo '<a href="'.of_get_option("fb-icon").'" class="facebook-icon" target="_blank"><i class="icon-facebook"></i></a>';
}
if( of_get_option("tw-icon") ) {
  echo '<a href="'.of_get_option("fb-icon").'" class="twitter-icon" target="_blank"><i class="icon-twitter"></i></a>';
}
if( of_get_option("g-icon") ) {
  echo '<a href="'.of_get_option("g-icon").'" class="google-plus-icon" target="_blank"><i class="icon-google-plus"></i></a>';
}
if( of_get_option("in-icon") ) {
  echo '<a href="'.of_get_option("in-icon").'" class="instagram-icon" target="_blank"><i class="icon-instagram"></i></a>';
}
if( of_get_option("y-icon") ) {
  echo '<a href="'.of_get_option("y-icon").'" class="youtube-icon" target="_blank"><i class="icon-youtube"></i></a>';
}
if( of_get_option("db-icon") ) {
  echo '<a href="'.of_get_option("db-icon").'" class="dribbble-icon" target="_blank"><i class="icon-dribbble"></i></a>';
}
if( of_get_option("fl-icon") ) {
  echo '<a href="'.of_get_option("fl-icon").'" class="flickr-icon" target="_blank"><i class="icon-flickr"></i></a>';
}
if( of_get_option("tb-icon") ) {
  echo '<a href="'.of_get_option("tb-icon").'" class="tumblr-icon" target="_blank"><i class="icon-tumblr"></i></a>';
}
if( of_get_option("gh-icon") ) {
  echo '<a href="'.of_get_option("gh-icon").'" class="github-icon" target="_blank"><i class="icon-github"></i></a>';
}
?>
</div>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('page-sidebar')) : ?>
<?php endif; ?>