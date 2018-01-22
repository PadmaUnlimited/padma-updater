<?php
/*
Plugin Name:	Padma Updater
Plugin URI:		https://padmaunlimited/plugins/padma-updater
Description:  	Padma Updater plugin allows to your website to access and update Padma Theme and Padma Plugins
Version:      	0.0.1
Author:       	Plasma Soluciones
Author URI:   	https://plasma.cr
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

/*
if(!class_exists('padma')){
	return;
}
*/

//include( plugin_dir_path(__FILE__) . 'class_tgm_updater.php');
require 'plugin-update-checker/plugin-update-checker.php';
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


if (is_admin()) {
	$PadmaUpdater = new PadmaUpdater();
	add_action( 'init', array($PadmaUpdater,'updater') );
}