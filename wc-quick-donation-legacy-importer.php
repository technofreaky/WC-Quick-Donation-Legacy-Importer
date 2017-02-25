<?php 
/**
 * Plugin Name: WC QD Legacy Importer
 * Plugin URI:
 * Version: 1.0
 * Description: Imports old WC QD Data into new WC QD DATA.
 * Author: Varun Sridharan
 * Author URI: http://varunsridharan.in
 * Last Update: 2016-07-04 
 */
 

if ( ! defined( 'WPINC' ) ) { die; }
 
class WooCommerce_Quick_Donation_Legacy_Importer {
	public $version = '1.0';
	public $plugin_vars = array();
	
	protected static $_instance = null; # Required Plugin Class Instance
   
    /**
     * Creates or returns an instance of this class.
     */
    public static function get_instance() {
        if ( null == self::$_instance ) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
    
    /**
     * Class Constructor
     */
    public function __construct() {
        $this->define_constant();
        $this->load_required_files();
        $this->init_class();   
    }
	
	/**
	 * Throw error on object clone.
	 *
	 * Cloning instances of the class is forbidden.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cloning instances of the class is forbidden.', WC_QD_TXT), WC_QD_V );
	}	

	/**
	 * Disable unserializing of the class
	 *
	 * Unserializing instances of the class is forbidden.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of the class is forbidden.',WC_QD_TXT), WC_QD_V);
	}

    /**
     * Loads Required Plugins For Plugin
     */
    private function load_required_files(){ 
	   $this->load_files(WC_QD_LI_PATH.'class-*.php');
    }
    
    
    /**
     * Inits loaded Class
     */
    public function init_class(){ 
        if(!has_action('init', array('WooCommerce_Quick_Donation_Legacy_Importer_Admin_Notices', 'getInstance'))){
            add_action('init', array('WooCommerce_Quick_Donation_Legacy_Importer_Admin_Notices', 'getInstance'));
        }
        
        new WooCommerce_Quick_Donation_Legacy_Importer_Admin_Handler;
    }
     
    /**
     * Loads Files Based On Give Path & regex
     */
    protected function load_files($path,$type = 'require'){
        foreach( glob( $path ) as $files ){
            if($type == 'require'){ require_once( $files ); } 
			else if($type == 'include'){ include_once( $files ); }
        } 
    }

    private function define_constant(){ 
        $this->define('WC_QD_LI_PATH',plugin_dir_path( __FILE__ )); # Plugin DIR
        $this->define('WC_QD_LI_TXT','wc-quick-donation-legacy-importer'); # Plugin DIR
        
    }
	
    protected function define($key,$value){
        if(!defined($key)){
            define($key,$value);
        }
    }
}

new WooCommerce_Quick_Donation_Legacy_Importer;