<?php

/* Post Types */

//Slider
$prefix = 'cpt_';

$cpt_meta_box_post_settings = array(
	'id' => 'cpt-post-meta-box-slider',
	'title' =>  __('Post Settings', 'blogzine'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
            'name' => __('Sound cloud', 'cpt'),
            'id' => $prefix . 'post_soundcloud',
			'desc' => __('Enter the url for your Soundcloud audio for your audio post format.', 'cpt'),
			'std' => '',
            'type' => 'text',
        ),
		array(
            'name' => __('Quote Post', 'cpt'),
            'id' => $prefix . 'post_quote',
			'desc' => __('Enter the quotation you wanna enter.', 'cpt'),
			'std' => '',
            'type' => 'text',
        ),
		array(
            'name' => __('Video Format Embed', 'cpt'),
            'id' => $prefix . 'post_video',
            'desc' =>  __('Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature.', 'cpt') .' <a href="http://codex.wordpress.org/Embeds" target="_blank">'. __('Learn More', 'cpt'),
			'std' => '',
            'type' => 'text',
        ),
	),
);

add_action('admin_menu', 'cpt_add_box_post_settings');

function cpt_add_box_post_settings() {
	global $cpt_meta_box_post_settings;
	
	add_meta_box($cpt_meta_box_post_settings['id'], $cpt_meta_box_post_settings['title'], 'cpt_show_box_post_settings', $cpt_meta_box_post_settings['page'], $cpt_meta_box_post_settings['context'], $cpt_meta_box_post_settings['priority']);

}


function cpt_show_box_post_settings() {
	global $cpt_meta_box_post_settings, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="cpt_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($cpt_meta_box_post_settings['fields'] as $field) {
		
		// get current post meta data & set default value if empty
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		if (empty ($meta)) {
			$meta = $field['std']; 
		}
		
		switch ($field['type']) {
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			

		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'cpt_save_data_post');

/*-----------------------------------------------------------------------------------*/
//	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function cpt_save_data_post($post_id) {
	global $cpt_meta_box_post_settings;
	
	if(!isset($_POST['cpt_meta_box_nonce'])) $_POST['cpt_meta_box_nonce'] = "undefine";
 
	// verify nonce
	if (!wp_verify_nonce($_POST['cpt_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	//Save fields
	foreach ($cpt_meta_box_post_settings['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}

// Slider

	   add_action('init', 'create_slider');
	     function create_slider() {
	       $slider_args = array(
	          'labels' => array(
	           'name' => __( 'Slider Item' ),
	           'singular_name' => __( 'Slider Item' ),
	           'add_new' => __( 'Add New Slider Item' ),
	           'add_new_item' => __( 'Add New Slider Item' ),
	           'edit_item' => __( 'Edit Slider Item' ),
	           'new_item' => __( 'Add New Slider Item' ),
	           'view_item' => __( 'View Slider Item' ),
	           'search_items' => __( 'Search Slider Items' ),
	           'not_found' => __( 'No slider item found' ),
	           'not_found_in_trash' => __( 'No slider items found in trash' )
	         ),
	       'public' => true,
	       'show_ui' => true,
	       'capability_type' => 'post',
	       'hierarchical' => false,
	       'rewrite' => true,
	       'menu_position' => 20,
	       'supports' => array('title', 'editor', 'thumbnail')
	     );
	  register_post_type('slider',$slider_args);
	}
	add_filter("manage_slider_edit_columns", "slider_edit_columns");

	function slider_edit_columns($slider_columns){
	   $slider_columns = array(
	      "cb" => "<input type=\"checkbox\" />",
	      "title" => "Title",
	   );
	  return $slider_columns;
	}

	add_action( 'add_meta_boxes', 'cd_meta_box_add' );
	function cd_meta_box_add()
	{
		add_meta_box( 'my-meta-box-id', 'Link to Item', 'cd_meta_box_cb', 'slider', 'normal', 'high' );
	}

	function cd_meta_box_cb( $post )
	{
		$url = get_post_meta($post->ID, 'url', true);
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); ?>

		<p>
			<label for="url">Item url</label>
			<input type="text" name="url" id="url" value="<?php echo $url; ?>" style="width:350px" />
		</p>

		<?php	
	}
	
	add_action( 'save_post', 'cd_meta_box_save' );
	function cd_meta_box_save( $post_id )
	{
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

		if( !current_user_can( 'edit_post' ) ) return;

		$allowed = array( 
			'a' => array( 
				'href' => array() 
			)
		);

		if( isset( $_POST['url'] ) )
			update_post_meta( $post_id, 'url', wp_kses( $_POST['url'], $allowed ) );
	} 
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 280, 210, true ); // Normal post thumbnails
	add_image_size( 'screen-shot', 720, 540 ); // Full size screen
}

add_action('init', 'portfolio_register');  
  
function portfolio_register() {  
    $args = array(  
        'label' => __('Portfolio'),  
        'singular_label' => __('Project'),  
        'menu_position' => 20,
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
  
    register_post_type( 'portfolio' , $args );  
}  

register_taxonomy("project-type", array("portfolio"), array("hierarchical" => true, "label" => "Project Types", "singular_label" => "Project Type", "rewrite" => true));

add_action("admin_init", "portfolio_meta_box");   


function portfolio_meta_box(){  
    add_meta_box("projInfo-meta", "Project Options", "portfolio_meta_options", "portfolio", "side", "low");  
}  
  

function portfolio_meta_options(){  
        global $post;  
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);  
        $link = $custom["projLink"][0];  
?>  
    <label>Link:</label><input name="projLink" value="<?php echo $link; ?>" />  
<?php  
    }  
    
add_action('save_post', 'save_project_link'); 
  
function save_project_link(){  
    global $post;  
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ 
		return $post_id;
	}else{
    	update_post_meta($post->ID, "projLink", $_POST["projLink"]); 
    } 
}  

add_filter("manage_edit-portfolio_columns", "project_edit_columns");   
  
function project_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Project",  
            "description" => "Description",  
            "link" => "Link",  
            "type" => "Type of Project",  
        );  
  
        return $columns;  
}  

add_action("manage_posts_custom_column",  "project_custom_columns"); 
  
function project_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
            case "description":  
                the_excerpt();  
                break;  
            case "link":  
                $custom = get_post_custom();  
                echo $custom["projLink"][0];  
                break;  
            case "type":  
                echo get_the_term_list($post->ID, 'project-type', '', ', ','');  
                break;  
        }  
}
?>