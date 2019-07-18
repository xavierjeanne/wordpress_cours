<?php

function wpvivid_add_backup_type($html, $type_name)
{
    $html .= '<label>
                    <input type="radio" option="backup" name="'.$type_name.'" value="files+db" checked />
                    <span>'.__( 'Database + Files (Entire website)', 'wpvivid' ).'</span>
                </label><br>
                <label>
                    <input type="radio" option="backup" name="'.$type_name.'" value="files" />
                    <span>'.__( 'All Files (Exclude Database)', 'wpvivid' ).'</span>
                </label><br>
                <label>
                    <input type="radio" option="backup" name="'.$type_name.'" value="db" />
                    <span>'.__( 'Only Database', 'wpvivid' ).'</span>
                </label><br>';
    return $html;
}

function wpvivid_backup_do_js(){
    global $wpvivid_pulgin;
    $backup_task=$wpvivid_pulgin->_list_tasks(false);
    $general_setting=WPvivid_Setting::get_setting(true, "");
    if($general_setting['options']['wpvivid_common_setting']['estimate_backup'] == 0){
        ?>
        jQuery('#wpvivid_estimate_backup_info').hide();
        <?php
    }
    if(empty($backup_task['backup']['data'])){
        ?>
        jQuery('#wpvivid_postbox_backup_percent').hide();
        jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
        <?php
    }
    else{
        foreach($backup_task['backup']['data'] as $key=>$value){
            if($value['status']['str'] === 'running'){
                $percent=$value['data']['progress'];
                ?>
                jQuery('#wpvivid_postbox_backup_percent').show();
                jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'nano', 'opacity': '0.4'});
                jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'nano', 'opacity': '0.4'});
                jQuery('#wpvivid_action_progress_bar_percent').css('width', <?php echo $percent; ?>+'%');
                jQuery('#wpvivid_backup_database_size').html('<?php echo $value['size']['db_size']; ?>');
                jQuery('#wpvivid_backup_file_size').html('<?php echo $value['size']['files_size']['sum']; ?>');
                <?php
                if($value['is_canceled'] == false){
                    $descript=$value['data']['descript'];
                    if($value['data']['type']){
                        $find_str = 'Total size: ';
                        if(stripos($descript, $find_str) != false) {
                            $pos = stripos($descript, $find_str);
                            $descript = substr($descript, 0, $pos);
                        }
                    }
                    $backup_running_time=$value['data']['running_stamp'];
                    $output = '';
                    foreach (array(86400 => 'day', 3600 => 'hour', 60 => 'min', 1 => 'second') as $key => $value) {
                        if ($backup_running_time >= $key) $output .= floor($backup_running_time/$key) . $value;
                        $backup_running_time %= $key;
                    }
                    if($output==''){
                        $output=0;
                    }
                    ?>
                    jQuery('#wpvivid_current_doing').html('<?php echo $descript; ?> Progress: <?php echo $percent; ?>%, running time: <?php echo $output; ?>');
                    <?php
                }
                else{
                    ?>
                    jQuery('#wpvivid_current_doing').html('The backup will be canceled after backing up the current chunk ends.');
                    <?php
                }
            }
        }
    }
}

function wpvivid_download_backup_descript($html){
    $html = '<p><strong>'.__('About backup download', 'wpvivid').'</strong></p>';
    $html .= '<ul>';
    $html .= '<li>'.__('->If backups are stored in remote storage, our plugin will retrieve the backup to your web server first. This may take a little time depending on the size of backup files. Please be patient. Then you can download them to your PC.', 'wpvivid').'</li>';
    $html .= '<li>'.__('->If backups are stored in web server, the plugin will list all relevant files immediately.', 'wpvivid').'</li>';
    $html .= '</ul>';
    return $html;
}

function wpvivid_restore_website_dexcript($html){
    $html = '<p><a href="#" id="wpvivid_how_to_restore_backup_describe" onclick="wpvivid_click_how_to_restore_backup();">'.__('How to restore your website from a backup(scheduled, manual, uploaded and received backup)', 'wpvivid').'</a></p>';
    $html .= '<div id="wpvivid_how_to_restore_backup"></div>';
    return $html;
}

function wpvivid_backup_module($html){
    $html = '';
    $backup_descript = '';
    $backup_part_type = '';
    $backup_part_pos = '';
    $backup_part_exec = '';
    $backup_part_tip = '';
    $html .= '
    <div class="postbox quickbackup" id="wpvivid_postbox_backup">
        '.apply_filters('wpvivid_backup_descript', $backup_descript).'
         '.apply_filters('wpvivid_backup_part_type', $backup_part_type).'
         '.apply_filters('wpvivid_backup_part_pos', $backup_part_pos).'
         '.apply_filters('wpvivid_backup_part_exec', $backup_part_exec).'
         '.apply_filters('wpvivid_backup_part_tip', $backup_part_tip).'
    </div>
    ';
    return $html;
}

function wpvivid_backup_descript($html){
    $backupdir=WPvivid_Setting::get_backupdir();
    $html .= '<h2><span>'.__( 'Back Up Manually','wpvivid').'</span></h2>
              <div class="quickstart-storage-setting">
                  <span class="list-top-chip backup" name="ismerge" value="1">'.__('Local Storage Directory: ').'</span>
                  <span class="list-top-chip" id="wpvivid_local_storage_path">'.WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$backupdir.'</span>
                  <span class="list-top-chip" id=""><a href="#" onclick="wpvivid_click_switch_page(\'wrap\', \'wpvivid_tab_setting\', true);">'.__(' rename directory', 'wpvivid').'</a></span>
              </div>';
    return $html;
}

function wpvivid_backup_part_type($html){
    $backup_type = '';
    $type_name = 'backup_files';
    $html .= '<div class="quickstart-archive-block">
                        <fieldset>
                            <legend class="screen-reader-text"><span>input type="radio"</span></legend>
                                '.apply_filters('wpvivid_add_backup_type', $backup_type, $type_name).'
                            <label style="display: none;">
                                <input type="checkbox" option="backup" name="ismerge" value="1" checked />
                            </label><br>
                        </fieldset>
              </div>';
    return $html;
}

function wpvivid_backup_part_pos($html){
    $pic='';
    $html .= '<div class="quickstart-storage-block">
                        <fieldset>
                            <legend class="screen-reader-text"><span>input type="checkbox"</span></legend>
                            <label>
                                <input type="radio" id="wpvivid_backup_local" option="backup_ex" name="local_remote" value="local" checked />
                                <span>'.__( 'Save Backups to Local', 'wpvivid' ).'</span>
                            </label>
                            <div style="clear:both;"></div>
                            <label>
                                <input type="radio" id="wpvivid_backup_remote" option="backup_ex" name="local_remote" value="remote" />
                                <span>'.__( 'Send Backup to Remote Storage:', 'wpvivid' ).'</span>
                            </label><br>
                            <div id="upload_storage" style="cursor:pointer;" title="Highlighted icon illuminates that you have choosed a remote storage to store backups">
                                '.apply_filters('wpvivid_schedule_add_remote_pic',$pic).'
                            </div>
                        </fieldset>
             </div>';
    return $html;
}

function wpvivid_backup_part_exec($html){
    $html .= '<div class="quickstart-btn" style="padding-top:20px;">
                        <input class="button-primary quickbackup-btn" id="wpvivid_quickbackup_btn" type="submit" value="'.esc_attr( 'Backup Now', 'wpvivid').'" />
                        <div class="schedule-tab-block" style="text-align:center;">
                            <fieldset>
                                <label>
                                    <input type="checkbox" id="wpvivid_backup_lock" option="backup" name="lock" value="" />
                                    <span>'.__( 'This backup can only be deleted manually', 'wpvivid' ).'</span>
                                </label>
                            </fieldset>
                        </div>
                    </div>';
    return $html;
}

function wpvivid_backup_part_tip($html){
    $html .= '<div class="custom-info" style="float:left; width:100%;">
                        <strong>'.__('Tips', 'wpvivid').'</strong>'.__(': The settings are only for manual backup, which won\'t affect schedule settings.', 'wpvivid').'
                    </div>';
    return $html;
}


function wpvivid_backuppage_load_backuplist($backuplist_array){
    $backuplist_array['list_backup'] = array('index' => '1', 'tab_func' => 'wpvivid_backuppage_add_tab_backup', 'page_func' => 'wpvivid_backuppage_add_page_backup');
    $backuplist_array['list_log'] = array('index' => '3', 'tab_func' => 'wpvivid_backuppage_add_tab_log', 'page_func' => 'wpvivid_backuppage_add_page_log');
    $backuplist_array['list_restore'] = array('index' => '4', 'tab_func' => 'wpvivid_backuppage_add_tab_restore', 'page_func' => 'wpvivid_backuppage_add_page_restore');
    return $backuplist_array;
}

function wpvivid_backuppage_add_tab_backup(){
    ?>
    <a href="#" id="wpvivid_tab_backup" class="nav-tab backup-nav-tab nav-tab-active" onclick="switchrestoreTabs(event,'page-backups')"><?php _e('Backups', 'wpvivid'); ?></a>
    <?php
}

function wpvivid_backuppage_add_tab_log(){
    ?>
    <a href="#" id="wpvivid_tab_backup_log" class="nav-tab backup-nav-tab delete" onclick="switchrestoreTabs(event,'page-log')" style="display: none;">
        <div style="margin-right: 15px;"><?php _e('Log', 'wpvivid'); ?></div>
        <div class="nav-tab-delete-img">
            <img src="<?php echo esc_url(plugins_url( 'images/delete-tab.png', __FILE__ )); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_backup_log', 'backup', 'wpvivid_tab_backup');" />
        </div>
    </a>
    <?php
}

function wpvivid_backuppage_add_tab_restore(){
    ?>
    <a href="#" id="wpvivid_tab_restore" class="nav-tab backup-nav-tab delete" onclick="switchrestoreTabs(event,'page-restore')" style="display: none;">
        <div style="margin-right: 15px;"><?php _e('Restore', 'wpvivid'); ?></div>
        <div class="nav-tab-delete-img">
            <img src="<?php echo esc_url(plugins_url( 'images/delete-tab.png', __FILE__ )); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_restore', 'backup', 'wpvivid_tab_backup');" />
        </div>
    </a>
    <?php
}

function wpvivid_backuppage_add_page_backup(){
    $backuplist=WPvivid_Backuplist::get_backuplist();
    ?>
    <div class="backup-tab-content wpvivid_tab_backup" id="page-backups">
        <div style="margin-top:10px; margin-bottom:10px;">
            <?php
            $descript='';
            $descript= apply_filters('wpvivid_download_backup_descript',$descript);
            echo $descript;
            ?>
        </div>
        <div style="margin-bottom:10px;">
            <?php
            $descript='';
            $descript= apply_filters('wpvivid_restore_website_dexcript',$descript);
            echo $descript;
            ?>
        </div>
        <div style="clear:both;"></div>
        <?php
        do_action('wpvivid_rescan_backup_list');
        ?>
        <table class="wp-list-table widefat plugins" id="wpvivid_backuplist_table" style="border-collapse: collapse;">
            <thead>
            <tr class="backup-list-head" style="border-bottom: 0;">
                <td></td>
                <th><?php _e( 'Backup','wpvivid'); ?></th>
                <th><?php _e( 'Storage','wpvivid'); ?></th>
                <th><?php _e( 'Download','wpvivid'); ?></th>
                <th><?php _e( 'Restore', 'wpvivid'); ?></th>
                <th><?php _e( 'Delete','wpvivid'); ?></th>
            </tr>
            </thead>
            <tbody class="wpvivid-backuplist" id="wpvivid_backuplist">
            <?php
            $html = '';
            $html = apply_filters('wpvivid_add_backup_list', $html);
            echo $html;
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th><input name="" type="checkbox" id="backup_list_all_check" value="1" /></th>
                <th class="row-title" colspan="5"><a onclick="wpvivid_delete_backups_inbatches();" style="cursor: pointer;"><?php _e('Delete the selected backups', 'wpvivid'); ?></a></th>
            </tr>
            </tfoot>
        </table>
    </div>
    <script>
        function wpvivid_delete_selected_backup(backup_id){
            var name = '';
            jQuery('#wpvivid_backuplist tr').each(function(i){
                jQuery(this).children('td').each(function (j) {
                    if (j == 0) {
                        var id = jQuery(this).parent().children('th').find("input[type=checkbox]").attr("id");
                        if(id === backup_id){
                            name = jQuery(this).parent().children('td').eq(0).find('img').attr('name');
                        }
                    }
                });
            });
            var descript = '';
            var force_del = 0;
            var bdownloading = false;
            if(name === 'lock') {
                descript = '<?php _e('This backup is locked, are you sure to remove it? This backup will be deleted permanently from your hosting (localhost) and remote storages.', 'wpvivid'); ?>';
                force_del = 1;
            }
            else{
                descript = '<?php _e('Are you sure to remove this backup? This backup will be deleted permanently from your hosting (localhost) and remote storages.', 'wpvivid'); ?>';
                force_del = 0;
            }
            if(m_downloading_id === backup_id){
                bdownloading = true;
                descript = '<?php _e('This request will delete the backup being downloaded, are you sure you want to continue?', 'wpvivid'); ?>';
                force_del = 1;
            }
            var ret = confirm(descript);
            if(ret === true){
                var ajax_data={
                    'action': 'wpvivid_delete_backup',
                    'backup_id': backup_id,
                    'force': force_del
                };
                wpvivid_post_request(ajax_data, function(data){
                    wpvivid_handle_backup_data(data);
                    if(bdownloading){
                        m_downloading_id = '';
                    }
                }, function(XMLHttpRequest, textStatus, errorThrown) {
                    var error_message = wpvivid_output_ajaxerror('deleting the backup', textStatus, errorThrown);
                    alert(error_message);
                });
            }
        }
        function wpvivid_delete_backups_inbatches(){
            var delete_backup_array = new Array();
            var count = 0;
            var bdownloading = false;
            jQuery('#wpvivid_backuplist tr').each(function (i) {
                jQuery(this).children('th').each(function (j) {
                    if (j == 0) {
                        if(jQuery(this).find('input[type=checkbox]').prop('checked')){
                            delete_backup_array[count] = jQuery(this).find('input[type=checkbox]').attr('id');
                            if(m_downloading_id === jQuery(this).find('input[type=checkbox]').attr('id')){
                                bdownloading = true;
                            }
                            count++;
                        }
                    }
                });
            });
            if( count === 0 ){
                alert('<?php _e('Please select at least one item.','wpvivid'); ?>');
            }
            else {
                var descript = '';
                if(bdownloading) {
                    descript = '<?php _e('This request might delete the backup being downloaded, are you sure you want to continue?', 'wpvivid'); ?>';
                }
                else{
                    descript = '<?php _e('Are you sure to remove the selected backups? These backups will be deleted permanently from your hosting (localhost).', 'wpvivid'); ?>';
                }
                var ret = confirm(descript);
                if (ret === true) {
                    var ajax_data = {
                        'action': 'wpvivid_delete_backup_array',
                        'backup_id': delete_backup_array
                    };
                    wpvivid_post_request(ajax_data, function (data) {
                        wpvivid_handle_backup_data(data);
                        jQuery('#backup_list_all_check').prop('checked', false);
                        if(bdownloading){
                            m_downloading_id = '';
                        }
                    }, function (XMLHttpRequest, textStatus, errorThrown) {
                        var error_message = wpvivid_output_ajaxerror('deleting the backup', textStatus, errorThrown);
                        alert(error_message);
                    });
                }
            }
        }
    </script>
    <?php
}

function wpvivid_backuppage_add_page_log(){
    ?>
    <div class="backup-tab-content wpvivid_tab_backup_log" id="page-log" style="display:none;">
        <div class="postbox restore_log" id="wpvivid_display_log_content">
            <div></div>
        </div>
    </div>
    <?php
}

function wpvivid_backuppage_add_page_restore(){
    ?>
    <div class="backup-tab-content wpvivid_tab_restore" id="page-restore" style="display:none;">
        <div>
            <h3><?php _e('Restore backup from:', 'wpvivid'); ?><span id="wpvivid_restore_backup_time"></span></h3>
            <p><strong><?php _e('Please do not close the page or switch to other pages when a restore task is running, as it could trigger some unexpected errors.', 'wpvivid'); ?></strong></p>
            <p><?php _e('Restore function will replace the current site\'s themes, plugins, uploads, database and/or other content directories with the existing equivalents in the selected backup.', 'wpvivid'); ?></p>
            <div id="wpvivid_restore_is_migrate" style="padding-bottom: 10px; display: none;">
                <label >
                    <input type="radio" id="wpvivid_replace_domain" option="restore" name="restore_domain" value="1" /><?php echo 'Restore and replace original domain(URL) with '.home_url().'(migration)'; ?>
                </label><br>
                <label >
                    <input type="radio" id="wpvivid_keep_domain" option="restore" name="restore_domain" value="0" /><?php _e('Restore and keep the original domain(URL) unchanged', 'wpvivid'); ?>
                </label><br>
            </div>
            <div>
                <p><strong>Tips:</strong> The plugin detects automatically either site restoration or migration (replacing the domain name) based on the current domain name. If the domain name in backup file is same as the current one, it starts restoring. On the contrary, restoring backup means to replace with the current domain name. The precondition is that the backup is created by version 0.9.21 or later.</p>
            </div>
            <div id="wpvivid_restore_check"></div>
            <div class="restore-button-position" id="wpvivid_restore_part"><input class="button-primary" id="wpvivid_restore_btn" type="submit" name="restore" value="<?php esc_attr_e( 'Restore', 'wpvivid' ); ?>" onclick="wpvivid_start_restore();" /></div>
            <div class="restore-button-position" id="wpvivid_clean_part"><input class="button-primary" id="wpvivid_clean_restore" type="submit" name="clear_restore" value="<?php esc_attr_e( 'Terminate', 'wpvivid' ); ?>" /></div>
            <div class="restore-button-position" id="wpvivid_rollback_part"><input class="button-primary" id="wpvivid_rollback_btn" type="submit" name="rollback" value="<?php esc_attr_e( 'Rollback', 'wpvivid' ); ?>" /></div>
            <div class="restore-button-position" id="wpvivid_download_part">
                <input class="button-primary" id="wpvivid_download_btn" type="submit" name="download" value="<?php esc_attr_e( 'Retrieve the backup to localhost', 'wpvivid' ); ?>" />
                <span>The backup is stored on the remote storage, click on the button to download it to localhost.</span>
            </div>
            <div class="spinner" id="wpvivid_init_restore_data" style="float:left;width:auto;height:auto;padding:10px 20px 20px 0;background-position:0 10px;"></div>
        </div>
        <div class="postbox restore_log" id="wpvivid_restore_log"></div>
    </div>
    <?php
}








function wpvivid_backuppage_load_progress_module($html){
    $html = '
    <div class="postbox" id="wpvivid_postbox_backup_percent" style="display: none;">
        <div class="action-progress-bar" id="wpvivid_action_progress_bar">
            <div class="action-progress-bar-percent" id="wpvivid_action_progress_bar_percent" style="height:24px;width:0"></div>
        </div>
        <div id="wpvivid_estimate_backup_info" style="float: left;">
            <div class="backup-basic-info"><span>'.__('Database Size:', 'wpvivid').'</span><span id="wpvivid_backup_database_size">N/A</span></div>
            <div class="backup-basic-info"><span>'.__('File Size:', 'wpvivid').'</span><span id="wpvivid_backup_file_size">N/A</span></div>
        </div>
        <div id="wpvivid_estimate_upload_info" style="float: left;">
            <div class="backup-basic-info"><span>'.__('Total Size:', 'wpvivid').'</span><span>N/A</span></div>
            <div class="backup-basic-info"><span>'.__('Uploaded:', 'wpvivid').'</span><span>N/A</span></div>
            <div class="backup-basic-info"><span>'.__('Speed:', 'wpvivid').'</span><span>N/A</span></div>
        </div>
        <div style="float: left;">
            <div class="backup-basic-info"><span>'.__('Network Connection:', 'wpvivid').'</span><span>N/A</span></div>
        </div>
        <div style="clear:both;"></div>
        <div style="margin-left:10px; float: left; width:100%;"><p id="wpvivid_current_doing"></p></div>
        <div style="clear: both;"></div>
        <div>
            <div id="wpvivid_backup_cancel" class="backup-log-btn"><input class="button-primary" id="wpvivid_backup_cancel_btn" type="submit" value="'.esc_attr( 'Cancel', 'wpvivid' ).'"  /></div>
            <div id="wpvivid_backup_log" class="backup-log-btn"><input class="button-primary backup-log-btn" id="wpvivid_backup_log_btn" type="submit" value="'.esc_attr( 'Log', 'wpvivid' ).'" /></div>
        </div>
        <div style="clear: both;"></div>
    </div>';
    return $html;
}

function wpvivid_backuppage_load_backup_module($html){
    $html = '';
    $backup_descript = '';
    $backup_part_type = '';
    $backup_part_pos = '';
    $backup_part_exec = '';
    $backup_part_tip = '';
    $html .= '
    <div class="postbox quickbackup" id="wpvivid_postbox_backup">
        '.apply_filters('wpvivid_backup_descript', $backup_descript).'
         '.apply_filters('wpvivid_backup_part_type', $backup_part_type).'
         '.apply_filters('wpvivid_backup_part_pos', $backup_part_pos).'
         '.apply_filters('wpvivid_backup_part_exec', $backup_part_exec).'
         '.apply_filters('wpvivid_backup_part_tip', $backup_part_tip).'
    </div>
    ';
    return $html;
}

function wpvivid_backuppage_load_schedule_module($html){
    $schedule=WPvivid_Schedule::get_schedule();
    if($schedule['enable']){
        $schedule_status='Enabled';
        $next_backup_time=date("l, F d, Y H:i", $schedule['next_start']);
    }
    else{
        $schedule_status='Disabled';
        $next_backup_time='N/A';
    }
    $last_message = '';
    $last_message = apply_filters('wpvivid_get_last_backup_message', $last_message);
    $html = '
    <div class="postbox qucikbackup-schedule" id="wpvivid_postbox_backup_schedule">
        <h2><span>'.__( 'Backup Schedule','wpvivid').'</span></h2>
        <div class="schedule-block">
            <p id="wpvivid_schedule_status"><strong>'.__('Schedule Status: ', 'wpvivid').'</strong>'.$schedule_status.'</p>
            <div id="wpvivid_schedule_info">
                <p><strong>'.__('Server Time: ', 'wpvivid').'</strong>'.date("l, F d, Y H:i",time()).'</p>
                <p><span id="wpvivid_last_backup_msg">'.$last_message.'</span></p>
                <p id="wpvivid_next_backup"><strong>'.__('Next Backup: ', 'wpvivid').'</strong>'.$next_backup_time.'</p>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
    ';
    return $html;
}

add_filter('wpvivid_add_backup_type', 'wpvivid_add_backup_type', 11, 2);
add_action('wpvivid_backup_do_js', 'wpvivid_backup_do_js', 10);
add_filter('wpvivid_download_backup_descript', 'wpvivid_download_backup_descript', 10);
add_filter('wpvivid_restore_website_dexcript', 'wpvivid_restore_website_dexcript', 10);
add_filter('wpvivid_backup_module', 'wpvivid_backup_module');
add_filter('wpvivid_backup_descript', 'wpvivid_backup_descript');
add_filter('wpvivid_backup_part_type', 'wpvivid_backup_part_type');
add_filter('wpvivid_backup_part_pos', 'wpvivid_backup_part_pos');
add_filter('wpvivid_backup_part_exec', 'wpvivid_backup_part_exec');
add_filter('wpvivid_backup_part_tip', 'wpvivid_backup_part_tip');
add_filter('wpvivid_backuppage_load_progress_module', 'wpvivid_backuppage_load_progress_module', 10);
add_filter('wpvivid_backuppage_load_backup_module', 'wpvivid_backuppage_load_backup_module', 10);
add_filter('wpvivid_backuppage_load_schedule_module', 'wpvivid_backuppage_load_schedule_module', 10);
add_filter('wpvivid_backuppage_load_backuplist', 'wpvivid_backuppage_load_backuplist', 10);

?>