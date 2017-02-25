<?php  
class WC_Quick_Donation_Legacy_handler {
      
    public function init(){
        $this->projects_type = 'wcqd_project';
        $this->projects_category = 'wcqd_category';
        $this->projects_tags = 'wcqd_tags';
        
    }
    
    public function get_terms_counts($tags = false){
        $tax = $this->projects_category;
        if($tags){
            $tax = $this->projects_tags;
        }
        $counts = wp_count_terms( $tax, array('hide_empty' => false,) ); 
        if(is_wp_error($counts)){return 0;}
        return $counts;
    }
    
    public function get_terms($tags = false){
        $tax = $this->projects_category;
        if($tags){
            $tax = $this->projects_tags;
        }
        $terms = get_terms(array(  'taxonomy' => $tax, 'hide_empty' => false, 'fields' => 'id=>name', ));
        return $terms;
    }
    
    public function get_projects_count(){
       $count = wp_count_posts( $this->projects_type, 'readable' );
        return $count;
    }
    
    public function get_projects_ids(){
        $latest = get_posts( array ( 'post_type' => $this->projects_type, 'posts_per_page' => -1, 'fields' => 'ids', 'post_status' => 'any')); 
        return $latest;
    }
    
}
global $wcqdlh;
$wcqdlh = new WC_Quick_Donation_Legacy_handler;
$wcqdlh->init();