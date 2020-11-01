<?php

/**
 * Divi Button Event Tagger
 *
 * @link              https://github.com/Spcktr/divi-button-event-tagger
 * @since             0.1.0
 * @package           Divi_Button_Event_Tagger_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Divi Button Event Tagger
 * Plugin URI:        https://github.com/Spcktr/divi-button-event-tagger
 * Description:       Insert missing data-vars-ga attributes for button links. This will help Google Analytics tracking buttons for themes like Divi.
 * Version:           1.0.0
 * Author:            Sprckt
 * Author URI:        https://github.com/spcktr
 * License:           GNU General Public License v3
 * License URI:       https://github.com/spcktr
 * Text Domain:       divi-button-event-tagger
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('DIVI_BUTTON_EVENT_TAGGER_PLUGIN_NAME', 'divi-button-event-tagger');
define('DIVI_BUTTON_EVENT_TAGGER_PLUGIN_VERSION', '1.0.0');
define('BUTTON_EVENT_SELECTOR', '.et_pb_button'); // Default for Divi.

/**
 * Enqueue the Link Helper JavaScript Library
 * and Inline Script
 * 
 * This supports the button_event_selector filter.
 */

function enqueue_divi_button_event_tagger_javascript()
{	
    wp_register_script( DIVI_BUTTON_EVENT_TAGGER_PLUGIN_NAME, plugin_dir_url( __FILE__ ) . 'public/js/' . DIVI_BUTTON_EVENT_TAGGER_PLUGIN_NAME . '.js', '', DIVI_BUTTON_EVENT_TAGGER_PLUGIN_VERSION, true );
    wp_enqueue_script( DIVI_BUTTON_EVENT_TAGGER_PLUGIN_NAME );

    $script = 'addDiviLinkTitles();';
    wp_add_inline_script( DIVI_BUTTON_EVENT_TAGGER_PLUGIN_NAME, $script, 'after' );

    $query_selector = LINK_HELPER_SELECTOR;
    $query_selector = apply_filters( 'button_event_selector', $query_selector );
    $php_vars = array(
        'querySelector' => $query_selector
    );
    wp_localize_script( DIVI_BUTTON_EVENT_TAGGER_PLUGIN_NAME, 'php_vars', $php_vars );
}
add_action( 'wp_enqueue_scripts', 'enqueue_divi_button_event_tagger_javascript' );