<?php 

//Including Optionsframework

if ( !function_exists( 'optionsframework_init' ) ) { 
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/' ); 
	require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php'; 
}

//Requires

require( get_template_directory() . '/inc/nav-bar.php' );
require( get_template_directory() . '/inc/tgm-required-plugins.php' );
require( get_template_directory() . '/inc/options-framework/class-tgm-plugin-activation.php' );
require( get_template_directory() . '/inc/sidebar.php' );
require( get_template_directory() . '/inc/post-types.php' );
require( get_template_directory() . '/widgets/author-data.php' ); 
if ( of_get_option('gwf') ){
require( get_template_directory() . '/inc/gwf-options.php' );
}
//Including the scripts

function scripts_jquery()
{
	wp_deregister_script( 'jquery');
	wp_register_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', __FILE__ );
	wp_register_script( 'plugins', get_template_directory_uri() . '/assets/js/plugins.js', __FILE__ );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'plugins' );
}
add_action( 'wp_enqueue_scripts', 'scripts_jquery' );

//Adding Post types, Post thumbnail & Rss Feeds Link(To the header)

if (function_exists('add_theme_support')) {
	add_theme_support( 'post-formats', array( 'video', 'quote', 'audio' ) );
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
}

//Adding Filters

function user_options($profile_fields) {
	$profile_fields['twitter'] = 'Twitter Username';
	$profile_fields['facebook'] = 'Facebook URL';
	$profile_fields['gplus'] = 'Google+ URL';
	return $profile_fields;
}
function new_excerpt_length($length) { 
	if( of_get_option('excerpt_limit') ){
    return of_get_option('excerpt_limit');
    } else {
    return 20;
    } 
}
function twtreplace($content) {
	$twtreplace = preg_replace('/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/',"$1<a href=\"http://twitter.com/$2\" target=\"_blank\" rel=\"nofollow\">@$2</a>",$content);
	return $twtreplace;
}
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
class custom_comments {
function custom_comments_text($translation, $text, $domain) {
     $new_says = '';
     $translations = &get_translations_for_domain( $domain );
     if ( $text == '<cite class="fn">%s</cite> <span class="says">says:</span>' ) {
     if($new_says) $new_says = ' '.$new_says;
     return $translations->translate( '<cite class="fn">%s</cite><span class="says">'.$new_says.':</span>' );
     } else {
     return $translation;
      }  
     }
}
function excerpt_more($more) {
		global $post;
		return ' ...';
}
add_filter('gettext', array('custom_comments', 'custom_comments_text'), 10, 4);
add_filter('the_content', 'twtreplace');   
add_filter('comment_text', 'twtreplace');
add_filter('widget_text', 'do_shortcode');
add_filter('excerpt_length', 'new_excerpt_length');
add_action( 'init', 'my_add_excerpts_to_pages' );
add_filter('user_contactmethods', 'user_options');
add_filter('excerpt_more', 'excerpt_more');

function portfolio_thumbnail_url($pid){
	$image_id = get_post_thumbnail_id($pid);  
	$image_url = wp_get_attachment_image_src($image_id,'screen-shot');  
	return  $image_url[0];  
}

//Menus

function register_my_menus() {
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'blogzine' ),
	) );
}
add_action( 'after_setup_theme', 'register_my_menus' );
?>