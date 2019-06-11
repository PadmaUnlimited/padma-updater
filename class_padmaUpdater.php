<?php

class PadmaUpdater{

	public static function init()
    {
        // Named global variable to make access for other scripts easier.
        $GLOBALS[ __CLASS__ ] = new self;

	    self::updatePadmaPlugins();

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
	 * Padma Plugins
	 *
	 */
	public static function plugins(){
		return array ( 
		        'padma-content-slider',
		        'padma-example',
		        'padma-filter-gallery',
		        'padma-gallery',
		        'padma-lifesaver',
		        'padma-post-slider',
		        'padma-services',
		        'padma-shortcode-block',
		        'padma-sociable',
		        'padma-visual-elements',
		        'padma-updater',
		    );
	}
	


	/**
	 *
	 * Update Padma plugins
	 *
	 */
	private static function updatePadmaPlugins(){

		foreach (self::plugins() as $key => $slug) {
			$path = ABSPATH . 'wp-content/plugins/'.$slug;			
			self::updater($slug, $path , false);			
		}
	}
	

	/**
	 *
	 * Is a Padma Plugin?
	 *
	 */
	public static function is_padma_plugin($slug){
		return in_array($slug, self::plugins());
	}
	
	

	/**
	 *
	 * Updater
	 *
	 */
	public static function updater($slug = 'padma-updater', $dir = __DIR__ , $theme = false, $checkPeriod = 1){

		if(file_exists($dir)){

			/**
			 *
			 * Use developer version only for Theme and Updater
			 *
			 */			
			if($theme || $slug == 'padma-updater'){
				$package_type = (get_option('padma-use-developer-version')) ? 'developer': 'software';
			}else{
				$package_type = 'software';
			}
			
			if($theme){
				$target = $dir . '/functions.php';
			}else{
				$target = $dir . '/' . $slug . '.php';
			}

			$token = get_option('padma_service_token');

			if($token != ''){
				$url = PADMA_CDN_URL . $package_type . '/?action=get_metadata&slug=' . $slug . '&token=' . $token;
			}else{
				$url = PADMA_CDN_URL . $package_type . '/?action=get_metadata&slug=' . $slug;
			}

			$url .= '&cms=' . self::detect_cms();
			$UpdateChecker = Puc_v4_Factory::buildUpdateChecker($url,$target,$slug,$checkPeriod);

		}
		
	}

}