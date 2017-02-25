<?php  

class WC_Quick_Donation_Legacy_Importer_handler {
    public function __construct(){}
     
    public function run_donationorder_converter(){
        global $wpdb;
        
        $get_order_ids = "SELECT post_id FROM `{$wpdb->postmeta}` WHERE meta_key != '_is_only_donation' AND meta_key = '_is_donation' ";
        $order_ids = $wpdb->get_col($get_order_ids);
        
        $sql = " ALTER TABLE `{$wpdb->prefix}wc_quick_donation` DROP COLUMN `date`"; 
        $wpdb->query( $sql );
        $sql = "ALTER TABLE  `{$wpdb->prefix}wc_quick_donation` ADD `project_cost` BIGINT(20) NOT NULL AFTER `projectid`";
        $wpdb->query( $sql );
         $sql = "ALTER TABLE `{$wpdb->prefix}wc_quick_donation` CHANGE `projectid` `project_id` BIGINT(20) NOT NULL";
        $wpdb->query( $sql );
        
        
        
        foreach($order_ids as $id){
            $project_id = get_post_meta($id,'_project_details',true);
            $pinfo = array(); 
            
            if(empty($project_id)){continue;}
            $_order_total = get_post_meta($id,'_order_total',true);
            $pinfo[$project_id]['project_id'] = $project_id;
            $pinfo[$project_id]['project_cost'] = $_order_total;
            //
            //
            
           $wpdb->query("UPDATE `{$wpdb->prefix}wc_quick_donation` SET `project_cost` = '$_order_total' WHERE `donationid` = '$id' AND project_id='$project_id'");
            
            update_post_meta($id,'_project_details',$pinfo);
            update_post_meta($id,'_is_only_donation',true);
            update_post_meta($id,'_project_ids',array_keys($pinfo));
        }
        
        $message = __("All Orders Migrated To New WC Quick Donation",WC_QD_TXT);
        wc_qd_li_admin_update($message,1,'legacy_import_projects_success');
        return true;
    }
    
    
    public function change_meta_keys(){
        global $wpdb;
        $wpdb->query(" UPDATE `{$wpdb->postmeta}` SET `meta_key` = '_wc_qd_max_required' WHERE `meta_key` = '_wc_qd_max_req_donation'");
        $wpdb->query(" UPDATE `{$wpdb->postmeta}` SET `meta_key` = '_wc_qd_min_required' WHERE `meta_key` = '_wc_qd_min_req_donation'");
        $wpdb->query(" DELETE FROM `{$wpdb->postmeta}` WHERE `meta_key` = '_wc_qd_visibility_project'"); 
    }
    
    public function run_posttype_converter(){
        global $wcqdlh,$wpdb;
        
        $ids = $wcqdlh->get_projects_ids();
        $term_ids = array_map( 'absint',$ids );
        
        $message = __("Below Listed Donation Projects  Imported From Previous Version of Quick Donation. <br/>",WC_QD_TXT);
        
        if(!empty($term_ids)){
            $termids = implode( ', ', $term_ids );
            $wpdb->query( 
                $wpdb->prepare(" UPDATE `{$wpdb->posts}` SET `post_type` = 'donation' WHERE `post_type` = 'wcqd_project' AND `ID` IN ({$termids})", $wcqdlh->projects_type)
            );
            
            foreach($term_ids as $id){
                $title = get_the_title($id);
                $link = get_edit_post_link($id);
                $message .= '<a href="'.$link.'" > #'.$id.' - '.$title.'</a> <br/>'; 
            }
        }
        $this->change_meta_keys();
        
        wc_qd_li_admin_update($message,1,'legacy_import_projects_success');
        
        return true;
         
    }
    
    public function run_category_converter($tags = false){
        global $wpdb,$wcqdlh;
         
        $terms = $wcqdlh->get_terms($tags);
        

        $mname = "categories";
        $taxNo = $wcqdlh->projects_category ; 
        $taxN1 = 'donation_category';
        
        if($tags) {
            $mname = 'Tags';
            $taxNo = $wcqdlh->projects_tags;
            $taxN1 = 'donation_tags';
        }

        if(empty($terms)){
            $message = '<p>'.__("All Donation Category Already Imported Or No $mname Exists",WC_QD_TXT).'</p>';
            wc_qd_li_admin_upgrade($message,1,'legacy_import_projects_category_success');
        }
     
        $term_ids = array_map( 'absint', array_keys($terms) ); 
        $term_ids = implode( ', ', $term_ids );
        if(!empty($term_ids)){
            $wpdb->query( 
                $wpdb->prepare(" UPDATE `{$wpdb->term_taxonomy}` SET `taxonomy` = %s WHERE `taxonomy` = %s AND `term_id` IN ({$term_ids})", $taxN1, $taxNo ) 
            );
        }
    
        if(!empty($terms)){
            $message = "<p>".__("Below Listed Donation Projects $mname  Imported From Previous Version of Quick Donation.",WC_QD_TXT).'</p>';
            foreach($terms as $id => $name){  $message .= '#'.$id.' - '.$name.' <br/> '; }
            wc_qd_li_admin_update($message,1,'legacy_import_projects_category_success');
        }
        
         
    }
}

global $qdlih;
$qdlih = new WC_Quick_Donation_Legacy_Importer_handler;