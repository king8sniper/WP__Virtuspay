<?php
	
	include_once('../../../wp-load.php');
	require_once('../../../wp-config.php');
	require_once('vendor/autoload.php');

	global $wpdb;

	if(isset($_POST['vrtlink']) && $_POST['vrtlink'] == 'save_payment_link') {

		$wpdb->insert('wp_pay_link', array(
		    'product_name' 		    => 			$_POST['product_name'],
		    'price' 				=> 			$_POST['price'],
		    'currency' 				=> 			$_POST['currency'],
			'address'				=>			$_POST['address'],
		    'phone_number' 			=> 			$_POST['phone_number'],
		    'email' 				=> 			$_POST['email'],
		    'link_url' 				=> 			$_POST['link_url'],
            'virtuspay_link' 	    => 			$_POST['vrt_link'],
		));
		
		exit;
	}

?>
