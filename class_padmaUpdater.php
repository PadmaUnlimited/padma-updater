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


		if(function_exists('classicpress_version_short')){
			$cms = 'ClassicPress';
		}else{
			$cms = 'WordPress';			
		}		
	    
	    return $cms;
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

}