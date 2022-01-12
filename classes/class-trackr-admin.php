<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wecodify.co/
 * @since      1.0.0
 *
 * @package    Trackr
 * @subpackage Trackr/admin
 */

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Trackr
 * @subpackage Trackr/admin
 * @author     We Codify Co. <connect@wecodify.co>
 */
class Trackr_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Boot up the carbon fields library
     *
     * @since    1.0.0
     */
    public function load_carbon_fields() {
        // boot up the carbon fields library
        Carbon_Fields::boot();
    }

    /**
     * Adds the tracking data metabox to the shop order
     * screen.
     *
     * @since    1.0.0
     */
    public function register_plugin_metabox() {
        $fields = [
            Field::make('text', '_trackr_tracking_number', __('Tracking Number', $this->plugin_name)),
            Field::make('text', '_trackr_tracking_link', __('Tracking Link', $this->plugin_name)),
            Field::make('date', '_trackr_shipped_date', __('Shipped Date', $this->plugin_name)),
        ];
        Container::make('post_meta', __('Shipment Tracking', $this->plugin_name))
            ->set_context('side')
            ->set_priority('core')
            ->where('post_type', '=', 'shop_order')
            ->add_fields($fields);
    }

    /**
     * Adds the plugins setting screen and add the necessary
     * fields.
     *
     * @since    1.0.0
     */
    public function register_plugin_settings() {
        $fields = [
            Field::make('multiselect', '_trackr_order_statuses', __('Order Emails Display', $this->plugin_name))
                ->add_options(wc_get_order_statuses())
                ->set_help_text(__('Choose on which order emails to include the shipment tracking info', $this->plugin_name))
                ->set_default_value(['wc-completed'])
        ];
        Container::make('theme_options', __('Trackr', $this->plugin_name))
            ->add_fields($fields)
            ->set_page_file('trackr-settings')
            ->set_page_parent('woocommerce');
    }

    /**
     * Sidebar output on options page.
     *
     * @since    1.0.0
     * @access   private
     */
    public function settings_top() {
        require TRACKR_PATH . 'partials/admin/settings-top.php';
    }

    /**
     * Sidebar output on options page.
     *
     * @since    1.0.0
     * @access   private
     */
    public function settings_sidebar() {
        require TRACKR_PATH . 'partials/admin/settings-sidebar.php';
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, TRACKR_URL . 'assets/css/trackr-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, TRACKR_URL . 'assets/js/trackr-admin.js', array('jquery'), $this->version, true);
    }

}
