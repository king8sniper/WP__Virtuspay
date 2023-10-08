<?php
    function create_tables(){
        global $wpdb;

        $table_name = $wpdb->prefix. 'pay_link';
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            product_name varchar(100) NOT NULL,
            price varchar(100) NOT NULL,
            currency varchar(50) NOT NULL,
            address varchar(100) NULL, 
            phone_number varchar(100) NOT NULL,
            email varchar(255) NOT NULL,
            link_url varchar(255) NOT NULL,
            virtuspay_link varchar(255) NOT NULL,
            PRIMARY KEY  (id)
        );";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

    }

    add_action('init', 'create_tables');

    // echo "------------------------------------";

?>
