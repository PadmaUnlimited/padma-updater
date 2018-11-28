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
	 * Updater
	 *
	 */
	public function updater($slug = 'padma-updater',$dir = __DIR__ , $theme = false){

		// Return early if not in the admin.
		if ( ! is_admin() ) {
			//return;
		}

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

			$UpdateChecker = Puc_v4_Factory::buildUpdateChecker($url,$target,$slug);

			//debug($UpdateChecker);

		}
		
	}

	

	

}