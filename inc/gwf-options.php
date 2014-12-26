<?php
//////////////////////////////////////////////////////////////////////////////
// Create the Google Web Fonts Dashboard Menu
//////////////////////////////////////////////////////////////////////////////
function register_google_webfonts_menu(){
/* add main menu for GWF */
add_menu_page( 'Google Web Fonts', 'Google Web Fonts', 'manage_options', 'google-fonts-settings', 'wp_gwf_fonts_settings', get_template_directory_uri() . '/inc/google.png' , 25 );

/* add sub menu - settings for GWF */
add_submenu_page('google-fonts-settings', 'GWF Settings', 'GWF Settings Page', 'manage_options', 'google-fonts-settings', 'wp_gwf_fonts_settings');

/* add sub menu - updates for GWF */
add_submenu_page('google-fonts-settings', 'GWF Update', 'GWF Update Page', 'manage_options', 'google-fonts-update', 'wp_gwf_fonts_update');

}
add_action( 'admin_menu', 'register_google_webfonts_menu' );


//////////////////////////////////////////////////////////////////////////////
// Fetch the Google Web Fonts API list
//////////////////////////////////////////////////////////////////////////////
if( !function_exists('wp_get_google_webfonts_list') ):
function wp_get_google_webfonts_list($key='', $sort='') {
    /*
    $key = Web Fonts Developer API
    $sort=
    alpha: Sort the list alphabetically
    date: Sort the list by date added (most recent font added or updated first)
    popularity: Sort the list by popularity (most popular family first)
    style: Sort the list by number of styles available (family with most styles first)
    trending: Sort the list by families seeing growth in usage (family seeing the most growth first)
    */

$http = (!empty($_SERVER['HTTPS'])) ? "https" : "http";

$google_api_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=' . $key . '&sort=' . $sort;
//lets fetch it
$response = wp_remote_retrieve_body( wp_remote_get($google_api_url, array('sslverify' => false )));
if( is_wp_error( $response ) ) {
} else {
$data = json_decode($response, true);
$items = $data['items'];
foreach ($items as $item) {
$font_list[] .= $item['family'];
}
}
# Return the saved lit of Google Web Fonts
return $font_list;
}
endif;


////////////////////////////////////////////////////////////////////////////////
// get google web font for homepage
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'wp_gwf_header_init' ) ):
function wp_gwf_header_init(){

$http = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
$un_bodytype = get_option('_body_font');
$un_headtype = get_option('_headline_font');
$un_titletype = get_option('_title_font');
$bodytype = str_replace(' ' , '+', get_option('_body_font'));
$headtype = str_replace(' ' , '+', get_option('_headline_font'));
$titletype = str_replace(' ' , '+', get_option('_title_font'));
$font_var = '300,400,600,700,900,300italic,400italic,600italic,700italic,900italic';

if ( $bodytype != "" ){
echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $bodytype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
}

if ($headtype != ""){
echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $headtype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
}

if ($un_titletype != ""){
echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $titletype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
}

?>

<?php echo "<style type='text/css' media='all'>"; ?>
#respond, article.full-post-content, .comment-box, .comment-body, .after-post-widget-box, .page-content, ul.comments-display cite.fn .url, .page-body, .post-content .post-body { font-family: <?php echo get_option('_body_font'); ?> !important; }
h1,h2,h3,h4,h5,h6 { font-family: <?php echo get_option('_headline_font'); ?> !important; }
.post-content .title a, .title, article.full-post-content h1.title, .full-author-box h1.title, .title-portfolio a .results { font-family: <?php echo get_option('_title_font'); ?> !important; }
<?php echo "</style>"; ?>

<?php }

endif;
add_action('wp_head','wp_gwf_header_init');


////////////////////////////////////////////////////////////////////////////////
// get google web font for admin
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'wp_gwf_admin_header_init' ) ):
function wp_gwf_admin_header_init() {

if ( $_GET['page'] == 'google-fonts-settings' ) {  ?>

<script type="text/javascript">
jQuery(document).ready(function(){
jQuery("select#<?php echo '_body_font'; ?>, select#<?php echo '_headline_font'; ?>, select#<?php echo '_title_font'; ?>").change(function(){
var val = jQuery("select#<?php echo '_body_font'; ?>").val();
var val2 = jQuery("select#<?php echo '_headline_font'; ?>").val();
var val3 = jQuery("select#<?php echo '_title_font'; ?>").val();
//var valx = val.replace(/ /g, "+");
jQuery("#cFontStyleWColor11").text('#testtext<?php echo "_body_font"; ?> { font-size: 16px; font-family: "'+ val +'" !important; }');
jQuery("#cFontStyleWColor12").text('#testtext<?php echo "_headline_font"; ?> { font-size: 16px; font-family: "'+ val2 +'" !important; }');
jQuery("#cFontStyleWColor13").text('#testtext<?php echo "_title_font"; ?> { font-size: 16px; font-family: "'+ val3 +'" !important; }');

WebFontConfig = {
google: { families: [ ''+ val +'', ''+ val2 +'', ''+ val3 +'' ] }
};
(function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
});
});
</script>

<style id="cFontStyleWColor11" type="text/css"></style>
<style id="cFontStyleWColor12" type="text/css"></style>
<style id="cFontStyleWColor13" type="text/css"></style>

<?php
$http = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
$un_bodytype = get_option('_body_font');
$un_headtype = get_option('_headline_font');
$un_titletype = get_option('_title_font');
$bodytype = str_replace(' ' , '+', get_option('_body_font'));
$headtype = str_replace(' ' , '+', get_option('_headline_font'));
$titletype = str_replace(' ' , '+', get_option('_title_font'));
$font_var = '300,400,600,700,900,300italic,400italic,600italic,700italic,900italic';

if ( $bodytype != "" ){
echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $bodytype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
}
if ($headtype != ""){
echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $headtype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
}
if ($titletype != ""){
echo "<link href='" . $http . "://fonts.googleapis.com/css?family=" . $titletype . ":" . $font_var . "' rel='stylesheet' type='text/css'>";
}
?>

<?php echo "<style type='text/css' media='all'>"; ?>
<?php if( get_option('_body_font') ): ?>
#testtext<?php echo "_body_font"; ?> {
font-size: 16px; font-family: <?php echo get_option('_body_font'); ?>;
}
<?php endif; ?>

<?php if( get_option('_headline_font') ): ?>
#testtext<?php echo "_headline_font"; ?> {
font-size: 16px; font-family: <?php echo get_option('_headline_font'); ?>;
}
<?php endif; ?>

<?php if( get_option('_title_font') ): ?>
#testtext<?php echo "_title_font"; ?> {
font-size: 16px; font-family: <?php echo get_option('_title_font'); ?>;
}
<?php endif; ?>
<?php echo "</style>"; ?>

<?php } }

endif;

add_action('admin_head','wp_gwf_admin_header_init');


////////////////////////////////////////////////////////////////////////////////
// Create the settings page for GWF
////////////////////////////////////////////////////////////////////////////////
$get_font_transiet = get_transient( 'wp_gwf_list_save' );

$gwf_options = array (

array(
"header-title" => __("Google Web Fonts Settings", TEMPLATE_DOMAIN),
"name" => __("Body Font", TEMPLATE_DOMAIN),
    "description" => __("Choose a font for the body text.", TEMPLATE_DOMAIN),
    "id" => "_body_font",
    "type" => "select",
    "options" => $get_font_transiet,
    "default" => ""),

array(
"name" => __("Title Font", TEMPLATE_DOMAIN),
    "description" => __("Choose a font for the title of the posts and pages.", TEMPLATE_DOMAIN),
    "id" => "_title_font",
    "type" => "select",
    "options" => $get_font_transiet,
    "default" => ""),

array(
"name" => __("Headline Font", TEMPLATE_DOMAIN),
    "description" => __("Choose a font for the headline h1,h2,h3,h4,h5,h6 text.", TEMPLATE_DOMAIN),
    "id" => "_headline_font",
    "type" => "select",
    "options" => $get_font_transiet,
    "default" => ""),

);


function wp_gwf_fonts_settings() {
global $get_font_transiet, $gwf_options;
if ( $_GET['page'] == 'google-fonts-settings' ) {

if ( 'save' == $_REQUEST['action'] ) {
foreach ($gwf_options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] );
}
foreach ($gwf_options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'],  $_REQUEST[ $value['id'] ] ); } else { delete_option( $value['id'] ); }
}

echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='". admin_url('/'). "admin.php?page=google-fonts-settings&saved=true" . "';
</script>";


} else if( 'reset' == $_REQUEST['action'] ) {

foreach ($gwf_options as $value) {
delete_option( $value['id'] );
}

echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='". admin_url('/'). "admin.php?page=google-fonts-settings&reset=true" . "';
</script>";

}

}
?>

<div id="custom-theme-option" class="wrap">
<?php screen_icon('upload'); echo "<h2>" .  __( 'GW Fonts Options', TEMPLATE_DOMAIN ) . "</h2>"; ?>
<?php
if ( $_REQUEST['saved'] ) echo '<div class="updated fade"><p><strong>'.  __('GWF settings saved.', TEMPLATE_DOMAIN) . '</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div class="updated fade"><p><strong>'.  __('GWF settings reset.', TEMPLATE_DOMAIN) . '</strong></p></div>';

if($get_font_transiet == FALSE):
echo '<div class="updated fade"><p><strong>'.  __('You need to update or save the google font list first.', TEMPLATE_DOMAIN) . '</strong></p></div>';
else:
?>

<form id="wp-theme-options" method="post" action="" enctype="multipart/form-data">

<table class="form-table">

<?php foreach ($gwf_options as $value) { ?>

<?php if ( $value['header-title'] != "" ) { ?>
<tr class="trtitle" valign="top"><th scope="row">
<h3><?php echo stripslashes($value['header-title']); ?></h3></th></tr>
<?php } ?>


<?php if ( $value['type'] == "select" ) { ?>

<tr class="<?php echo $value['hide_blk']; ?>" valign="top"><th scope="row"><?php echo $value['name']; ?></th>
<td>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ( $value['options'] as $option ) { ?>
<option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['default']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
<?php } ?>
</select>
<div style="border:1px solid #ddd;margin:20px 0 0;width:400px;padding:20px;background:#f8f8f8;" class="testtextbox" id="testtext<?php echo $value['id']; ?>">The Quick Brown Fox Jumps Over The Lazy Dog. 1234567890</div>
<br />
<label class="description" for="<?php echo $value['id']; ?>"><?php echo $value['description']; ?></label>
</td>
</tr>

<?php } ?>



<?php } ?>
</table>

<div style="float: left; margin: 20px 40px 0 0;" class="submit">
<input name="save" type="submit" class="button-primary sbutton" value="<?php echo esc_attr(__('Save Setting',TEMPLATE_DOMAIN)); ?>" /><input type="hidden" name="action" value="save" />
</div>
</form>

<form method="post">
<div style="float: left; margin: 20px 40px 0 0;" class="submit">
<?php
$alert_message = __("Are you sure you want to delete the fonts options?.", TEMPLATE_DOMAIN ); ?>
<input name="reset" type="submit" class="button-secondary" onclick="return confirm('<?php echo $alert_message; ?>')" value="<?php echo esc_attr(__('Reset Setting',TEMPLATE_DOMAIN)); ?>" />
<input type="hidden" name="action" value="reset" />
</div>
</form>

</div>

<?php endif; }




function wp_gwf_fonts_update() {
global $get_font_transiet;
?>
<div id="custom-theme-option" class="wrap">
<?php screen_icon('upload'); echo "<h2>" .  __('Google Web Fonts Family', TEMPLATE_DOMAIN ) . "</h2>";
if ( $_REQUEST['saved'] ) {
echo '<div class="updated fade"><p><strong>'.  __('Google Web Fonts Family Successfully Updated.', TEMPLATE_DOMAIN) . '</strong></p></div>';
}
?>

<form id="wp-theme-options" method="post" action="" enctype="multipart/form-data">
<?php
//register the $_POST variable
$gwf_font_api = $_POST['google-font-dev-api'];
$gwf_font_sort = $_POST['google-font-sort'];

//if save button hit
if( $_POST['save']  ) {

//if no dev font api set
if( !isset($gwf_font_api) ):
echo '<div class="error"><p><strong>'.  __('Google Web Fonts API not set.', TEMPLATE_DOMAIN) . '</strong></p></div>';
endif;

update_option('google-font-sort',$gwf_font_sort);
update_option('google-font-api',$gwf_font_api);

$get_gwf_font_api = get_option('google-font-sort');
$get_gwf_font_api = get_option('google-font-api');
$fontlist = wp_get_google_webfonts_list($gwf_font_api, $gwf_font_sort);

// delete and renew transient for font list
delete_transient( 'wp_gwf_list_save' );
set_transient( 'wp_gwf_list_save', $fontlist );

// save and store the transient and redirect
echo "<SCRIPT LANGUAGE='JavaScript'>
window.location='". admin_url('/'). "admin.php?page=google-fonts-update&update=true" . "';
</script>";

}


if( $get_font_transiet == FALSE ):
echo '<div class="updated fade"><p><strong>'.  __('You need to update or save the google font list first.', TEMPLATE_DOMAIN) . '</strong></p></div>'; ?>

<?php else: ?>

<table class="form-table">
<h3><?php echo count($get_font_transiet); ?> <?php _e('available Google Web Fonts', TEMPLATE_DOMAIN); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><a href="#google-font-dev-api">Update the font family below</a></small></h3>
<tr valign="top">
<td>
<?php
foreach($get_font_transiet as $font): ?>
<?php echo '<p style="width:250px;height:30px;float:left;margin:0;">'. ucfirst($font) . '</p>'; ?>
<?php endforeach; ?>
</td>
</tr>
</table>

<?php endif; ?>

<div style="float: left; margin: 40px 20px 0 0;" class="submit">

<label><strong><?php _e('Enter Your Web Fonts Developer API', TEMPLATE_DOMAIN); ?></strong></label>&nbsp;&nbsp;
<input style="width:300px;" id="google-font-dev-api" name="google-font-dev-api" type="text" value="<?php echo get_option('google-font-api'); ?>" />
&nbsp;&nbsp;&nbsp;<label><strong><?php _e('Sort by', TEMPLATE_DOMAIN); ?></strong></label>&nbsp;&nbsp;<select id="google-font-sort" name="google-font-sort">
<option<?php if ( get_option('google-font-sort') == 'alpha') { echo ' selected="selected"'; } ?>>alpha</option>
<option<?php if ( get_option('google-font-sort') == 'date') { echo ' selected="selected"'; } ?>>date</option>
<option<?php if ( get_option('google-font-sort') == 'popularity') { echo ' selected="selected"'; } ?>>popularity</option>
<option<?php if ( get_option('google-font-sort') == 'style') { echo ' selected="selected"'; } ?>>style</option>
<option<?php if ( get_option('google-font-sort') == 'trending') { echo ' selected="selected"'; } ?>>trending</option>
</select>&nbsp;&nbsp;&nbsp;
</div>

<div style="float: left; margin: 40px 10px 0 0;" class="submit">
<input name="save" type="submit" class="button-primary sbutton" value="<?php echo esc_attr(__('Update Fonts List',TEMPLATE_DOMAIN)); ?>" /><input type="hidden" name="action" value="save" />
</div>

<div style="color:#666;width:100%; float: left; margin: 0;" >
<small>Web Fonts Developer API Example: AIzaSyBmPRa5TGlBRbUUV-pVPU3GxXRkD4lBtUU<br /><br />
alpha: Sort the list alphabetically <br />
    date: Sort the list by date added (most recent font added or updated first) <br />
    popularity: Sort the list by popularity (most popular family first)
    style: Sort the list by number of styles available (family with most styles first) <br />
    trending: Sort the list by families seeing growth in usage (family seeing the most growth first)
</small>
</div>

</form>

</div>

<?php } ?>