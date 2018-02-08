<?php

class PadmaUpdater{


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
	public function updater($slug = 'padma-updater',$dir = __DIR__){

		// Return early if not in the admin.
		if ( ! is_admin() ) {
			return;
		}


		$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
			PADMA_CDN_URL . 'software/?action=get_metadata&slug=' . $slug,
			$dir,
			$slug
		);
		
	}

}