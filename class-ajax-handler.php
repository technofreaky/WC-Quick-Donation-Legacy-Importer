<?php


class WooCommerce_Quick_Donation_Legacy_Importer_Admin_Ajax_Handler {
 
    public function __construct(){
        add_action( 'wp_ajax_wcqdimportprojects',array($this,'import_wcqd_projects')); 
        add_action( 'wp_ajax_wcqdimportcattags',array($this,'import_wcqd_terms'));
        add_action( 'wp_ajax_wcqdimportorders',array($this,'wcqdimportorders'));
    }
    
    public function wcqdimportorders(){
        global $qdlih; 
        $status = $qdlih->run_donationorder_converter();
        $notices = '';
        if($status){ $notices = $this->get_notices(); }
        wp_send_json_success($notices);
        wp_die();
    }
    
    public function get_notices(){
        global $wcqdls_notice;
        $notices = '';
        $wcqdls_notice = WooCommerce_Quick_Donation_Legacy_Importer_Admin_Notices::getInstance(); 
        $wcqdls_notice->loadNotices();
        ob_start();
            $wcqdls_notice->displayNotices();
        $notices = ob_get_clean();    
        return $notices;
    }
    
    
    public function import_wcqd_projects(){
        global $qdlih; 
        $status = $qdlih->run_posttype_converter();
        $notices = '';
        if($status){ $notices = $this->get_notices(); }
        wp_send_json_success($notices);
        wp_die();
    }
    
    public function import_wcqd_terms(){
        global $qdlih; 
        $status = $qdlih->run_category_converter();
        $status = $qdlih->run_category_converter(true);
        $notices = '';
        $notices = $this->get_notices();        
        wp_send_json_success($notices);
        wp_die();
    }
     
}

new WooCommerce_Quick_Donation_Legacy_Importer_Admin_Ajax_Handler;