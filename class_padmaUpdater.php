<?php

class PadmaUpdater extends TGM_Updater{


	/**
	 *
	 * Class contructor
	 *
	 */
	function __construct(){
	}
	


	/**
	 *
	 * Activation method
	 *
	 */
	public function activation(){
	}


	/**
	 *
	 * Deactivation method
	 *
	 */
	public function deactivation(){
	}


	/**
	 *
	 * Updater
	 *
	 */
	public function updater(){

		// Return early if not in the admin.
		if ( ! is_admin() ) {
			return;
		}

		// Prepare updater args and initialize the updater.
		$args = array(
	        'plugin_name' => 'Padma Updater',		  // Your plugin name goes here.
	        'plugin_slug' => 'padma-updater',		  // Your plugin slug goes here.
	        'plugin_path' => plugin_basename( __FILE__ ),
	        'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . 'padma-updater',
	        'remote_url'  => PADMA_CDN_URL . 'software/padma-updater.zip',     // Set to the domain that should receive update requests.
	        'version'     => '0.0.2',					  // Adjust to your latest plugin version.	        
	    );
	    parent::__construct($args);
	}

}