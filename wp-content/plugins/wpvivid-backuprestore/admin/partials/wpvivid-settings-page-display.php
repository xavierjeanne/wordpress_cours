<?php

function wpvivid_general_settings()
{
    $general_setting=WPvivid_Setting::get_setting(true, "");
    $display_backup_count = $general_setting['options']['wpvivid_common_setting']['max_backup_count'];
    $display_backup_count=intval($display_backup_count);
    if($general_setting['options']['wpvivid_common_setting']['estimate_backup']){
        $wpvivid_setting_estimate_backup='checked';
    }
    else{
        $wpvivid_setting_estimate_backup='';
    }
    if(!isset($general_setting['options']['wpvivid_common_setting']['show_tab_menu'])){
        $wpvivid_show_tab_menu='checked';
    }
    else {
        if ($general_setting['options']['wpvivid_common_setting']['show_tab_menu']) {
            $wpvivid_show_tab_menu = 'checked';
        } else {
            $wpvivid_show_tab_menu = '';
        }
    }
    if(!isset($general_setting['options']['wpvivid_common_setting']['domain_include'])){
        $wpvivid_domain_include = 'checked';
    }
    else{
        if($general_setting['options']['wpvivid_common_setting']['domain_include']){
            $wpvivid_domain_include = 'checked';
        }
        else{
            $wpvivid_domain_include = '';
        }
    }
    global $wpvivid_pulgin;
    $out_of_date=$wpvivid_pulgin->_get_out_of_date_info();
    ?>
    <tr>
        <td class="row-title wpvivid-backup-settings-table-left tablelistcolumn"><label for="tablecell"><?php _e('General Settings', 'wpvivid'); ?></label></td>
        <td class="tablelistcolumn">
            <div class="postbox schedule-tab-block">
                <div>
                    <select option="setting" name="max_backup_count" id="wpvivid_max_backup_count">
                        <?php
                        for($i=1; $i<8;$i++){
                            if($i === $display_backup_count){
                                _e('<option selected="selected" value="' . $i . '">' . $i . '</option>', 'wpvivid');
                            }
                            else {
                                _e('<option value="' . $i . '">' . $i . '</option>', 'wpvivid');
                            }
                        }
                        ?>
                    </select><strong><?php _e('backups retained', 'wpvivid'); ?></strong>
                </div>
                <div>
                    <label for="wpvivid_estimate_backup">
                        <input type="checkbox" option="setting" name="estimate_backup" id="wpvivid_estimate_backup" value="1" <?php esc_attr_e($wpvivid_setting_estimate_backup, 'wpvivid'); ?> />
                        <span><?php _e( 'Calculate the size of files, folder and database before backing up ', 'wpvivid' ); ?></span>
                    </label>
                </div>
                <div>
                    <label>
                        <input type="checkbox" option="setting" name="show_tab_menu" <?php esc_attr_e($wpvivid_show_tab_menu); ?> />
                        <span><?php _e('Display the tab pages in admin navigation menu', 'wpvivid'); ?></span>
                    </label>
                </div>
            </div>
            <div class="postbox schedule-tab-block">
                <div><strong><?php _e('Backup Folder', 'wpvivid'); ?></strong></div>
                <div class="schedule-tab-block setting-page-content">
                    <div><p><?php _e( 'Name your folder, this folder must be writable for creating backup files.', 'wpvivid' ); ?><p> </div>
                    <input type="text" placeholder="wpvividbackups" option="setting" name="path" id="wpvivid_option_backup_dir" class="all-options" value="<?php esc_attr_e($general_setting['options']['wpvivid_local_setting']['path'], 'wpvivid'); ?>" onkeyup="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')" onpaste="value=value.replace(/[^\a-\z\A-\Z0-9]/g,'')" />
                    <p><span><?php _e('Local storage directory:', 'wpvivid'); ?></span><span><?php echo WP_CONTENT_DIR.'/'; ?><span id="wpvivid_setting_local_storage_path"><?php _e($general_setting['options']['wpvivid_local_setting']['path'], 'wpvivid'); ?></span></span></p>
                </div>
                <div>
                    <label>
                        <input type="checkbox" option="setting" name="domain_include" <?php esc_attr_e($wpvivid_domain_include); ?> />
                        <span><?php _e('Display domain(url) of current site in backup name. (e.g. domain_wpvivid-5ceb938b6dca9_2019-05-27-07-36_backup_all.zip)', 'wpvivid'); ?></span>
                    </label>
                </div>
            </div>
            <div class="postbox schedule-tab-block">
                <div><strong><?php _e('Remove out-of-date backups', 'wpvivid'); ?></strong></div>
                <div class="schedule-tab-block">
                    <fieldset>
                        <label for="users_can_register">
                            <p><span><?php _e('Web Server Directory:', 'wpvivid'); ?></span><span id="wpvivid_out_of_date_local_path"><?php _e($out_of_date['web_server'], 'wpvivid'); ?></span></p>
                            <p><span><?php _e('Remote Storage Directory:', 'wpvivid'); ?></span><span id="wpvivid_out_of_date_remote_path">
                                    <?php
                                        $wpvivid_get_remote_directory = '';
                                        $wpvivid_get_remote_directory = apply_filters('wpvivid_get_remote_directory', $wpvivid_get_remote_directory);
                                        echo $wpvivid_get_remote_directory;
                                    ?>
                                </span>
                            </p>
                        </label>
                    </fieldset>
                </div>
                <div class="schedule-tab-block"><input class="button-primary" id="wpvivid_delete_out_of_backup" style="margin-right:10px;" type="submit" name="delete-out-of-backup" value="<?php esc_attr_e( 'Remove', 'wpvivid' ); ?>" />
                    <p><?php _e('The action is irreversible! It will remove all backups which is(are) out-of-date (including local web server and remote storage) if they exist.', 'wpvivid'); ?> </p>
                </div>
            </div>
        </td>
    </tr>
    <?php
}

function wpvivid_compressing()
{
    $general_setting=WPvivid_Setting::get_setting(true, "");
    $wpvivid_setting_no_compress='';
    $wpvivid_setting_compress='';
    if($general_setting['options']['wpvivid_compress_setting']['no_compress']){
        $wpvivid_setting_no_compress='checked';
    }
    else{
        $wpvivid_setting_compress='checked';
    }
    ?>
    <tr>
        <td class="row-title wpvivid-backup-settings-table-left tablelistcolumn"><label for="tablecell" id="wpvivid_archive_type_item"><?php _e('Choose How to Archive Your Backups', 'wpvivid'); ?></label></td>
        <td class="tablelistcolumn">
            <div class="postbox schedule-tab-block setting-page-content" id="wpvivid_archive_type">
                <fieldset>
                    <label>
                        <input type="radio" option="setting" name="no_compress" value="1" <?php esc_attr_e($wpvivid_setting_no_compress, 'wpvivid'); ?> />
                        <span><?php _e( 'Only Archive without compressing', 'wpvivid' ); ?></span>
                        <span><?php _e( 'It will cause a lower CPU Usage and is recommended in a web hosting/ shared hosting environment.', 'wpvivid' ); ?></span>
                    </label><br>
                    <label>
                        <input type="radio" option="setting" name="no_compress" value="0" <?php esc_attr_e($wpvivid_setting_compress, 'wpvivid'); ?> />
                        <span><?php _e( 'Compress and Archive', 'wpvivid' ); ?></span>
                        <span><?php _e( 'It will cause a higher CPU Usage and is recommended in a VPS/ dedicated hosting environment.', 'wpvivid' ); ?></span>
                    </label>
                    <label style="display: none;">
                        <input type="radio" option="setting" name="compress_type" value="zip" checked />
                        <input type="radio" option="setting" name="use_temp_file" value="1" checked />
                        <input type="radio" option="setting" name="use_temp_size" value="16" checked />
                    </label>
                </fieldset>
            </div>
        </td>
    </tr>
    <?php
}

function wpvivid_email_report()
{
    $general_setting=WPvivid_Setting::get_setting(true, "");
    $setting_email_enable='';
    $setting_email_display = 'display: none;';
    if(isset($general_setting['options']['wpvivid_email_setting']['email_enable'])){
        if($general_setting['options']['wpvivid_email_setting']['email_enable']){
            $setting_email_enable='checked';
            $setting_email_display = '';
        }
    }
    $wpvivid_setting_email_always='';
    $wpvivid_setting_email_failed='';
    if($general_setting['options']['wpvivid_email_setting']['always']) {
        $wpvivid_setting_email_always='checked';
    }
    else{
        $wpvivid_setting_email_failed='checked';
    }
    ?>
    <tr>
        <td class="row-title wpvivid-backup-settings-table-left tablelistcolumn"><label for="tablecell" id="wpvivid_email_report_item"><?php _e('Email Report', 'wpvivid'); ?></label></td>
        <td class="tablelistcolumn">
            <div class="postbox schedule-tab-block" id="wpvivid_email_report">
                <div><p><?php _e('In order to use this function, please install a ', 'wpvivid'); ?><strong><a target="_blank" href="https://wpvivid.com/8-best-smtp-plugins-for-wordpress.html"><?php _e('WordPress SMTP plugin', 'wpvivid'); ?></a></strong><?php _e(' of your preference and configure your SMTP server  first. This is because WordPress uses the PHP Mail function to send its emails by default, which is not supported by many hosts and can cause issues if it is not set properly.', 'wpvivid'); ?></p>
                </div>
                <div>
                    <label for="wpvivid_general_email_enable">
                        <input type="checkbox" option="setting" name="email_enable" id="wpvivid_general_email_enable" value="1" <?php esc_attr_e($setting_email_enable, 'wpvivid'); ?> />
                        <span><strong><?php _e( 'Enable email report', 'wpvivid' ); ?></strong></span>
                    </label>
                </div>
                <div id="wpvivid_general_email_setting" style="<?php esc_attr_e($setting_email_display, 'wpvivid'); ?>" >
                    <input type="text" placeholder="example@yourdomain.com" option="setting" name="send_to" class="regular-text" id="wpvivid_mail" value="<?php
                    foreach ($general_setting['options']['wpvivid_email_setting']['send_to'] as $mail) {
                        _e($mail, 'wpvivid');
                        break;
                    }
                    ?>" />
                    <input class="button-secondary" id="wpvivid_send_email_test" style="margin-top:10px;" type="submit" name="" value="<?php esc_attr_e( 'Test Email', 'wpvivid' ); ?>" title="Send an email for testing mail function"/>
                    <div id="wpvivid_send_email_res"></div>
                    <fieldset class="schedule-tab-block">
                        <label >
                            <input type="radio" option="setting" name="always" value="1" <?php esc_attr_e($wpvivid_setting_email_always, 'wpvivid'); ?> />
                            <span><?php _e( 'Always send an email notification when a backup is complete', 'wpvivid' ); ?></span>
                        </label><br>
                        <label >
                            <input type="radio" option="setting" name="always" value="0" <?php esc_attr_e($wpvivid_setting_email_failed, 'wpvivid'); ?> />
                            <span><?php _e( 'Only send an email notification when a backup fails', 'wpvivid' ); ?></span>
                        </label>
                    </fieldset>
                </div>
            </div>
        </td>
    </tr>
    <?php
}

function wpvivid_clean_junk()
{
    global $wpvivid_pulgin;
    $junk_file=$wpvivid_pulgin->_junk_files_info();
    ?>
    <tr>
        <td class="row-title wpvivid-backup-settings-table-left tablelistcolumn"><label for="tablecell" id="wpvivid_clean_junk_item"><?php _e('Clean Junk', 'wpvivid'); ?></label></td>
        <td class="tablelistcolumn">
            <div class="postbox schedule-tab-block" id="wpvivid_clean_junk">
                <div><p><?php _e('Web-server disk space in use by WPvivid:', 'wpvivid'); ?></p>
                    <div class="schedule-tab-block"><span class="schedule-tab-block"><?php _e('Total Size:', 'wpvivid'); ?></span><span id="wpvivid_junk_sum_size"><?php _e($junk_file['sum_size'], 'wpvivid'); ?></span><input class="button-secondary" id="wpvivid_calculate_size" style="margin-left:10px;" type="submit" name="Calculate-Sizes" value="<?php esc_attr_e( 'Calculate Sizes', 'wpvivid' ); ?>" /></div>

                </div>
                <div class="schedule-tab-block">
                    <fieldset>
                        <label for="wpvivid_junk_log">
                            <input type="checkbox" id="wpvivid_junk_log" option="junk-files" name="log" value="junk-log" />
                            <span><?php _e( 'logs', 'wpvivid' ); ?></span>
                            <span><?php _e('Path:', 'wpvivid' ); ?></span><span id="wpvivid_junk_log_path"><?php _e($junk_file['log_path'], 'wpvivid'); ?></span>
                        </label>
                    </fieldset>
                    <fieldset>
                        <label for="wpvivid_junk_backup_cache">
                            <input type="checkbox" id="wpvivid_junk_backup_cache" option="junk-files" name="backup_cache" value="junk-backup-cache" />
                            <span><?php _e( 'Backup Cache', 'wpvivid' ); ?></span>
                        </label>
                        <label for="wpvivid_junk_file">
                            <input type="checkbox" id="wpvivid_junk_file" option="junk-files" name="junk_files" value="junk-files" />
                            <span><?php _e( 'Junk', 'wpvivid' ); ?></span>
                            <span><?php _e('Path:', 'wpvivid' ); ?></span><span id="wpvivid_junk_file_path"><?php _e($junk_file['junk_path'], 'wpvivid'); ?></span>
                        </label>
                    </fieldset>
                    <fieldset>
                        <label for="wpvivid_junk_temporary_file">
                            <input type="checkbox" id="wpvivid_junk_temporary_file" option="junk-files" name="old_files" value="junk-temporary-files" />
                            <span><?php _e( 'Temporary Files', 'wpvivid' ); ?></span>
                            <span><?php _e('Path:', 'wpvivid'); ?></span><span id="wpvivid_restore_temp_file_path"><?php _e($junk_file['old_files_path'], 'wpvivid'); ?></span>
                            <p><?php _e('Temporary Files are created by wpvivid when restoring a website.', 'wpvivid'); ?></p>
                        </label>
                    </fieldset>
                </div>
                <div><input class="button-primary" id="wpvivid_clean_junk_file" type="submit" name="Empty-all-files" value="<?php esc_attr_e( 'Empty', 'wpvivid' ); ?>" /></div>
                <div style="clear:both;"></div>
            </div>
        </td>
    </tr>
    <?php
}

function wpvivid_export_import_settings()
{
    ?>
    <tr>
        <td class="row-title wpvivid-backup-settings-table-left tablelistcolumn"><label for="tablecell" id="wpvivid_export_import_item"><?php _e('Export / import settings', 'wpvivid'); ?></label></td>
        <td class="tablelistcolumn">
            <div class="postbox schedule-tab-block" id="wpvivid_export_import">
                <div class="schedule-tab-block">
                    <input class="button-primary" id="wpvivid_setting_export" type="button" name="" value="<?php esc_attr_e( 'Export', 'wpvivid' ); ?>" />
                    <p><?php _e('Click \'Export\' button to save WPvivid settings on your local computer.', 'wpvivid'); ?> </p>
                </div>
                <div class="schedule-tab-block">
                    <input type="file" name="fileTrans" id="wpvivid_select_import_file"></br>
                    <input class="button-primary" id="wpvivid_setting_import" type="button" name="" value="<?php esc_attr_e( 'Import', 'wpvivid' ); ?>" />
                    <p><?php _e('Importing the json file can help you set WPvivid\'s configuration on another wordpress site quickly.', 'wpvivid'); ?></p>
                </div>
                <div style="clear:both;"></div>
            </div>
        </td>
    </tr>
    <?php
}

function wpvivid_advanced_settings()
{
    $general_setting=WPvivid_Setting::get_setting(true, "");
    $wpvivid_setting_no_compress='';
    $wpvivid_setting_compress='';
    if($general_setting['options']['wpvivid_compress_setting']['no_compress']){
        $wpvivid_setting_no_compress='checked';
    }
    else{
        $wpvivid_setting_compress='checked';
    }

    if(!isset($general_setting['options']['wpvivid_compress_setting']['subpackage_plugin_upload'])){
        $subpackage_plugin_upload = '';
    }
    else{
        if($general_setting['options']['wpvivid_compress_setting']['subpackage_plugin_upload']){
            $subpackage_plugin_upload = 'checked';
        }
        else{
            $subpackage_plugin_upload = '';
        }
    }
    if(!isset($general_setting['options']['wpvivid_common_setting']['max_resume_count'])){
        $wpvivid_max_resume_count = WPVIVID_RESUME_RETRY_TIMES;
    }
    else{
        $wpvivid_max_resume_count = intval($general_setting['options']['wpvivid_common_setting']['max_resume_count']);
    }
    if(!isset($general_setting['options']['wpvivid_common_setting']['memory_limit'])){
        $general_setting['options']['wpvivid_common_setting']['memory_limit']=WPVIVID_MEMORY_LIMIT;
    }
    if(!isset($general_setting['options']['wpvivid_common_setting']['restore_memory_limit'])){
        $general_setting['options']['wpvivid_common_setting']['restore_memory_limit']=WPVIVID_RESTORE_MEMORY_LIMIT;
    }
    if(!isset($general_setting['options']['wpvivid_common_setting']['migrate_size'])){
        $general_setting['options']['wpvivid_common_setting']['migrate_size']=WPVIVID_MIGRATE_SIZE;
    }
    ?>
    <tr>
        <td class="row-title wpvivid-backup-settings-table-left tablelistcolumn"><label for="tablecell"><?php _e('Advanced', 'wpvivid'); ?></label></td>
        <td class="tablelistcolumn">
            <div class="postbox schedule-tab-block setting-page-content">
                <div>
                    <p><strong><?php _e('Enable the option when backup failed.', 'wpvivid'); ?></strong><?php _e(' Special optimization for web hosting/shared hosting', 'wpvivid'); ?></p>
                    <div>
                        <label>
                            <input type="checkbox" option="setting" name="subpackage_plugin_upload" <?php esc_attr_e($subpackage_plugin_upload); ?> />
                            <span><strong><?php _e('Enable optimization mode for web hosting/shared hosting', 'wpvivid'); ?></strong></span>
                        </label>
                        <div>
                            <p><?php _e('Enabling this option can improve the backup success rate, but it will take more time for backup.', 'wpvivid'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="postbox schedule-tab-block setting-page-content">
                <fieldset>
                    <label>
                        <input type="radio" option="setting" name="no_compress" value="1" <?php esc_attr_e($wpvivid_setting_no_compress, 'wpvivid'); ?> />
                        <span title="<?php _e( 'It will cause a lower CPU Usage and is recommended in a web hosting/ shared hosting environment.', 'wpvivid' ); ?>"><?php _e( 'Only Archive without compressing', 'wpvivid' ); ?></span>
                    </label>
                    <label>
                        <input type="radio" option="setting" name="no_compress" value="0" <?php esc_attr_e($wpvivid_setting_compress, 'wpvivid'); ?> />
                        <span title="<?php _e( 'It will cause a higher CPU Usage and is recommended in a VPS/ dedicated hosting environment.', 'wpvivid' ); ?>"><?php _e( 'Compress and Archive', 'wpvivid' ); ?></span>
                    </label>
                    <label style="display: none;">
                        <input type="radio" option="setting" name="compress_type" value="zip" checked />
                        <input type="radio" option="setting" name="use_temp_file" value="1" checked />
                        <input type="radio" option="setting" name="use_temp_size" value="16" checked />
                    </label>
                </fieldset>

                <div style="padding-top: 10px;">
                    <div><strong><?php _e('Compress Files Every', 'wpvivid'); ?></strong></div>
                    <div class="schedule-tab-block setting-page-content">
                        <input type="text" placeholder="400" option="setting" name="max_file_size" id="wpvivid_max_zip" class="all-options" value="<?php esc_attr_e(str_replace('M', '', $general_setting['options']['wpvivid_compress_setting']['max_file_size']), 'wpvivid'); ?>" onkeyup="value=value.replace(/\D/g,'')" />MB
                        <div><p><?php _e( 'Some web hosting providers limit large zip files (e.g. 200MB), and therefore splitting your backup into many parts is an ideal way to avoid to hit the limitation if you are running a big website.  Please try to adjust the value if you are encountering backup errors. If you use a value of 0 MB, any backup files won\'t be split.', 'wpvivid' ); ?></div></p>
                    </div>
                    <div><strong><?php _e('Exclude the files which are larger than', 'wpvivid'); ?></strong></div>
                    <div class="schedule-tab-block setting-page-content">
                        <input type="text" placeholder="400" option="setting" name="exclude_file_size" id="wpvivid_ignore_large" class="all-options" value="<?php esc_attr_e($general_setting['options']['wpvivid_compress_setting']['exclude_file_size'], 'wpvivid'); ?>" onkeyup="value=value.replace(/\D/g,'')" />MB
                        <div><p><?php _e( 'Using the option will ignore the file larger than the certain size in MB when backing up, \'0\' (zero) means unlimited.', 'wpvivid' ); ?></p></div>
                    </div>
                    <div><strong><?php _e('PHP script execution timeout', 'wpvivid'); ?></strong></div>
                    <div class="schedule-tab-block setting-page-content">
                        <input type="text" placeholder="600" option="setting" name="max_execution_time" id="wpvivid_option_timeout" class="all-options" value="<?php esc_attr_e($general_setting['options']['wpvivid_common_setting']['max_execution_time'], 'wpvivid'); ?>" onkeyup="value=value.replace(/\D/g,'')" />Seconds
                        <div><p><?php _e( 'The time-out is not your server PHP time-out. With the execution time exhausted, our plugin will shut the process of backup down. If the progress of backup encounters a time-out, that means you have a medium or large sized website, please try to scale the value bigger. ', 'wpvivid' ); ?></p></div>
                    </div>
                    <div><strong><?php _e('PHP Memory Limit for backup', 'wpvivid'); ?></strong></div>
                    <div class="schedule-tab-block setting-page-content">
                        <input type="text" placeholder="256" option="setting" name="memory_limit" class="all-options" value="<?php esc_attr_e(str_replace('M', '', $general_setting['options']['wpvivid_common_setting']['memory_limit']), 'wpvivid'); ?>" onkeyup="value=value.replace(/\D/g,'')" />MB
                        <div><p><?php _e('Adjust this value to apply for a temporary PHP memory limit for WPvivid backup plugin to run a backup. We set this value to 256M by default. Increase the value if you encounter a memory exhausted error. Note: some web hosting providers may not support this.', 'wpvivid'); ?></p></div>
                    </div>
                    <div><strong><?php _e('PHP Memory Limit for restoration', 'wpvivid'); ?></strong></div>
                    <div class="schedule-tab-block setting-page-content">
                        <input type="text" placeholder="256" option="setting" name="restore_memory_limit" class="all-options" value="<?php esc_attr_e(str_replace('M', '', $general_setting['options']['wpvivid_common_setting']['restore_memory_limit']), 'wpvivid'); ?>" onkeyup="value=value.replace(/\D/g,'')" />MB
                        <div><p><?php _e('Adjust this value to apply for a temporary PHP memory limit for WPvivid backup plugin in restore process. We set this value to 256M by default. Increase the value if you encounter a memory exhausted error. Note: some web hosting providers may not support this.', 'wpvivid'); ?></p></div>
                    </div>
                    <div><strong><?php _e('Chunk Size', 'wpvivid'); ?></strong></div>
                    <div class="schedule-tab-block setting-page-content">
                        <input type="text" placeholder="2" option="setting" name="migrate_size" class="all-options" value="<?php esc_attr_e($general_setting['options']['wpvivid_common_setting']['migrate_size']); ?>" onkeyup="value=value.replace(/\D/g,'')" />KB
                        <div><p><?php _e('e.g.  if you choose a chunk size of 2MB, a 8MB file will use 4 chunks. Decreasing this value will break the ISP\'s transmission limit, for example:512KB', 'wpvivid'); ?></p></div>
                    </div>
                    <div>
                        <strong>Retrying </strong>
                        <select option="setting" name="max_resume_count">
                            <?php
                            for($resume_count=3; $resume_count<10; $resume_count++){
                                if($resume_count === $wpvivid_max_resume_count){
                                    _e('<option selected="selected" value="'.$resume_count.'">'.$resume_count.'</option>');
                                }
                                else{
                                    _e('<option value="'.$resume_count.'">'.$resume_count.'</option>');
                                }
                            }
                            ?>
                        </select><strong><?php _e(' times when encountering a time-out error', 'wpvivid'); ?></strong>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    <?php
}

add_action('wpvivid_setting_add_cell','wpvivid_general_settings',10);
//add_action('wpvivid_setting_add_cell','wpvivid_compressing',12);
add_action('wpvivid_setting_add_cell','wpvivid_email_report',13);
add_action('wpvivid_setting_add_cell','wpvivid_clean_junk',14);
add_action('wpvivid_setting_add_cell','wpvivid_advanced_settings',15);
add_action('wpvivid_setting_add_cell','wpvivid_export_import_settings',16);
?>
