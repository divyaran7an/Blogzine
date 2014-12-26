<?php

//Sidebar 

if (function_exists('register_sidebar')) {
	register_sidebar(
		array(
			'name' => __('Sidebar', 'blogzine'),
			'id' => 'page-sidebar',
			'description' => __('This is the page sidebar', 'blogzine'),
			'before_widget' => '<div class="widget %2$s widget-default">',
			'after_widget' => '</div>',
		    'before_title' => '<h3 class="title">',
		    'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Left Footer Widget Area', 'blogzine'),
			'id' => 'left-footer',
			'description' => __('The Footer area 1 area', 'blogzine'),
			'before_widget' => '<div class="widget %2$s widget-default">',
			'after_widget' => '</div>',
		    'before_title' => '<h3 class="title footer-title">',
		    'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Mid Footer Widget Area', 'blogzine'),
			'id' => 'mid-footer',
			'description' => __('The right footer area', 'blogzine'),
			'before_widget' => '<div class="widget %2$s widget-default">',
			'after_widget' => '</div>',
		    'before_title' => '<h3 class="title footer-title">',
		    'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Right Footer Widget Area', 'blogzine'),
			'id' => 'right-footer',
			'description' => __('The right footer area', 'blogzine'),
			'before_widget' => '<div class="widget %2$s widget-default">',
			'after_widget' => '</div>',
		        'before_title' => '<h3 class="title footer-title">',
		        'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __('Post Bottom Widget Area', 'blogzine'),
			'id' => 'post-bottom',
			'description' => __('Post Bottom Widget Area', 'blogzine'),
			'before_widget' => '',
			'after_widget' => '',
		    'before_title' => '<h1>',
		    'after_title' => '</h1>',
		)
	);
	register_sidebar(
		array(
			'name' => __('After Post Widget Area', 'blogzine'),
			'id' => 'after-post',
			'description' => __('After Post Widget Area', 'blogzine'),
			'before_widget' => '<div class="after-post-widget-box">',
			'after_widget' => '</div>',
		    'before_title' => '<h1>',
		    'after_title' => '</h1>',
		)
	);
}