<?php

/**
 * Divi Button Event Tagger
 *
 * @link              https://github.com/Spcktr/divi-button-event-tagger
 * @since             1.1.1
 * @package           Divi_Button_Event_Tagger_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Divi Button Event Tagger
 * Plugin URI:        https://github.com/Spcktr/divi-button-event-tagger
 * Description:       Insert missing data-vars-ga attributes for button links. This will help Google Analytics tracking buttons for themes like Divi.
 * Version:           1.2.0
 * Author:            Tim H.
 * Author URI:        https://github.com/spcktr
 * License:           GNU General Public License v3
 * License URI:       https://github.com/spcktr
 * Text Domain:       divi-button-event-tagger
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
define('event_tagger_version', '1.2.0');
define('BUTTON_EVENT_SELECTOR', '.et_pb_button'); // Default for Divi.



// Enqueue the first script
function enqueue_button_tagger() {
    if (get_option('script1_enabled')) {
        wp_enqueue_script('button_tagger', plugin_dir_url(__FILE__) . 'public/js/button-event-tagger.js', array('jquery'), event_tagger_version, true);
        $query_selector = BUTTON_EVENT_SELECTOR;
        $query_selector = apply_filters( 'button_event_selector', $query_selector );
        $php_vars = array(
         'querySelector' => $query_selector
        );
        wp_localize_script( 'button-event-tagger.js', 'php_vars', $php_vars );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_button_tagger');

// Enqueue the second script
function enqueue_nofollower() {
    if (get_option('script2_enabled')) {
        wp_enqueue_script('nofollower', plugin_dir_url(__FILE__) . 'public/js/remove-nofollow.js', array('jquery'), event_tagger_version, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_nofollower');

// Create the plugin settings page
function script_control_settings_page() {
    add_menu_page('Analytics Button Tagger', 'Analytics Button Tagger', 'manage_options', 'script-control-settings', 'script_control_settings', 'dashicons-admin-generic');
}
add_action('admin_menu', 'script_control_settings_page');

// Create the settings page content
function script_control_settings() {
    ?>
    <div class="wrap">
        <h2>Google Analytics Button Tagger</h2>
        <p>This plugin adds the following data-vars to your website buttons for event tracking.</p>
        <ul style="list-style: square inside;">
            <li>data-vars-ga-category</li>
            <li>data-vars-ga-action</li>
            <li>data-vars-ga-label</li>
        </ul>

        <form method="post" action="options.php">
            <?php
            settings_fields('script-control-settings');
            do_settings_sections('script-control-settings');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Enable link tagging</th>
                    <td>
                        <input type="checkbox" name="script1_enabled" value="1" <?php checked(get_option('script1_enabled'), 1); ?>>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Remove <span style="code">rel="nofollow"</span></th>
                    <td>
                        <input type="checkbox" name="script2_enabled" value="1" <?php checked(get_option('script2_enabled'), 1); ?>>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings and options
function script_control_register_settings() {
    register_setting('script-control-settings', 'script1_enabled');
    register_setting('script-control-settings', 'script2_enabled');
}
add_action('admin_init', 'script_control_register_settings');