<?php
/**
 * Plugin Name: Profile Xtra
 * Description: Add some xtras to authoring profile: profile image, social media contact & alternative author.
 * Version: 1.0.0
 * Author: Ernesto Ortiz
 * Author URI:
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: profile-xtra
 * Domain Path: /languages
 */

// load plugin text domain
function profilextra_init() {
    load_plugin_textdomain( 'profile-xtra', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded', 'profilextra_init');

/** Enqueue styles & scripts **/
add_action('admin_enqueue_scripts', 'profilextra_backend_scripts');
add_action('wp_enqueue_scripts', 'profilextra_frontend_scripts');
function profilextra_frontend_scripts() {
    if(is_admin()) return;
    //xtra of social contacts is included
    $default = array('use_icons'=>'1');
    $options = wp_parse_args(get_option('profilextra_settings'), $default);
    if ($options['use_icons']*1 > 0)
        wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
    wp_enqueue_style('profilextra_style', plugins_url('/css/style.css',__FILE__));

}
function profilextra_backend_scripts() {
    if(!is_admin()) return;
    global $pagenow;
    $default =array('iprofile'=>'1','alterauthor'=>'0');
    $options = wp_parse_args(get_option('profilextra_settings'), $default);
    //profile & alter
    $_where ="idk";
    if (($pagenow=='post-new.php' || $pagenow=='post.php') && $options['alterauthor'])
        $_where = 'alter';
    if (($pagenow=='user-edit.php' || $pagenow=='profile.php') && $options['iprofile'])
        $_where = 'profile';
    if ($_where!='idk'):
        wp_enqueue_style('thickbox');
        wp_enqueue_media();
        add_thickbox();
        wp_register_script( 'profilextra_js', plugins_url('/js/profilextra.js',__FILE__), array('jquery'));
        wp_enqueue_script('profilextra_js');
    endif;
    //admin script & style
    wp_register_script( 'backend_js', plugins_url('/js/backend.js',__FILE__), array('jquery'));
    wp_enqueue_script('backend_js');
    wp_enqueue_style('profilextra_admin_style', plugins_url('/css/admin_style.css',__FILE__));
}


/** AJAX FUNCTIONS **/
include "ajaxes.php";

/** Alter Author **/
$default = array('alterauthor'=>'0');
$options = wp_parse_args(get_option('profilextra_settings'), $default);
if ($options['alterauthor'])
    include "alterauthor.php";


/** SHORTCODES **/
include "shortcodes.php";

/** OPTIONS PAGE **/
if (is_admin()) include "optionspage.php";


/** other FUNCTIONS **/
//get default settings if options not saved yet
/*** DEFAULT values ***/
function profilextra_get_options(){
    $options = get_option('profilextra_settings');
    $defaults = array(
        'iprofile' => '1',
        'twitter' => '1',
        'facebook' => '0',
        'google-plus' => '0',
        'linkedin' => '0',
        'xsep' => ' | ',
        'use_icons' => '1',
        'use_name'  => '1',
    );
    $options = wp_parse_args(get_option('profilextra_settings'), $defaults);
    return $options;
}
//update meta user
add_action('personal_options_update', 'profilextra_update_fields');
add_action('edit_user_profile_update', 'profilextra_update_fields');
function profilextra_update_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    //update xtra profiles
    $id = absint($user_id);
    update_usermeta($id, 'profilextra_imgsrc', wp_kses_post($_POST['profilextra_imgsrc']));
    if(!isset($_POST['profilextra_avatar'])):
        update_usermeta($id, 'profilextra_avatar','avatar');
    else:
        update_usermeta($id, 'profilextra_avatar','not');
    endif;
}

//get images or avatars on users.php
global $pagenow;
if ("users.php" == $pagenow)
    if (get_option('show_avatars'))
        add_filter( 'get_avatar', 'profilextra_user_image', 10, 6);
function profilextra_user_image($avatar, $id, $size = '96', $default='', $alt='', $args=array()) {
    $noavatar = get_user_meta($id, 'profilextra_avatar',true);
    $imgsrc = get_user_meta($id, 'profilextra_imgsrc',true);
    if ($noavatar=="not")
        $avatar = "<img src='". $imgsrc ."' style='width:".$size."px;height:auto;' />";
    return $avatar;
}

//add other contact information
add_filter( 'user_contactmethods', 'profilextra_social_contact' );
function profilextra_social_contact( $fields ) {
    /* get options */
    $options = profilextra_get_options();
    //$options = wp_parse_args(get_option('profilextra_settings'), profilextra_defaults());
    if ($options['twitter'])
        $fields['twitter'] 	= esc_html__('Twitter', 'profile-xtra');
    if ($options['facebook'])
        $fields['facebook']	= esc_html__('Facebook', 'profile-xtra');
    if ($options['google-plus'])
        $fields['google-plus'] = esc_html__('Google +', 'profile-xtra');
    if ($options['linkedin'])
        $fields['linkedin']	= esc_html__('LinkedIn', 'profile-xtra');
    return $fields;
}

?>
