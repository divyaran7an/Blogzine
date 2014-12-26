<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <title><?php bloginfo('name'); ?> <?php wp_title("-"); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php if( of_get_option('meta_description') ) { ?>
    <meta name="description" content="<?php echo of_get_option('meta_description') ?>">
    <?php } ?>
    <?php if( of_get_option('meta_keywords') ) { ?>
    <meta name="keywords" content="<?php echo of_get_option('meta_keywords') ?>">
    <?php } ?>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if( of_get_option('custom_favicon') ) { ?>
    <link rel="icon" href="<?php echo of_get_option('custom_favicon') ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo of_get_option('custom_favicon') ?>" type="image/x-icon" />
    <?php } ?>
    <?php wp_head(); ?>
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php $options = get_option( 'theme_settings' ); ?>
    <?php
      if ( is_singular() && get_option( 'thread_comments' ) )
      wp_enqueue_script( 'comment-reply' );
      wp_get_archives('type=monthly&format=link');
    ?>
</head>
<?php flush(); ?>
<body class="page-404-bg">
<div class="container">
<div class="row">
<div class="span12">
  <article id="page" class="page-404">  
      <h1 class="title"><?php if( of_get_option('page-404-title') ) { echo of_get_option('page-404-title'); } else { echo "404"; } ?></h1> 
      <div class="page-body"> 
        <div class="text-404"><?php if( of_get_option('page-404-text') ) { echo of_get_option('page-404-text'); } else { echo "Oops! The page you were looking for doesn't exist"; } ?></div>
        <div class="search-form">
         <input type="text" name="s" placeholder="Search..."/>
        </div>
      </div>
  </article>
 </div>
</div>
</div>
<div style="fix-alignment"></div>
</body>
</html>