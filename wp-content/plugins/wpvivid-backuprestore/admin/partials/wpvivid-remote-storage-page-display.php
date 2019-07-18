<?php

function wpvivid_add_tab_storage_list()
{
    ?>
    <a href="#" id="wpvivid_tab_storage_list" class="nav-tab storage-nav-tab nav-tab-active" onclick="switchstorageTabs(event,'page-storage-list','page-storage-list')"><?php _e('Storages', 'wpvivid'); ?></a>
    <?php
}

function wpvivid_add_tab_storage_edit()
{
    ?>
    <a href="#" id="wpvivid_tab_storage_edit" class="nav-tab storage-nav-tab delete" onclick="switchstorageTabs(event,'page-storage_edit','page-storage_edit')" style="display: none;">
        <div id="wpvivid_tab_storage_edit_text" style="margin-right: 15px;"><?php _e('Storage Edit', 'wpvivid'); ?></div>
        <div class="nav-tab-delete-img">
            <img src="<?php echo esc_url(plugins_url( 'images/delete-tab.png', __FILE__ )); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_storage_edit', 'storage', 'wpvivid_tab_storage_list');" />
        </div>
    </a>
    <?php
}

function wpvivid_add_page_storage_list()
{
    ?>
    <div class="storage-tab-content wpvivid_tab_storage_list" id="page-storage-list">
        <div style="margin-top:10px;"><p><strong><?php _e('Please choose one storage to save your backups (remote storage)', 'wpvivid'); ?></strong></p></div>
        <div class="schedule-tab-block"></div>
        <div class="">
            <table class="widefat">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th><?php _e( 'Storage Provider', 'wpvivid' ); ?></th>
                    <th class="row-title"><?php _e( 'Remote Storage Alias', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Actions', 'wpvivid' ); ?></th>
                </tr>
                </thead>
                <tbody class="wpvivid-remote-storage-list" id="wpvivid_remote_storage_list">
                <?php
                $html = '';
                $html = apply_filters('wpvivid_add_remote_storage_list', $html);
                echo $html;
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5" class="row-title"><input class="button-primary" id="wpvivid_set_default_remote_storage" type="submit" name="choose-remote-storage" value="<?php esc_attr_e( 'Save Changes', 'wpvivid' ); ?>" /></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php
}

function wpvivid_add_page_storage_edit()
{
    ?>
    <div class="storage-tab-content wpvivid_tab_storage_edit" id="page-storage_edit" style="display:none;">
        <div><?php do_action('wpvivid_edit_remote_page'); ?></div>
    </div>
    <?php
}

function wpvivid_storage_list($html)
{
    $html='<h2 class="nav-tab-wrapper" style="padding-bottom:0!important;">';
    $html.='<a href="#" id="wpvivid_tab_storage_list" class="nav-tab storage-nav-tab nav-tab-active" onclick="switchstorageTabs(event,\'page-storage-list\',\'page-storage-list\')">'. __('Storages', 'wpvivid').'</a>';
    $html.='<a href="#" id="wpvivid_tab_storage_edit" class="nav-tab storage-nav-tab delete" onclick="switchstorageTabs(event,\'page-storage_edit\',\'page-storage_edit\')" style="display: none;">
        <div id="wpvivid_tab_storage_edit_text" style="margin-right: 15px;">'.__('Storage Edit', 'wpvivid').'</div>
        <div class="nav-tab-delete-img">
            <img src="'.esc_url(plugins_url( 'images/delete-tab.png', __FILE__ )).'" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, \'wpvivid_tab_storage_edit\', \'storage\', \'wpvivid_tab_storage_list\');" />
        </div>
    </a>';
    $html.='</h2>';
    $html.='<div class="storage-tab-content wpvivid_tab_storage_list" id="page-storage-list">
        <div style="margin-top:10px;"><p><strong>'.__('Please choose one storage to save your backups (remote storage)', 'wpvivid').'</strong></p></div>
        <div class="schedule-tab-block"></div>
        <div class="">
            <table class="widefat">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>'. __( 'Storage Provider', 'wpvivid' ).'</th>
                    <th class="row-title">'. __( 'Remote Storage Alias', 'wpvivid' ).'</th>
                    <th>'. __( 'Actions', 'wpvivid' ).'</th>
                </tr>
                </thead>
                <tbody class="wpvivid-remote-storage-list" id="wpvivid_remote_storage_list">
                ';
    $html_list='';
    $html.= apply_filters('wpvivid_add_remote_storage_list', $html_list);
    $html.='</tbody><tfoot><tr>
            <th colspan="5" class="row-title"><input class="button-primary" id="wpvivid_set_default_remote_storage" type="submit" name="choose-remote-storage" value="'.esc_attr__( 'Save Changes', 'wpvivid' ).'" /></th>
            </tr></tfoot></table></div></div>';

    $html .= '<script>
            jQuery(\'#wpvivid_remote_storage_list\').on("click", "input", function(){
                var check_status = true;
                if(jQuery(this).prop(\'checked\') === true){
                     check_status = true;
                }
                else {
                    check_status = false;
                }
                jQuery(\'input[name = "remote_storage"]\').prop(\'checked\', false);
                if(check_status === true){
                    jQuery(this).prop(\'checked\', true);
                 }
                else {
                    jQuery(this).prop(\'checked\', false);
                }
            });
            </script>';
    return $html;
}
 //   <h2 class="nav-tab-wrapper" style="padding-bottom:0!important;">
 //           <?php do_action('wpvivid_storage_add_tab');
 //       </h2>
 //       <?php do_action('wpvivid_storage_add_page');

//add_action('wpvivid_storage_add_tab', 'wpvivid_add_tab_storage_list', 10);
//add_action('wpvivid_storage_add_tab', 'wpvivid_add_tab_storage_edit', 11);
//add_action('wpvivid_storage_add_page', 'wpvivid_add_page_storage_list', 10);
//add_action('wpvivid_storage_add_page', 'wpvivid_add_page_storage_edit', 11);
add_filter('wpvivid_storage_list','wpvivid_storage_list',10);
?>



<script>
    function select_remote_storage(evt, storage_page_id)
    {
        var i, tablecontent, tablinks;
        tablinks = document.getElementsByClassName("storage-providers");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("storage-providers-active", "");
        }
        evt.currentTarget.className += " storage-providers-active";

        jQuery(".storage-account-page").hide();
        jQuery("#"+storage_page_id).show();
    }
    function switchstorageTabs(evt,contentName,storage_page_id) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="table-list-content" and hide them
        tabcontent = document.getElementsByClassName("storage-tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="table-nav-tab" and remove the class "nav-tab-active"
        tablinks = document.getElementsByClassName("storage-nav-tab");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" nav-tab-active", "");
        }

        // Show the current tab, and add an "storage-menu-active" class to the button that opened the tab
        document.getElementById(contentName).style.display = "block";
        evt.currentTarget.className += " nav-tab-active";

        var top = jQuery('#'+storage_page_id).offset().top-jQuery('#'+storage_page_id).height();
        jQuery('html, body').animate({scrollTop:top}, 'slow');
    }
</script>