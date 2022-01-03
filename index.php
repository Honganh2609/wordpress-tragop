<?php
/**
* Plugin Name: Trả Góp
* Plugin URI: https://phongbv378846040.wordpress.com/
* Description: Trả góp qua thẻ hoặc công ty tài chính.
* Version: 0.1
* Author: Bùi Văn Phong
* Author URI: https://phongbv378846040.wordpress.com/
**/

add_filter( 'plugin_row_meta', 'custom_plugin_row_meta', 10, 2 );
function custom_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'index.php' ) !== false ) {
		$new_links = array(
			'<a href="https://phongbv378846040.wordpress.com/ung-ho-coc-ca-phe-nhe/" target="_blank" style="color:green">Ủng hộ cốc cà phê nhé</a>'
			);
		$links = array_merge( $links, $new_links );
	}
	return $links;
}

function phongbv_tragop($content) {
	include 'main.php';
	$content = '';
	return $content;
}
add_shortcode( 'install_tragop', 'phongbv_tragop' );

function add_script_css_styles() {
	wp_register_style('css_styles', plugins_url('tragop.css', __FILE__));
	wp_enqueue_style('css_styles');
	
	wp_register_script('script', plugins_url('tragop.js', __FILE__));
	wp_enqueue_script('script');
}
add_action('wp_footer', 'add_script_css_styles');

function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

// Our custom post type function
function create_posttype() {
 
    register_post_type( 'tragop',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Đơn mua trả góp' ),
                'singular_name' => __( 'Đơn mua trả góp' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'tragop'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
/*
// phpmailer_init
function my_phpmailer_example( $phpmailer ) {
    $phpmailer->isSMTP();     
    $phpmailer->Host = 'smtp.example.com';
    $phpmailer->SMTPAuth = true; // Ask it to use authenticate using the Username and Password properties
    $phpmailer->Port = 25;
    $phpmailer->Username = 'yourusername';
    $phpmailer->Password = 'yourpassword';
 
    // Additional settings…
    //$phpmailer->SMTPSecure = 'tls'; // Choose 'ssl' for SMTPS on port 465, or 'tls' for SMTP+STARTTLS on port 25 or 587
    //$phpmailer->From = "you@yourdomail.com";
    //$phpmailer->FromName = "Your Name";
}
add_action( 'phpmailer_init', 'my_phpmailer_example' );
*/