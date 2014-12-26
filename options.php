<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = 'options_minimalist_themes';
    update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();
	
	$options[] = array(
		'name' => __('General', 'options_framework_theme'),
		'type' => 'heading');
		
	$options['custom_logo'] = array(
		'name' => __('Custom Logo', 'options_framework_theme'),
		'desc' => __('Upload your custom logo.', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_logo',
		'type' => 'upload');
		
	$options['custom_favicon'] = array(
		'name' => __('Custom Favicon', 'options_framework_theme'),
		'desc' => __('Upload your custom site favicon.', 'options_framework_theme'),
		'id' => 'custom_favicon',
		'type' => 'upload');
    
    $options['excerpt_limit'] = array(
		'name' => __('Excerpt Length', 'options_framework_theme'),
		'desc' => __('No of words you want to show on the pages which are not showing the full post.', 'options_framework_theme'),
		'std' => '20',
		'id' => 'excerpt_limit',
		'type' => 'text');

	$options[] = array(
		'name' => __('Pages Options', 'options_framework_theme'),
		'type' => 'heading');

    $options['map-url'] = array(
    	'name' => __('Google Map URL', 'options_framework_theme'),
		'desc' => __('Paste your Google Map URL here(Only Paste the link from the embed code). NOTE: For copying the embed link all you have to do is to copy the Link which is inside the embed code so you have to copy the link that starts after src (src=") and ends at a ".', 'options_framework_theme'),
		'id' => 'map-url',
		'type' => 'text');

    $options['contact-email'] = array(
    	'name' => __('Contact email.', 'options_framework_theme'),
		'desc' => __('Write your Contact email here.', 'options_framework_theme'),
		'id' => 'contact-email',
		'type' => 'text');

    $options['page-404-title'] = array(
    	'name' => __('404 Page Title', 'options_framework_theme'),
		'desc' => __('Title of your 404 Error Page(Default is 404).', 'options_framework_theme'),
		'id' => 'title-404',
		'type' => 'text');

    $options['page-404-text'] = array(
    	'name' => __('404 Page Text', 'options_framework_theme'),
		'desc' => __('Text that you want to display at your 404 Error Page.', 'options_framework_theme'),
		'id' => 'page-404-text',
		'type' => 'textarea');

    $options['slider'] = array(
		'name' => __('Include slider?', 'options_framework_theme'),
		'desc' => __('Check box to enable the slider section in the template.', 'options_framework_theme'),
		'id' => 'slider',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Design', 'options_framework_theme'),
		'type' => 'heading');	
		
    $options['gwf'] = array(
		'name' => __('Include Google Fonts?', 'options_framework_theme'),
		'desc' => __('Check box to enable Google fonts in the template(After enabling click on "Google Web Fonts" in the left sidebar).', 'options_framework_theme'),
		'id' => 'gwf',
		'std' => '1',
		'type' => 'checkbox');

	$options['custom_bg'] = array(
		'name' => __('Background Customization', 'options_framework_theme'),
		'desc' => __('Customize background color and image', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_bg',
		'type' => 'background');

	$options['custom_header'] = array(
		'name' => __('Header Customization', 'options_framework_theme'),
		'desc' => __('Customize header color and image', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_header',
		'type' => 'background');

	$options['custom_header_color'] = array(
		'desc' => __('Customize header Text color', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_header_color',
		'type' => 'color');

	$options['custom_footer'] = array(
		'name' => __('Footer Customization', 'options_framework_theme'),
		'desc' => __('Customize footer color and image', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_footer',
		'type' => 'background');

	$options['custom_footer_color'] = array(
		'desc' => __('Customize footer Text color', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_footer_color',
		'type' => 'color');

	$options['custom_css'] = array(
		'name' => __('Add Custom CSS Codes', 'options_framework_theme'),
		'std' => '',
		'id' => 'custom_css',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('SEO', 'options_framework_theme'),
		'type' => 'heading');

    $options['meta_description'] = array(
		'name' => __('Meta Data', 'options_framework_theme'),
		'desc' => __('Write your meta description here.', 'options_framework_theme'),
		'id' => 'meta_description',
		'type' => 'text');

    $options['meta_keywords'] = array(
		'desc' => __('Write your meta keywords here.', 'options_framework_theme'),
		'id' => 'meta_keywords',
		'type' => 'text');

    $options['analytics'] = array(
		'name' => __('Tracking Script', 'options_framework_theme'),
		'desc' => __('Write your tracking script here.', 'options_framework_theme'),
		'id' => 'analytics',
		'type' => 'textarea');

    $options[] = array(
		'name' => __('Social', 'options_framework_theme'),
		'type' => 'heading');
    
    $options['fb-icon'] = array(
		'name' => __('Facebook', 'options_framework_theme'),
		'desc' => __("You're facebook profile link goes here.", 'options_framework_theme'),
		'id' => 'fb-icon',
		'type' => 'text');

    $options['tw-icon'] = array(
		'name' => __('Twitter', 'options_framework_theme'),
		'desc' => __("You're twitter profile link goes here.", 'options_framework_theme'),
		'id' => 'tw-icon',
		'type' => 'text');

    $options['g-icon'] = array(
		'name' => __('Google Plus', 'options_framework_theme'),
		'desc' => __("You're google plus profile link goes here.", 'options_framework_theme'),
		'id' => 'g-icon',
		'type' => 'text');

    $options['in-icon'] = array(
		'name' => __('Instagram', 'options_framework_theme'),
		'desc' => __("You're instagram profile link goes here.", 'options_framework_theme'),
		'id' => 'in-icon',
		'type' => 'text');

    $options['y-icon'] = array(
		'name' => __('Youtube', 'options_framework_theme'),
		'desc' => __("You're youtube channel's link goes here.", 'options_framework_theme'),
		'id' => 'y-icon',
		'type' => 'text');

    $options['db-icon'] = array(
		'name' => __('Dribbble', 'options_framework_theme'),
		'desc' => __("You're Dribbble profile link goes here.", 'options_framework_theme'),
		'id' => 'db-icon',
		'type' => 'text');

    $options['fl-icon'] = array(
		'name' => __('Flickr', 'options_framework_theme'),
		'desc' => __("You're flickr link goes here.", 'options_framework_theme'),
		'id' => 'fl-icon',
		'type' => 'text');

    $options['tb-icon'] = array(
		'name' => __('Tumblr', 'options_framework_theme'),
		'desc' => __("You're tumblr link goes here.", 'options_framework_theme'),
		'id' => 'tb-icon',
		'type' => 'text');

    $options['tb-icon'] = array(
		'name' => __('Tumblr', 'options_framework_theme'),
		'desc' => __("You're tumblr link goes here.", 'options_framework_theme'),
		'id' => 'tb-icon',
		'type' => 'text');

    $options['gh-icon'] = array(
		'name' => __('Github', 'options_framework_theme'),
		'desc' => __("You're github link goes here.", 'options_framework_theme'),
		'id' => 'gh-icon',
		'type' => 'text');
	return $options;
}


/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php } ?>