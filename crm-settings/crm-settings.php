<?php

/**
 * WordPress CRM Settings demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('WeDevs_Settings_API_Test' ) ):
class WeDevs_Settings_API_Test {

    private $settings_api;

    public function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    public function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    public function admin_menu() {
        add_options_page( 'CRM Settings', 'CRM Settings', 'manage_options', 'crm-settings', array($this, 'crm_settings_page') );
    }

    public function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'notification_settings',
                'title' => __( 'Notifications', 'hetas-crm-admin-settings' )
            ),
            array(
                'id'    => 'other_settings',
                'title' => __( 'Other Settings', 'hetas-crm-admin-settings' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    public function get_settings_fields() {
        $settings_fields = array(
            'notification_settings' => array(
                array(
                    'name'    => 'notification_submissions',
                    'label'   => __( 'Notification Submissions', 'hetas-crm-admin-settings' ),
                    'desc'    => __( 'Enable/Disable front end Notification Submissions', 'hetas-crm-admin-settings' ),
                    'type'    => 'radio',
                    'options' => array(
                        'enable_all' => 'Enabled for all',
                        'disable_all' => 'Disabled for all',
                    ),
                    'default' => 'enable_all',
                ),
                array(
                    'name' => 'notification_message',
                    'label' => __( 'Disabled Message', 'hetas-crm-admin-settings' ),
                    'desc' => __( 'Message to show when Notifications NOT Enabled for all', 'hetas-crm-admin-settings' ),
                    'type' => 'textarea'
                )
            ),
            // 'other_settings' => array(
            //     array(
            //         'name'    => 'color',
            //         'label'   => __( 'Color', 'hetas-crm-admin-settings' ),
            //         'desc'    => __( 'Color description', 'hetas-crm-admin-settings' ),
            //         'type'    => 'color',
            //         'default' => ''
            //     ),
            //     array(
            //         'name'    => 'password',
            //         'label'   => __( 'Password', 'hetas-crm-admin-settings' ),
            //         'desc'    => __( 'Password description', 'hetas-crm-admin-settings' ),
            //         'type'    => 'password',
            //         'default' => ''
            //     ),
            //     array(
            //         'name'    => 'multicheck',
            //         'label'   => __( 'Multile checkbox', 'hetas-crm-admin-settings' ),
            //         'desc'    => __( 'Multi checkbox description', 'hetas-crm-admin-settings' ),
            //         'type'    => 'multicheck',
            //         'default' => array('one' => 'one', 'four' => 'four'),
            //         'options' => array(
            //             'one'   => 'One',
            //             'two'   => 'Two',
            //             'three' => 'Three',
            //             'four'  => 'Four'
            //         )
            //     ),
            // )
        );

        return $settings_fields;
    }

    public function crm_settings_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    public function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
