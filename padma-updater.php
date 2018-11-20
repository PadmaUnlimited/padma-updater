<?php
/*
Plugin Name:	Padma Updater
Plugin URI:		https://padmaunlimited/plugins/padma-updater
Description:  	Padma Updater plugin allows to your website to access and update Padma Theme and Padma Plugins
Version:      	1.0.3
Author: 		Padma Unlimited Team
Author URI: 	https://www.padmaunlimited.com/
License:      	GPL2
License URI:  	https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  	padma-updater
Domain Path:  	/languages


Padma Updater plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Padma Updater plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Padma Updater plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/


include( plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php');
include( plugin_dir_path(__FILE__) . 'class_padmaUpdater.php');


/**
 *
 * Activation hook 
 *
 */
function padma_updater_activate(){
	if ( ! current_user_can( 'activate_plugins' ) )
	return;

	$PadmaUpdater = new PadmaUpdater();
	$PadmaUpdater->activation();

}
register_activation_hook( __FILE__, 'padma_updater_activate');


/**
 *
 * Deactivation hook
 *
 */
function padma_updater_deactivate(){
	if ( ! current_user_can( 'activate_plugins' ) )
	return;
	
	$PadmaUpdater = new PadmaUpdater();
	$PadmaUpdater->deactivation();

}
register_deactivation_hook( __FILE__, 'padma_updater_deactivate');


/**
 *
 * Auto Update Plugins
 *
 */
function auto_update_padma_plugins ( $update, $item ) {

	if ( PadmaOption::get('disable-automatic-plugin-updates') ){
		return false;
	}
	// Array of plugin slugs to always auto-update
	$plugins = array ( 
        'padma-content-slider',
        'padma-example',
        'padma-filter-gallery',
        'padma-lifesaver',
        'padma-post-slider',
        'padma-services',
        'padma-shortcode-block',
        'padma-sociable',
        'padma-visual-elements',
    );

	if ( in_array( $item->slug, $plugins ) ) {
        return true;
    } else {
        return $update; // Else, use the normal API response to decide whether to update or not
    }

}
add_filter( 'auto_update_plugin', 'auto_update_padma_plugins', 50, 2 );	



function padma_updater_add_assets(){
    wp_enqueue_script('padma-updater',plugins_url( 'padma-updater.js' , __FILE__ ), array( 'jquery' ));
}

if (is_admin()) {

	add_action( 'plugins_loaded', array ( 'PadmaUpdater', 'init' ), 10 );

	$PadmaUpdater = new PadmaUpdater();
	$PadmaUpdater->updater('padma-updater',__DIR__);


	if(end(explode('/', $_SERVER['PHP_SELF']))=='update-core.php'){
		add_action('init','padma_updater_add_assets');
	}
}