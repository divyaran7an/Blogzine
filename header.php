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
    <?php wp_head() // Above style.css, because of Symple Style ?>
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet"> 
    <?php if ( of_get_option('custom_bg') || of_get_option('custom_header') || of_get_option('custom_footer')) { ?>
    <style type="text/css">
        <?php 
        $background = of_get_option('custom_bg');
        if ($background['color'] || $background['image']) {
            echo 'body {';
            if ($background['color']) {   
                echo '
                background: ' .$background['color']. ';';
            }
            if ($background['image']) {
                echo '
                background: url('.$background['image']. ') ';
                echo ''.$background['repeat']. ' ';
                echo ''.$background['position']. ' ';
                echo ''.$background['attachment']. ';';
            } 
            echo '
            }';
        }
        $header = of_get_option('custom_header');
        if ($header['color'] || $header['image']) {
            echo '.navbar-inner {';
            if ($header['color']) {   
                echo '
                background: ' .$header['color']. ';';
            }
            if ($header['image']) {
                echo '
                background: url('.$header['image']. ') ';
                echo ''.$header['repeat']. ' ';
                echo ''.$header['position']. ' ';
                echo ''.$header['attachment']. ';';
            } 
            echo '
            }';
        }
        $footer = of_get_option('custom_footer');
        if ($footer['color'] || $footer['image']) {
            echo 'footer {';
            if ($footer['color']) {   
             echo '
                background: ' .$footer['color']. ';';
            }
            if ($footer['image']) {
                echo '
                background: url('.$footer['image']. ') ';
                echo ''.$footer['repeat']. ' ';
                echo ''.$footer['position']. ' ';
                echo ''.$footer['attachment']. ';';
            } 
            echo '
            }';
        }
        ?>
        <?php if( of_get_option('custom_header_color') ) { ?>
        .navbar .nav > li > a, .navbar .nav > li, .navbar .nav > li > a:hover{
        color: <?php echo of_get_option('custom_header_color'); ?>;
        }
        .navbar .nav li.dropdown > .dropdown-toggle .caret
        {
        border-top-color: <?php echo of_get_option('custom_header_color'); ?>;
        border-bottom-color: <?php echo of_get_option('custom_header_color'); ?>;
        }
        <?php } ?>
        <?php if( of_get_option('custom_footer_color') ) { ?>
        footer .span4 a, footer .span4, .footer-title{
        color: <?php echo of_get_option('custom_footer_color'); ?>;
        }
        <?php } if( of_get_option('custom_css') ) { echo of_get_option('custom_css'); }?>   
    </style>
    <?php } ?>
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
<body>
  <div class="top-bar"></div>
  <div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="nav-collapse collapse">
            <?php wp_nav_menu( array( 
            'container' => 'div',
            'container_class' => 'nav-collapse collapse',
            'theme_location' => 'primary',
            'menu_class' => 'nav',
            'walker' => new Bootstrap_Walker(),                 
            ) );
            ?>
       <form class="navbar-search" method="get" action="<?php bloginfo('siteurl')?>/">
         <input type="text" name="s" id="s" class="pull-right" placeholder="Search..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
       </form>
        </div>
      </div>
    </div>
  </div>
  <?php if( of_get_option('custom_logo') ) { ?>
  <header>
    <div class="logo"><img src="<?php echo of_get_option('custom_logo') ?>"></div>
  </header>
  <?php } ?>
<div class="container">