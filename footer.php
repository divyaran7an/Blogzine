  </div>
<footer>
<div class="container">
<div class="row">
<div class="span4">
<?php get_sidebar('left-footer'); ?>
</div>
<div class="span4">
<?php get_sidebar('mid-footer'); ?>
</div>
<div class="span4">
<?php get_sidebar('right-footer'); ?>
</div>
</div>
</div>
</footer>
    <?php wp_footer(); ?>
    <script type="text/javascript">
    (function($){$().UItoTop({easingType:'easeOutCirc'});})(jQuery); 
      jQuery(window).load(function() {
          jQuery('.flexslider').flexslider({
          animation: "fade",
          direction: "horizontal",
          slideshowSpeed: 7000,
          animationSpeed: 600
        });
    });
    jQuery(function($) {
         $("#contact-form").validate({errorClass: "alert alert-error"});
    });
    <?php if( of_get_option('analytics') ) { echo of_get_option('analytics'); }?>
  </script>
  </body>
</html>