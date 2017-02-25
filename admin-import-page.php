<?php global $wcqdlh; ?>
<div class="wrap">
    <h2><?php _e("WC Quick Donation Legacy Importer",WC_QD_LI_TXT); ?></h2>
    <br/>
    <div class="ajax_response"></div>
    <hr/>
<br/> <br/>
    
    
    <div id="warningMSG"  class="hidden" style="font-size:20px; color:red;background-color: white;padding: 15px 14px;margin: 10px 0px;text-align: center;line-height: 47px;">
        <img src=" data:image/png;base64,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"/>
        <p style="font-size:20px; color:red;background-color: white;padding: 15px 14px;margin: 10px 0px;text-align: center;line-height: 47px;"><?php _e("WARNING: It is highly recommended to backup your database before running the importer"); ?>
        <?php _e("Back up your database before running the importer. Network and timeout errors are known to cause catastrophic failure of the site."); ?>
        </p><br/>
        <a href="javascript:void(0)"  id="pleasegohead" style="margin: 10px 0;font-size: 20px;padding-top: 15px;padding-bottom: 15px;line-height: 5px;width: auto !important;height: auto !important;" class="button button-primary button-large"><?php _e("Yes, I Agree to the risk"); ?></a>
    </div>
    
    <div class="wp-list-table widefat plugin-install" id="YesIAMSure">

        <div class="plugin-card">
            <div class="plugin-card-top">
                <div class="name column-name"> <h3> <?php _e("Migrate Projects",WC_QD_LI_TXT); ?></h3> </div>

                <div class="action-links">
                    <ul class="plugin-action-buttons">
                        <li><input type="button" class="button-primary button" value="Import Now" data-action="wcqdimportprojects"/></li>
                    </ul>
                </div>

                <div class="desc column-description"><p>
                    <?php 
                        $status = $wcqdlh->get_projects_count();
                        foreach($status as $id => $val){
                            if($val == 0){ continue;}
                            echo '<strong> '.$id.' : </strong> '.$val.'<br/>';
                        }
                    ?>
                 </p></div>
            </div>
        </div>
        
        
        <div class="plugin-card">
            <div class="plugin-card-top">
                <div class="name column-name"> <h3> <?php _e("Migrate Categories & Tags",WC_QD_LI_TXT); ?></h3> </div>

                <div class="action-links">
                    <ul class="plugin-action-buttons">
                        <li><input type="button" class="button-primary button" value="Import Now" data-action="wcqdimportcattags"/></li>
                    </ul>
                </div>

                <div class="desc column-description"><p>
                   <strong> <?php _e("Project Tags",WC_QD_LI_TXT); ?> : </strong> <?php  echo $wcqdlh->get_terms_counts(true); ?>
                    <br/>
                    <strong> <?php _e("Project Categories",WC_QD_LI_TXT); ?> : </strong> <?php  echo $wcqdlh->get_terms_counts(); ?>
                 </p></div>
            </div>
        </div>
        
        
         <div class="plugin-card">
            <div class="plugin-card-top">
                <div class="name column-name"> <h3> <?php _e("Migrate Donation Orders ",WC_QD_LI_TXT); ?></h3> </div>

                <div class="action-links">
                    <ul class="plugin-action-buttons">
                        <li><input type="button" class="button-primary button" value="Import Now" data-action="wcqdimportorders"/></li>
                    </ul>
                </div>
                
                <div class="desc column-description"><p style="color:red;font-size:14px;">
                   <strong><?php _e("WARNING: Please run the importer only once! Running multiple times will cause erroneous import values."); ?></strong>
                 </p></div>
 
            </div>
        </div>
    </div>
    
    <br/> <br/>
    <div style="color:red;font-size:15px; font-weight:bold; display:block; width:100%;clear: both !important;">
        NOTICE: Once the import process is complete, you MUST deactivate the WC QD Legacy Importer plugin from the plugins page before proceeding further
    </div>
</div>


<style>
.desc.column-description , .plugin-card .name {
    display: inline-block !important;
    margin-left: 10px !important;
    margin-right: 10px !important;
    width: 100%;
}
    
   .plugin-card:nth-child(2n+1) {
    clear: none !important;
       
    margin-left: 10px !important;
}
    .plugin-card{
        width: 400px !important;
    }
</style>

<script>
jQuery(document).ready(function(){
    jQuery("a#pleasegohead").click(function(){
        jQuery('#warningMSG').hide();
        jQuery('#YesIAMSure').show();
    });
   jQuery('div.plugin-card input.button').click(function(){
       var data_action = jQuery(this).attr("data-action");
       jQuery(this).parent().append('<span class="spinner is-active"></span>');
       jQuery('div.plugin-card input.button').attr("disabled",'disabled');
       jQuery(".ajax_response").html('');
       jQuery.ajax({
           url:ajaxurl,
           method:"GET",
           data:{action:data_action},
       }).done(function(res){
           jQuery('div.plugin-card input.button').removeAttr("disabled");
           jQuery('div.plugin-card').find("span.spinner").remove();
           
           jQuery(".ajax_response").html('');
           jQuery(".ajax_response").html(res.data);
       });
   });
});
</script>