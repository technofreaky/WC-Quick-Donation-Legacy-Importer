<?php


class WooCommerce_Quick_Donation_Legacy_Importer_Admin_Handler {
 
    public function __construct(){
        add_action('admin_menu',array($this,'add_submenu'));
    }
    
    public function add_submenu(){ 
        add_submenu_page('tools.php',
                         __('Quick Donation Legacy Importer',WC_QD_LI_TXT), 
                         __('Quick Donation Legacy Importer',WC_QD_LI_TXT),
                         'manage_woocommerce', 'wc-qd-legacy-importer', array($this,'render_page'));
    }
    
    public function render_page(){
        require_once("admin-import-page.php");
    }
}