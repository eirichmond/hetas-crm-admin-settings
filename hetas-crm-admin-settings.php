<?php
/**
 * Plugin Name:     Hetas Crm Admin Settings
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     hetas-crm-admin-settings
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Hetas_Crm_Admin_Settings
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once dirname( __FILE__ ) . '/src/class.settings-api.php';
require_once dirname( __FILE__ ) . '/crm-settings/crm-settings.php';

new WeDevs_Settings_API_Test();

/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 *
 * @return mixed
 */
function prefix_get_option( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
}