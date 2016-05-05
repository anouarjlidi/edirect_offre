<?php

/*
Plugin Name: Edirect Offre
Plugin URI: http://edirect-tunisie.com
Description: Edirect Offre.
Version: 1.0
Author: JLIDI ANOUAR
Author URI: http://edirect-tunisie.com
License: A "Slug" license name e.g. GPL2
*/


if (!defined('ABSPATH'))
    exit;

register_activation_hook(__FILE__, 'edirect_offre_install');
register_uninstall_hook(__FILE__, 'edirect_offre_uninstall');


require_once('classes/edoffre.class.php');


function instance_offre()
{
    $_instance_offre = EdOffre::instance(__FILE__);
  return $_instance_offre;
}

function edirect_offre_install()
{
    global $wpdb;
    require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

    $db_table_name = $wpdb->prefix . "edirect_offres";
    if ($wpdb->get_var("SHOW TABLES LIKE '$db_table_name'") != $db_table_name) {
        if (!empty($wpdb->charset))
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        if (!empty($wpdb->collate))
            $charset_collate .= " COLLATE $wpdb->collate";

        $sql = "CREATE TABLE $db_table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		nom VARCHAR(50) NOT NULL,
		nom_entreprise VARCHAR(50) NOT NULL,
		tel VARCHAR(30) NOT NULL,
		mobile VARCHAR(30) NOT NULL,
		email VARCHAR(50) NOT NULL,
		offre VARCHAR(30) NOT NULL,
		message TEXT NOT NULL,
		UNIQUE KEY id (id)
		) $charset_collate;";
        dbDelta($sql);

    }

    global $isInstalled;
    $isInstalled = true;
}



function edirect_offre_uninstall()
{
    global $wpdb;

    $table_name = $wpdb->prefix . "edirect_offres";
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

instance_offre();