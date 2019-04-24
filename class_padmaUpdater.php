<?php

class PadmaUpdater{


	public static function init()
    {
        // Named global variable to make access for other scripts easier.
        $GLOBALS[ __CLASS__ ] = new self;

    }


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
	 * Detect CMS
	 *
	 */
	private static function detect_cms() {

		return (function_exists('classicpress_version_short')) ? 'ClassicPress': 'WordPress';

	}
	

	/**
	 *
	 * Updater
	 *
	 */
	public function updater($slug = 'padma-updater',$dir = __DIR__ , $theme = false){

		if(file_exists($dir)){

			if($theme){
				$target = $dir . '/functions.php';
			}else{
				$target = $dir . '/' . $slug . '.php';
			}

			$token = get_option('padma_service_token');

			if($token != ''){
				$url = PADMA_CDN_URL . 'software/?action=get_metadata&slug=' . $slug . '&token=' . $token;
			}else{
				$url = PADMA_CDN_URL . 'software/?action=get_metadata&slug=' . $slug;
			}

			$url .= '&cms=' . self::detect_cms();
			$UpdateChecker = Puc_v4_Factory::buildUpdateChecker($url,$target,$slug);

		}
		
	}


	/**
	 *
	 * Maybe Trigger Update
	 *
	 */
	//public static function maybe_trigger_update(){

		//wp_maybe_auto_update();

		/*

		$doing_cron = true;
		debug(array(
			$doing_cron, ! doing_action( 'wp_maybe_auto_update' )
		));

		// Trigger background updates if running non-interactively, and we weren't called from the update handler.
		if ( $doing_cron && ! doing_action( 'wp_maybe_auto_update' ) ) {
			

			$installed_themes = wp_get_themes();

			//include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
			include_once( ABSPATH . 'wp-load.php' );
			$upgrader = new WP_Automatic_Updater;
			$upgrader->run();

			//$status = $upgrader->update( 'theme' , $installed_themes['padma'] );

			debug($status);
		
			/*
			debug('Run update');
			

			// Next, those themes we all love
			wp_update_themes();  // Check for Theme updates
			$theme_updates = get_site_transient( 'update_themes' );
			if ( $theme_updates && ! empty( $theme_updates->response ) ) {
				foreach ( $theme_updates->response as $theme ) {				
					$this->update( 'theme', (object) $theme );
				}
				// Force refresh of theme update information
				wp_clean_themes_cache();
			}*/

		//}
	//}
	

}