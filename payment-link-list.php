<?php
/* 
Plugin Name: Payment Link List
Plugin URI: https://localhost/wordpress/ 
Description: A plugin to create payment list.
Author: Sn!per
Version: 1.0 
Author URI: https://localhost/wordpress/ 
*/    

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


// ----------  Create Table  ------------- //
    require_once('createTable.php');



    $base_url = get_home_url()."/";
    $local_url = "http://localhost/virtuspay/";

    function load_payment_link_list()  {
		require_once('main.php');
	}
    
    function payment_link_list_menu() {
        $menu_slug = 'payment-link-list';
    	
        add_menu_page('PaymentLink', 'Payment Link', 'manage_options', $menu_slug, 'load_payment_link_list', "dashicons-admin-links"); 
        
    }
    add_action( 'admin_menu', 'payment_link_list_menu' );
