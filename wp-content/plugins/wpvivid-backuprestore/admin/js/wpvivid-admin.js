var task_retry_times=0;
var running_backup_taskid='';
var tmp_current_click_backupid = '';
var m_need_update=true;
var m_restore_backup_id;
var m_backup_task_id;
var m_downloading_file_name = '';
var m_downloading_id = '';
var wpvivid_settings_changed = false;
var wpvivid_cur_log_page = 1;
var wpvivid_completed_backup = 1;
var wpvivid_prepare_backup=false;
var wpvivid_restoring=false;
var wpvivid_location_href=false;
var wpvivid_editing_storage_id = '';
var wpvivid_editing_storage_type = '';
var wpvivid_restore_download_array;
var wpvivid_restore_download_index = 0;
var wpvivid_get_download_restore_progress_retry = 0;
var wpvivid_restore_timeout = false;
var wpvivid_restore_need_download = false;
var wpvivid_display_restore_backup = false;
var wpvivid_restore_backup_type = '';
var wpvivid_display_restore_check = false;
var wpvivid_restore_sure = false;
var wpvivid_resotre_is_migrate=0;
(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    $(document).ready(function () {
        wpvivid_getrequest();

        wpvivid_activate_cron();

        wpvivid_manage_task();

        wpvivid_interface_flow_control();

        $('#wpvivid_quickbackup_btn').click(function(){
            wpvivid_clear_notice('wpvivid_backup_notice');
            wpvivid_start_backup();
        });

        $('#wpvivid_setting_general_save').click(function(){
            wpvivid_set_general_settings();
            wpvivid_settings_changed = false;
        });

        $('#wpvivid_schedule_save').click(function(){
            wpvivid_set_schedule();
            wpvivid_settings_changed = false;
        });

        $('input[option=add-remote]').click(function(){
            var storage_type = $(".storage-providers-active").attr("remote_type");
            wpvivid_add_remote_storage(storage_type);
            wpvivid_settings_changed = false;
        });

        $('input[option=edit-remote]').click(function(){
            wpvivid_edit_remote_storage();
        });

        $('#backup_list_all_check').click(function(){
            var name = '';
            if($('#backup_list_all_check').prop('checked')) {
                $('#wpvivid_backuplist tr').each(function (i) {
                    $(this).children('th').each(function (j) {
                        if (j == 0) {
                            name = jQuery(this).parent().children('td').eq(0).find("img").attr("name");
                            if(name === 'unlock') {
                                $(this).find("input[type=checkbox]").prop('checked', true);
                            }
                            else{
                                $(this).find("input[type=checkbox]").prop('checked', false);
                            }
                        }
                    });
                });
            }
            else{
                $('#wpvivid_backuplist tr').each(function (i) {
                    $(this).children('th').each(function (j) {
                        if (j == 0) {
                            $(this).find("input[type=checkbox]").prop('checked', false);
                        }
                    });
                });
            }
        });

        $('#wpvivid_backup_cancel_btn').click(function(){
            wpvivid_cancel_backup();
        });

        $('#wpvivid_backup_log_btn').click(function(){
            wpvivid_read_log('wpvivid_view_backup_task_log');
        });

        $('#wpvivid_send_email_test').click(function(){
            wpvivid_email_test();
        });

        $('#wpvivid_setting_export').click(function(){
            wpvivid_export_settings();
        });

        $('#wpvivid_setting_import').click(function(){
            wpvivid_import_settings();
        });

        $('#wpvivid_set_default_remote_storage').click(function(){
            wpvivid_set_default_remote_storage();
            wpvivid_settings_changed = false;
        });

        $('#wpvivid_display_log_count').on("change", function(){
            wpvivid_display_log_page();
        });

        $('#wpvivid_pre_log_page').click(function(){
           wpvivid_pre_log_page();
        });

        $('#wpvivid_next_log_page').click(function(){
            wpvivid_next_log_page();
        });

        $('#wpvivid_clean_restore').click(function(){
            wpvivid_delete_incompleted_restore();
        });

        $('#wpvivid_download_btn').click(function(){
            wpvivid_download_restore_file('backup');
        });

        $('#wpvivid_rollback_btn').click(function(){
            wpvivid_start_rollback();
        });

        $('#wpvivid_delete_out_of_backup').click(function(){
            wpvivid_delete_out_of_date_backups();
        });

        $('#wpvivid_calculate_size').click(function(){
            wpvivid_calculate_diskspaceused();
        });

        $('#wpvivid_clean_junk_file').click(function(){
            wpvivid_clean_junk_files();
        });

        $('#wpvivid_download_website_info').click(function(){
            wpvivid_download_website_info();
        });

        $('input[option=review]').click(function(){
            var name = jQuery(this).prop('name');
            wpvivid_add_review_info(name);
        });
    });
    
})(jQuery);

function wpvivid_popup_tour(style) {
    var popup = document.getElementById("wpvivid_popup_tour");
    if (popup != null) {
        popup.classList.add(style);
    }
}

function click_dismiss_restore_notice(obj){
    wpvivid_display_restore_backup = false;
    jQuery(obj).parent().remove();
}

function wpvivid_click_how_to_restore_backup(){
    if(!wpvivid_display_restore_backup){
        wpvivid_display_restore_backup = true;
        var top = jQuery('#wpvivid_how_to_restore_backup_describe').offset().top-jQuery('#wpvivid_how_to_restore_backup_describe').height();
        jQuery('html, body').animate({scrollTop:top}, 'slow');
        var div = "<div class='notice notice-info is-dismissible inline'>" +
            "<p>Step One: In the backup list, click the 'Restore' button on the backup you want to restore. This will bring up the restore tab</p>" +
            "<p>Step Two: Choose an option to complete restore, if any</p>" +
            "<p>Step Three: Click 'Restore' button</p>" +
            "<button type='button' class='notice-dismiss' onclick='click_dismiss_restore_notice(this);'>" +
            "<span class='screen-reader-text'>Dismiss this notice.</span>" +
            "</button>" +
            "</div>";
        jQuery('#wpvivid_how_to_restore_backup').append(div);
    }
}

window.onbeforeunload = function(e) {
    if (wpvivid_settings_changed) {
        if (wpvivid_location_href){
            wpvivid_location_href = false;
        }
        else {
            return 'You are leaving the page without saving your changes, any unsaved changes on the page will be lost, are you sure you want to continue?';
        }
    }
}

/**
 * Refresh the scheduled task list as regularly as a preset interval(3-minute), to retrieve and activate the scheduled cron jobs.
 */
function wpvivid_activate_cron(){
    var next_get_time = 3 * 60 * 1000;
    wpvivid_cron_task();
    setTimeout("wpvivid_activate_cron()", next_get_time);
    setTimeout(function(){
        m_need_update=true;
    }, 10000);
}

/**
 * Send an Ajax request
 *
 * @param ajax_data         - Data in Ajax request
 * @param callback          - A callback function when the request is succeeded
 * @param error_callback    - A callback function when the request is failed
 * @param time_out          - The timeout for Ajax request
 */
function wpvivid_post_request(ajax_data, callback, error_callback, time_out){
    if(typeof time_out === 'undefined')    time_out = 30000;
    jQuery.ajax({
        type: "post",
        url: ajax_object.ajax_url,
        data: ajax_data,
        success: function (data) {
            callback(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            error_callback(XMLHttpRequest, textStatus, errorThrown);
        },
        timeout: time_out
    });
}

/**
 * Check if there are running tasks (backup and download)
 */
function wpvivid_check_runningtask(){
    var ajax_data = {
        'action': 'wpvivid_list_tasks',
        'backup_id': tmp_current_click_backupid
    };
    if(wpvivid_restoring === false) {
        wpvivid_post_request(ajax_data, function (data) {
            setTimeout(function () {
                wpvivid_manage_task();
            }, 3000);
            try {
                var jsonarray = jQuery.parseJSON(data);
                if (jsonarray.success_notice_html != false) {
                    jQuery('#wpvivid_backup_notice').show();
                    jQuery('#wpvivid_backup_notice').append(jsonarray.success_notice_html);
                }
                if(jsonarray.error_notice_html != false){
                    jQuery('#wpvivid_backup_notice').show();
                    jQuery.each(jsonarray.error_notice_html, function (index, value) {
                        jQuery('#wpvivid_backup_notice').append(value.error_msg);
                    });
                }
                if(jsonarray.backuplist_html != false) {
                    jQuery('#wpvivid_backuplist').html('');
                    jQuery('#wpvivid_backuplist').append(jsonarray.backuplist_html);
                }
                var b_has_data = false;
                if (jsonarray.backup.data.length !== 0) {
                    b_has_data = true;
                    task_retry_times = 0;
                    if (jsonarray.backup.result === 'success') {
                        wpvivid_prepare_backup = false;
                        jQuery.each(jsonarray.backup.data, function (index, value) {
                            if (value.status.str === 'ready') {
                                jQuery('#wpvivid_postbox_backup_percent').html(value.progress_html);
                                m_need_update = true;
                            }
                            else if (value.status.str === 'running') {
                                running_backup_taskid = index;
                                wpvivid_control_backup_lock();
                                jQuery('#wpvivid_postbox_backup_percent').show();
                                jQuery('#wpvivid_postbox_backup_percent').html(value.progress_html);
                                m_need_update = true;
                            }
                            else if (value.status.str === 'wait_resume') {
                                running_backup_taskid = index;
                                wpvivid_control_backup_lock();
                                jQuery('#wpvivid_postbox_backup_percent').show();
                                jQuery('#wpvivid_postbox_backup_percent').html(value.progress_html);
                                if (value.data.next_resume_time !== 'get next resume time failed.') {
                                    wpvivid_resume_backup(index, value.data.next_resume_time);
                                }
                                else {
                                    wpvivid_delete_backup_task(index);
                                }
                            }
                            else if (value.status.str === 'no_responds') {
                                running_backup_taskid = index;
                                wpvivid_control_backup_lock();
                                jQuery('#wpvivid_postbox_backup_percent').show();
                                jQuery('#wpvivid_postbox_backup_percent').html(value.progress_html);
                                m_need_update = true;
                            }
                            else if (value.status.str === 'completed') {
                                jQuery('#wpvivid_postbox_backup_percent').html(value.progress_html);
                                wpvivid_control_backup_unlock();
                                jQuery('#wpvivid_postbox_backup_percent').hide();
                                jQuery('#wpvivid_last_backup_msg').html(jsonarray.last_msg_html);
                                jQuery('#wpvivid_loglist').html("");
                                jQuery('#wpvivid_loglist').append(jsonarray.log_html);
                                wpvivid_log_count = jsonarray.log_count;
                                wpvivid_display_log_page();
                                running_backup_taskid = '';
                                m_backup_task_id = '';
                                m_need_update = true;
                            }
                            else if (value.status.str === 'error') {
                                jQuery('#wpvivid_postbox_backup_percent').html(value.progress_html);
                                wpvivid_control_backup_unlock();
                                jQuery('#wpvivid_postbox_backup_percent').hide();
                                jQuery('#wpvivid_last_backup_msg').html(jsonarray.last_msg_html);
                                jQuery('#wpvivid_loglist').html("");
                                jQuery('#wpvivid_loglist').append(jsonarray.log_html);
                                running_backup_taskid = '';
                                m_backup_task_id = '';
                                m_need_update = true;
                            }
                        });
                    }
                }
                else
                {
                    if(running_backup_taskid !== '')
                    {
                        jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        jQuery('#wpvivid_backup_log_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        wpvivid_control_backup_unlock();
                        jQuery('#wpvivid_postbox_backup_percent').hide();
                        wpvivid_retrieve_backup_list();
                        wpvivid_retrieve_last_backup_message();
                        wpvivid_retrieve_log_list();
                        running_backup_taskid='';
                    }
                }
                if (jsonarray.download.length !== 0) {
                    if(jsonarray.download.result === 'success') {
                        b_has_data = true;
                        task_retry_times = 0;
                        var i = 0;
                        var file_name = '';
                        jQuery('#wpvivid_file_part_' + tmp_current_click_backupid).html("");
                        var b_download_finish = false;
                        jQuery.each(jsonarray.download.files, function (index, value) {
                            i++;
                            file_name = index;
                            var progress = '0%';
                            if (value.status === 'need_download') {
                                if (m_downloading_file_name === file_name) {
                                    m_need_update = true;
                                }
                                jQuery('#wpvivid_file_part_' + tmp_current_click_backupid).append(value.html);
                                //b_download_finish=true;
                            }
                            else if (value.status === 'running') {
                                if (m_downloading_file_name === file_name) {
                                    wpvivid_lock_download(tmp_current_click_backupid);
                                }
                                m_need_update = true;
                                jQuery('#wpvivid_file_part_' + tmp_current_click_backupid).append(value.html);
                                b_download_finish = false;
                            }
                            else if (value.status === 'completed') {
                                if (m_downloading_file_name === file_name) {
                                    wpvivid_unlock_download(tmp_current_click_backupid);
                                    m_downloading_id = '';
                                    m_downloading_file_name = '';
                                }
                                jQuery('#wpvivid_file_part_' + tmp_current_click_backupid).append(value.html);
                                b_download_finish = true;
                            }
                            else if (value.status === 'error') {
                                if (m_downloading_file_name === file_name) {
                                    wpvivid_unlock_download(tmp_current_click_backupid);
                                    m_downloading_id = '';
                                    m_downloading_file_name = '';
                                }
                                alert(value.error);
                                jQuery('#wpvivid_file_part_' + tmp_current_click_backupid).append(value.html);
                                b_download_finish = true;
                            }
                            else if (value.status === 'timeout') {
                                if (m_downloading_file_name === file_name) {
                                    wpvivid_unlock_download(tmp_current_click_backupid);
                                    m_downloading_id = '';
                                    m_downloading_file_name = '';
                                }
                                alert('Download timeout, please retry.');
                                jQuery('#wpvivid_file_part_' + tmp_current_click_backupid).append(value.html);
                                b_download_finish = true;
                            }
                        });
                        jQuery('#wpvivid_file_part_' + tmp_current_click_backupid).append(jsonarray.download.place_html);
                        if (b_download_finish == true) {
                            tmp_current_click_backupid = '';
                        }
                    }
                    else{
                        b_has_data = true;
                        alert(jsonarray.download.error);
                    }
                }
                if (!b_has_data) {
                    task_retry_times++;
                    if (task_retry_times < 5) {
                        m_need_update = true;
                    }
                }
            }
            catch(err){
                alert(err);
            }
        }, function (XMLHttpRequest, textStatus, errorThrown) {
            setTimeout(function () {
                m_need_update = true;
                wpvivid_manage_task();
            }, 3000);
        });
    }
}

/**
 * This function will cancel a backup
 */
function wpvivid_cancel_backup(){
    var ajax_data= {
        'action': 'wpvivid_backup_cancel',
        'task_id': running_backup_taskid
    };
    jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            jQuery('#wpvivid_current_doing').html(jsonarray.msg);
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'auto', 'opacity': '1'});
        var error_message = wpvivid_output_ajaxerror('cancelling the backup', textStatus, errorThrown);
        wpvivid_add_notice('Backup', 'Error', error_message);
    });
}

function wpvivid_read_log(action, param){
    var tab_id = '';
    var content_id = '';
    var ajax_data = '';
    var show_page = '';
    if(typeof param === 'undefined')    param = '';
    switch(action){
        case 'wpvivid_view_backup_task_log':
            ajax_data = {
                'action':action,
                'id':running_backup_taskid
            };
            tab_id = 'wpvivid_tab_backup_log';
            content_id = 'wpvivid_display_log_content';
            show_page = 'backup_page';
            break;
        case 'wpvivid_read_last_backup_log':
            var ajax_data = {
                'action': action,
                'log_file_name': param
            };
            tab_id = 'wpvivid_tab_backup_log';
            content_id = 'wpvivid_display_log_content';
            show_page = 'backup_page';
            break;
        case 'wpvivid_view_backup_log':
            var ajax_data={
                'action':action,
                'id':param
            };
            tab_id = 'wpvivid_tab_backup_log';
            content_id = 'wpvivid_display_log_content';
            show_page = 'backup_page';
            break;
        case 'wpvivid_view_log':
            var ajax_data={
                'action':action,
                'path':param
            };
            tab_id = 'wpvivid_tab_read_log';
            content_id = 'wpvivid_read_log_content';
            show_page = 'log_page';
            break;
        default:
            break;
    }
    jQuery('#'+tab_id).show();
    jQuery('#'+content_id).html("");
    if(show_page === 'backup_page'){
        //wpvivid_click_switch_backup_page(tab_id);
        wpvivid_click_switch_page('backup', tab_id, true);
    }
    else if(show_page === 'log_page') {
        wpvivid_click_switch_page('wrap', tab_id, true);
    }
    wpvivid_post_request(ajax_data, function(data){
        wpvivid_show_log(data, content_id);
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var div = 'Reading the log failed. Please try again.';
        jQuery('#wpvivid_display_log_content').html(div);
    });
}

/**
 * This function will show the log on a text box.
 *
 * @param data - The log message returned by server
 */
function wpvivid_show_log(data, content_id){
    jQuery('#'+content_id).html("");
    try {
        var jsonarray = jQuery.parseJSON(data);
        if (jsonarray.result === "success") {
            var log_data = jsonarray.data;
            while (log_data.indexOf('\n') >= 0) {
                var iLength = log_data.indexOf('\n');
                var log = log_data.substring(0, iLength);
                log_data = log_data.substring(iLength + 1);
                var insert_log = "<div style=\"clear:both;\">" + log + "</div>";
                jQuery('#'+content_id).append(insert_log);
            }
        }
        else if (jsonarray.result === "failed") {
            jQuery('#'+content_id).html(jsonarray.error);
        }
    }
    catch(err){
        alert(err);
        var div = "Reading the log failed. Please try again.";
        jQuery('#'+content_id).html(div);
    }
}

function wpvivid_control_backup_lock(){
    jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_transfer_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
}

function wpvivid_control_backup_unlock(){
    jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_transfer_btn').css({'pointer-events': 'auto', 'opacity': '1'});
}

/**
 * Start backing up
 */
function wpvivid_start_backup(){
    var bcheck=true;
    var bdownloading=false;
    if(m_downloading_id !== '') {
        var descript = 'This request might delete the backup being downloaded, are you sure you want to continue?';
        var ret = confirm(descript);
        if (ret === true) {
            bcheck=true;
            bdownloading=true;
        }
        else{
            bcheck=false;
        }
    }
    if(bcheck) {
        var backup_data = wpvivid_ajax_data_transfer('backup');
        backup_data = JSON.parse(backup_data);
        jQuery('input:radio[option=backup_ex]').each(function() {
            if(jQuery(this).prop('checked'))
            {
                var key = jQuery(this).prop('name');
                var value = jQuery(this).prop('value');
                var json = new Array();
                if(value == 'local'){
                    json['local']='1';
                    json['remote']='0';
                }
                else if(value == 'remote'){
                    json['local']='0';
                    json['remote']='1';
                }
            }
            jQuery.extend(backup_data, json);
        });
        backup_data = JSON.stringify(backup_data);
        var ajax_data = {
            'action': 'wpvivid_prepare_backup',
            'backup': backup_data
        };
        //jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        wpvivid_control_backup_lock();
        jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_backup_log_btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_postbox_backup_percent').show();
        jQuery('#wpvivid_current_doing').html('Ready to backup. Progress: 0%, running time: 0second.');
        var percent = '0%';
        jQuery('#wpvivid_action_progress_bar_percent').css('width', percent);
        jQuery('#wpvivid_backup_database_size').html('N/A');
        jQuery('#wpvivid_backup_file_size').html('N/A');
        jQuery('#wpvivid_current_doing').html('');
        wpvivid_completed_backup = 1;
        wpvivid_prepare_backup = true;
        wpvivid_post_request(ajax_data, function (data) {
            try {
                var jsonarray = jQuery.parseJSON(data);
                if (jsonarray.result === 'failed') {
                    wpvivid_delete_ready_task(jsonarray.error);
                }
                else if (jsonarray.result === 'success') {
                    if(bdownloading) {
                        m_downloading_id = '';
                    }
                    m_backup_task_id = jsonarray.task_id;
                    /*if (jsonarray.check.alert_db === false && jsonarray.check.alter_files === false && jsonarray.check.alter_fcgi === false) {
                        jQuery('#wpvivid_backuplist').html('');
                        jQuery('#wpvivid_backuplist').append(jsonarray.html);
                        wpvivid_backup_now(jsonarray.task_id);
                    }
                    else {*/
                        var descript = '';
                        if (jsonarray.check.alert_db === true || jsonarray.check.alter_files === true) {
                            descript = 'The database (the dumping SQL file) might be too large, backing up the database may run out of server memory and result in a backup failure.\n' +
                                'One or more files might be too large, backing up the file(s) may run out of server memory and result in a backup failure.\n' +
                                'Click OK button and continue to back up.';
                            var ret = confirm(descript);
                            if (ret === true) {
                                jQuery('#wpvivid_backuplist').html('');
                                jQuery('#wpvivid_backuplist').append(jsonarray.html);
                                wpvivid_backup_now(m_backup_task_id);
                            }
                            else {
                                jQuery('#wpvivid_backup_cancel_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                jQuery('#wpvivid_backup_log_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                //jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                                wpvivid_control_backup_unlock();
                                jQuery('#wpvivid_postbox_backup_percent').hide();
                            }
                        }
                        else{
                            jQuery('#wpvivid_backuplist').html('');
                            jQuery('#wpvivid_backuplist').append(jsonarray.html);
                            wpvivid_backup_now(jsonarray.task_id);
                        }
                    //}
                }
            }
            catch (err) {
                wpvivid_delete_ready_task(err);
            }
        }, function (XMLHttpRequest, textStatus, errorThrown) {
            var error_message = wpvivid_output_ajaxerror('preparing the backup', textStatus, errorThrown);
            wpvivid_delete_ready_task(error_message);
        });
    }
}

function wpvivid_delete_ready_task(error){
    var ajax_data={
        'action': 'wpvivid_delete_ready_task'
    };
    wpvivid_post_request(ajax_data, function (data) {
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === 'success') {
                wpvivid_add_notice('Backup', 'Error', error);
                //jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
                wpvivid_control_backup_unlock();
                jQuery('#wpvivid_postbox_backup_percent').hide();
            }
        }
        catch(err){
            wpvivid_add_notice('Backup', 'Error', err);
            //jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
            wpvivid_control_backup_unlock();
            jQuery('#wpvivid_postbox_backup_percent').hide();
        }
    }, function (XMLHttpRequest, textStatus, errorThrown) {
        setTimeout(function () {
            wpvivid_delete_ready_task(error);
        }, 3000);
    });
}

/**
 * Resume the backup task automatically in 1 minute in a timeout situation
 *
 * @param backup_id         - A unique ID for a backup
 * @param next_resume_time  - A time interval for resuming next timeout backup task
 */
function wpvivid_resume_backup(backup_id, next_resume_time){
    if(next_resume_time < 0){
        next_resume_time = 0;
    }
    next_resume_time = next_resume_time * 1000;
    setTimeout("wpvivid_cron_task()", next_resume_time);
    setTimeout(function(){
        task_retry_times = 0;
        m_need_update=true;
    }, next_resume_time);
}

/**
 * This function will retrieve the last backup message
 */
function wpvivid_retrieve_last_backup_message(){
    var ajax_data={
        'action': 'wpvivid_get_last_backup'
    };
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            jQuery('#wpvivid_last_backup_msg').html(jsonarray.data);
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('retrieving the last backup log', textStatus, errorThrown);
        jQuery('#wpvivid_last_backup_msg').html(error_message);
    });
}

/**
 * Add remote storages to the list
 *
 * @param action        - The action to add or test a remote storage
 * @param storage_type  - Remote storage types (Amazon S3, SFTP and FTP server)
 */
function wpvivid_add_remote_storage(storage_type)
{
    var remote_from = wpvivid_ajax_data_transfer(storage_type);
    var ajax_data;
    ajax_data = {
        'action': 'wpvivid_add_remote',
        'remote': remote_from,
        'type': storage_type
    };
    jQuery('input[option=add-remote]').css({'pointer-events': 'nano', 'opacity': '0.4'});
    jQuery('#wpvivid_remote_notice').html('');
    wpvivid_post_request(ajax_data, function (data)
    {
        try
        {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === 'success')
            {
                jQuery('input[option=add-remote]').css({'pointer-events': 'auto', 'opacity': '1'});
                jQuery('input:text[option='+storage_type+']').each(function(){
                    jQuery(this).val('');
                });
                jQuery('input:password[option='+storage_type+']').each(function(){
                    jQuery(this).val('');
                });
                wpvivid_handle_remote_storage_data(data);
            }
            else if (jsonarray.result === 'failed')
            {
                jQuery('#wpvivid_remote_notice').html(jsonarray.notice);
                jQuery('input[option=add-remote]').css({'pointer-events': 'auto', 'opacity': '1'});
            }
        }
        catch (err)
        {
            alert(err);
            jQuery('input[option=add-remote]').css({'pointer-events': 'auto', 'opacity': '1'});
        }

    }, function (XMLHttpRequest, textStatus, errorThrown)
    {
        var error_message = wpvivid_output_ajaxerror('adding the remote storage', textStatus, errorThrown);
        alert(error_message);
        jQuery('input[option=add-remote]').css({'pointer-events': 'auto', 'opacity': '1'});
    });
}

function wpvivid_handle_remote_storage_data(data){
    var i = 0;
    try {
        var jsonarray = jQuery.parseJSON(data);
        if (jsonarray.result === 'success') {
            jQuery('#wpvivid_remote_storage_list').html('');
            jQuery('#wpvivid_remote_storage_list').append(jsonarray.html);
            jQuery('#upload_storage').html(jsonarray.pic);
            jQuery('#schedule_upload_storage').html(jsonarray.pic);
            jQuery('#wpvivid_out_of_date_remote_path').html(jsonarray.dir);
            jQuery('#wpvivid_schedule_backup_local_remote').html(jsonarray.local_remote);
            wpvivid_control_remote_storage(jsonarray.remote_storage);
            wpvivid_interface_flow_control();
            jQuery('#wpvivid_remote_notice').html(jsonarray.notice);
        }
        else if(jsonarray.result === 'failed'){
            jQuery('#wpvivid_remote_notice').html(jsonarray.notice);
        }
    }
    catch(err){
        alert(err);
    }
}

function wpvivid_control_remote_storage(has_remote){
    jQuery("input:radio[name='save_local_remote'][value='remote']").click(function(){
        if(!has_remote){
            alert("There is no default remote storage configured. Please set it up first.");
            jQuery("input:radio[name='save_local_remote'][value='local']").prop('checked', true);
        }
    });
}

function click_retrieve_remote_storage(id,type,name)
{
    wpvivid_editing_storage_id = id;
    jQuery('.remote-storage-edit').hide();
    jQuery('#wpvivid_tab_storage_edit').show();
    jQuery('#wpvivid_tab_storage_edit_text').html(name);
    wpvivid_editing_storage_type=type;
    jQuery('#remote_storage_edit_'+wpvivid_editing_storage_type).fadeIn();
    wpvivid_click_switch_page('storage', 'wpvivid_tab_storage_edit', true);

    var ajax_data = {
        'action': 'wpvivid_retrieve_remote',
        'remote_id': id
    };
    wpvivid_post_request(ajax_data, function(data)
    {
        try
        {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === 'success')
            {
                jQuery('input:text[option=edit-'+jsonarray.type+']').each(function(){
                    var key = jQuery(this).prop('name');
                    if(key == 's3Path' && jsonarray.type == 'amazons3'){
                        var iLength = jsonarray[key].lastIndexOf('/wpvivid_backup');
                        if(iLength != -1) {
                            jsonarray[key] = jsonarray[key].substring(0, iLength);
                        }
                        jQuery(this).val(jsonarray[key]);
                    }
                    else {
                        jQuery(this).val(jsonarray[key]);
                    }
                });
                jQuery('input:password[option=edit-'+jsonarray.type+']').each(function(){
                    var key = jQuery(this).prop('name');
                    jQuery(this).val(jsonarray[key]);
                });
                jQuery('input:checkbox[option=edit-'+jsonarray.type+']').each(function() {
                    var key = jQuery(this).prop('name');
                    var value;
                    if(jsonarray[key] == '0'){
                        value = false;
                    }
                    else{
                        value = true;
                    }
                    jQuery(this).prop('checked', value);
                });
                if(jsonarray.type == 'amazons3'){
                    var amazons3_edit_value = jQuery('input:text[option=edit-'+jsonarray.type+'][name=s3Path]').val();
                    if(amazons3_edit_value == ''){
                        amazons3_edit_value = '*';
                    }
                    amazons3_edit_value = amazons3_edit_value + '/wpvivid_backup';
                    jQuery('#wpvivid_edit_amazons3_root_path').html(amazons3_edit_value);
                }
                if(jsonarray.type == 's3compat'){
                    var dos_edit_value = jQuery('input:text[option=edit-'+jsonarray.type+'][name=s3directory]').val();
                    if(dos_edit_value == ''){
                        dos_edit_value = '*';
                    }
                    dos_edit_value = dos_edit_value + '/wpvivid_backup';
                    jQuery('#wpvivid_edit_dos_root_path').html(dos_edit_value);
                }
            }
            else
            {
                alert(jsonarray.error);
            }
        }
        catch(err)
        {
            alert(err);
        }
    },function(XMLHttpRequest, textStatus, errorThrown)
    {
        var error_message = wpvivid_output_ajaxerror('retrieving the remote storage', textStatus, errorThrown);
        alert(error_message);
    });
}

function wpvivid_edit_remote_storage() {
    var data_tran = 'edit-'+wpvivid_editing_storage_type;
    var remote_data = wpvivid_ajax_data_transfer(data_tran);
    var ajax_data;
    ajax_data = {
        'action': 'wpvivid_edit_remote',
        'remote': remote_data,
        'id': wpvivid_editing_storage_id,
        'type': wpvivid_editing_storage_type
    };
    jQuery('#wpvivid_remote_notice').html('');
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === 'success') {
                jQuery('#wpvivid_tab_storage_edit').hide();
                wpvivid_click_switch_page('storage', 'wpvivid_tab_storage_list', true);
                wpvivid_handle_remote_storage_data(data);
            }
            else if (jsonarray.result === 'failed') {
                jQuery('#wpvivid_remote_notice').html(jsonarray.notice);
            }
        }
        catch(err){
            alert(err);
        }
    },function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('editing the remote storage', textStatus, errorThrown);
        alert(error_message);
    });
}

/*
 * Delete the selected remote storage from the list
 *
 * @param storage_id - A unique ID for a remote storage
 */
function wpvivid_delete_remote_storage(storage_id){
    var descript = 'Deleting a remote storage will make it unavailable until it is added again. Are you sure to continue?';
    var ret = confirm(descript);
    if(ret === true){
        var ajax_data = {
            'action': 'wpvivid_delete_remote',
            'remote_id': storage_id
        };
        wpvivid_post_request(ajax_data, function(data){
            wpvivid_handle_remote_storage_data(data);
        },function(XMLHttpRequest, textStatus, errorThrown) {
            var error_message = wpvivid_output_ajaxerror('deleting the remote storage', textStatus, errorThrown);
            alert(error_message);
        });
    }
}

/*
 * Retrieve backup list once any changes happened.
 */
function wpvivid_retrieve_backup_list(){
    var ajax_data = {
        'action': 'wpvivid_get_backup_list'
    };
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === 'success') {
                jQuery('#wpvivid_backuplist').html('');
                jQuery('#wpvivid_backuplist').append(jsonarray.html);
            }
        }
        catch(err){
            alert(err);
        }
    },function(XMLHttpRequest, textStatus, errorThrown) {
        setTimeout(function () {
            wpvivid_retrieve_backup_list();
        }, 3000);
    });
}

function wpvivid_handle_backup_data(data){
    try {
        var jsonarray = jQuery.parseJSON(data);
        if (jsonarray.result === 'success') {
            jQuery('#wpvivid_backuplist').html('');
            jQuery('#wpvivid_backuplist').append(jsonarray.html);
        }
        else if(jsonarray.result === 'failed'){
            alert(jsonarray.error);
        }
    }
    catch(err){
        alert(err);
    }
}

/**
 * Modify general settings
 */
function wpvivid_set_general_settings()
{
    var setting_data = wpvivid_ajax_data_transfer('setting');
    var ajax_data = {
        'action': 'wpvivid_set_general_setting',
        'setting': setting_data
    };
    jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'none', 'opacity': '0.4'});
    wpvivid_post_request(ajax_data, function (data) {
        try {
            var jsonarray = jQuery.parseJSON(data);

            jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'auto', 'opacity': '1'});
            if (jsonarray.result === 'success') {
                location.reload();
            }
            else {
                alert(jsonarray.error);
            }
        }
        catch (err) {
            alert(err);
            jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'auto', 'opacity': '1'});
        }
    }, function (XMLHttpRequest, textStatus, errorThrown) {
        jQuery('#wpvivid_setting_general_save').css({'pointer-events': 'auto', 'opacity': '1'});
        var error_message = wpvivid_output_ajaxerror('changing base settings', textStatus, errorThrown);
        alert(error_message);
    });
}

function wpvivid_set_schedule()
{
    var schedule_data = wpvivid_ajax_data_transfer('schedule');
    var ajax_data = {
        'action': 'wpvivid_set_schedule',
        'schedule': schedule_data
    };
    jQuery('#wpvivid_schedule_save').css({'pointer-events': 'none', 'opacity': '0.4'});
    wpvivid_post_request(ajax_data, function (data) {
        try {
            var jsonarray = jQuery.parseJSON(data);

            jQuery('#wpvivid_schedule_save').css({'pointer-events': 'auto', 'opacity': '1'});
            if (jsonarray.result === 'success') {
                location.reload();
            }
            else {
                alert(jsonarray.error);
            }
        }
        catch (err) {
            alert(err);
            jQuery('#wpvivid_schedule_save').css({'pointer-events': 'auto', 'opacity': '1'});
        }
    }, function (XMLHttpRequest, textStatus, errorThrown) {
        jQuery('#wpvivid_schedule_save').css({'pointer-events': 'auto', 'opacity': '1'});
        var error_message = wpvivid_output_ajaxerror('changing schedule', textStatus, errorThrown);
        alert(error_message);
    });
}

/**
 * After enabling email report feature, and test if an email address works or not
 */
function wpvivid_email_test(){
    var mail = jQuery('#wpvivid_mail').val();
    var ajax_data = {
        'action': 'wpvivid_test_send_mail',
        'send_to': mail
    };
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === 'success') {
                jQuery('#wpvivid_send_email_res').html('Test succeeded.');
            }
            else {
                jQuery('#wpvivid_send_email_res').html('Test failed, ' + jsonarray.error);
            }
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('sending test mail', textStatus, errorThrown);
        alert(error_message);
    });
}

/**
 * This function will export settings to local folder
 */
function wpvivid_export_settings() {
    wpvivid_location_href=true;
    location.href =ajaxurl+'?action=wpvivid_export_setting&setting=1&history=1&review=0';
}

/**
 * This function will import the previous exported settings
 */
function wpvivid_import_settings(){
    var files = jQuery('input[name="fileTrans"]').prop('files');

    if(files.length == 0){
        alert('Choose a settings file and import it by clicking Import button.');
        return;
    }
    else{
        var reader = new FileReader();
        reader.readAsText(files[0], "UTF-8");
        reader.onload = function(evt){
            var fileString = evt.target.result;
            var ajax_data = {
                'action': 'wpvivid_import_setting',
                'data': fileString
            };
            wpvivid_post_request(ajax_data, function(data){
                try {
                    var jsonarray = jQuery.parseJSON(data);
                    if (jsonarray.result === 'success') {
                        location.reload();
                    }
                    else {
                        alert('Error: ' + jsonarray.error);
                    }
                }
                catch(err){
                    alert(err);
                }
            }, function(XMLHttpRequest, textStatus, errorThrown) {
                var error_message = wpvivid_output_ajaxerror('importing the previously-exported settings', textStatus, errorThrown);
                jQuery('#wpvivid_display_log_content').html(error_message);
            });
        }
    }
}

/**
 * This function will control interface flow.
 */
function wpvivid_interface_flow_control(){
    jQuery('#quickstart_storage_setting').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_backup_remote').click(function(){
        if(jQuery('#wpvivid_backup_remote').prop('checked') === true){
            jQuery('#quickstart_storage_setting').css({'pointer-events': 'auto', 'opacity': '1'});
        }
        else{
            jQuery('#quickstart_storage_setting').css({'pointer-events': 'none', 'opacity': '0.4'});
        }
    });

    jQuery('#wpvivid_general_email_enable').click(function(){
        if(jQuery('#wpvivid_general_email_enable').prop('checked') === true){
            jQuery('#wpvivid_general_email_setting').show();

        }
        else{
            jQuery('#wpvivid_general_email_setting').hide();
        }
    });

    /*jQuery('input[name="remote_storage"]').on("click", function(){
        var check_status = true;
        if(jQuery(this).prop('checked') === true){
            check_status = true;
        }
        else {
            check_status = false;
        }
        jQuery('input[name="remote_storage"]').prop('checked', false);
        if(check_status === true){
            jQuery(this).prop('checked', true);
        }
        else {
            jQuery(this).prop('checked', false);
        }
    });*/

    jQuery("input[name='schedule-backup-files']").bind("click",function(){
        if(jQuery(this).val() === "custom"){
            jQuery('#wpvivid_choosed_folders').show();
            if(jQuery("input[name='wpvivid-schedule-custom-folders'][value='other']").prop('checked')){
                jQuery('#wpvivid_file_tree_browser').show();
            }
            else{
                jQuery('#wpvivid_file_tree_browser').hide();
            }
        }
        else{
            jQuery('#wpvivid_choosed_folders').hide();
            jQuery('#wpvivid_file_tree_browser').hide();
        }
    });

    jQuery("input[name='wpvivid-schedule-custom-folders']").bind("click",function(){
        if(jQuery("input[name='wpvivid-schedule-custom-folders'][value='other']").prop('checked')){
            jQuery('#wpvivid_file_tree_browser').show();
        }
        else{
            jQuery('#wpvivid_file_tree_browser').hide();
        }
    });

    jQuery('#settings-page input[type=checkbox]:not([option=junk-files])').on("change", function(){
        wpvivid_settings_changed = true;
    });

    jQuery('#settings-page input[type=radio]').on("change", function(){
        wpvivid_settings_changed = true;
    });

    jQuery('#settings-page input[type=text]').on("keyup", function(){
        wpvivid_settings_changed = true;
    });

    jQuery("#wpvivid_storage_account_block input:not([type=checkbox])").on("keyup", function(){
        wpvivid_settings_changed = true;
    });

    jQuery('#wpvivid_storage_account_block input[type=checkbox]').on("change", function(){
        wpvivid_settings_changed = true;
    });

    jQuery('input:radio[option=restore]').click(function() {
        jQuery('input:radio[option=restore]').each(function () {
            if (jQuery(this).prop('checked')) {
                jQuery('#wpvivid_restore_btn').css({'pointer-events': 'auto', 'opacity': '1'});
            }
        });
    });
}

/**
 * Manage backup and download tasks. Retrieve the data every 3 seconds for checking if the backup or download tasks exist or not.
 */
function wpvivid_manage_task() {
    if(m_need_update === true){
        m_need_update = false;
        wpvivid_check_runningtask();
    }
    else{
        setTimeout(function(){
            wpvivid_manage_task();
        }, 3000);
    }
}

function wpvivid_add_notice(notice_action, notice_type, notice_msg){
    var notice_id="";
    var tmp_notice_msg = "";
    if(notice_type === "Warning"){
        tmp_notice_msg = "Warning: " + notice_msg;
    }
    else if(notice_type === "Error"){
        tmp_notice_msg = "Error: " + notice_msg;
    }
    else if(notice_type === "Success"){
        tmp_notice_msg = "Success: " + notice_msg;
    }
    else if(notice_type === "Info"){
        tmp_notice_msg = notice_msg;
    }
    switch(notice_action){
        case "Backup":
            notice_id="wpvivid_backup_notice";
            break;
    }
    var bfind = false;
    $div = jQuery('#'+notice_id).children('div').children('p');
    $div.each(function (index, value) {
        if(notice_action === "Backup" && notice_type === "Success"){
            bfind = false;
            return false;
        }
        if (value.innerHTML === tmp_notice_msg) {
            bfind = true;
            return false;
        }
    });
    if (bfind === false) {
        jQuery('#'+notice_id).show();
        var div = '';
        if(notice_type === "Warning"){
            div = "<div class='notice notice-warning is-dismissible inline'><p>Warning: " + notice_msg + "</p>" +
                "<button type='button' class='notice-dismiss' onclick='click_dismiss_notice(this);'>" +
                "<span class='screen-reader-text'>Dismiss this notice.</span>" +
                "</button>" +
                "</div>";
        }
        else if(notice_type === "Error"){
            div = "<div class=\"notice notice-error inline\"><p>Error: " + notice_msg + "</p></div>";
        }
        else if(notice_type === "Success"){
            wpvivid_clear_notice('wpvivid_backup_notice');
            jQuery('#wpvivid_backup_notice').show();
            var success_msg = wpvivid_completed_backup + " backup tasks have been completed. Please switch to <a href=\"#\" onclick=\"wpvivid_click_switch_page('wrap', 'wpvivid_tab_log', true);\">Log</a> page to check the details.\n";
            div = "<div class='notice notice-success is-dismissible inline'><p>" + success_msg + "</p>" +
                "<button type='button' class='notice-dismiss' onclick='click_dismiss_notice(this);'>" +
                "<span class='screen-reader-text'>Dismiss this notice.</span>" +
                "</button>" +
                "</div>";
            wpvivid_completed_backup++;
        }
        else if(notice_type === "Info"){
            div = "<div class='notice notice-info is-dismissible inline'><p>" + notice_msg + "</p>" +
                "<button type='button' class='notice-dismiss' onclick='click_dismiss_notice(this);'>" +
                "<span class='screen-reader-text'>Dismiss this notice.</span>" +
                "</button>" +
                "</div>";
        }
        jQuery('#'+notice_id).append(div);
    }
}

function click_dismiss_notice(obj){
    wpvivid_completed_backup = 1;
    jQuery(obj).parent().remove();
}

function wpvivid_backup_now(task_id){
    var ajax_data = {
        'action': 'wpvivid_backup_now',
        'task_id': task_id
    };
    task_retry_times = 0;
    m_need_update=true;
    wpvivid_post_request(ajax_data, function(data){
    }, function(XMLHttpRequest, textStatus, errorThrown) {
    });
}

function wpvivid_delete_backup_task(task_id){
    var ajax_data = {
        'action': 'wpvivid_delete_task',
        'task_id': task_id
    };
    wpvivid_post_request(ajax_data, function(data){}, function(XMLHttpRequest, textStatus, errorThrown) {
    });
}

/**
 * Calculate elapsed time for backing up.
 *
 * @param carry_out_time - Elapsed time for backing up
 *
 * @returns {*}
 */
function wpvivid_calc_backup_elapsed_time(carry_out_time){
    var time = carry_out_time;
    if (null != time && "" != time) {
        if (time > 60 && time < 60 * 60) {
            time = parseInt(time / 60.0) + 'min' + parseInt((parseFloat(time / 60.0) -
                parseInt(time / 60.0)) * 60) + 'second';
        }
        else if (time >= 60 * 60 && time < 60 * 60 * 24) {
            time = parseInt(time / 3600.0) + 'hour' + parseInt((parseFloat(time / 3600.0) -
                parseInt(time / 3600.0)) * 60) + 'min' +
                parseInt((parseFloat((parseFloat(time / 3600.0) - parseInt(time / 3600.0)) * 60) -
                    parseInt((parseFloat(time / 3600.0) - parseInt(time / 3600.0)) * 60)) * 60) + 'second';
        } else if (time >= 60 * 60 * 24) {
            time = parseInt(time / 3600.0/24) + 'day' +parseInt((parseFloat(time / 3600.0/24)-
                parseInt(time / 3600.0/24))*24) + 'hour' + parseInt((parseFloat(time / 3600.0) -
                parseInt(time / 3600.0)) * 60) + 'min' +
                parseInt((parseFloat((parseFloat(time / 3600.0) - parseInt(time / 3600.0)) * 60) -
                    parseInt((parseFloat(time / 3600.0) - parseInt(time / 3600.0)) * 60)) * 60) + 'second';
        }
        else {
            time = parseInt(time) + 'second';
        }
    }
    return time;
}

function wpvivid_cron_task(){
    jQuery.get(wpvivid_siteurl+'/wp-cron.php');
}

/**
 * This function will initialize the download information.
 *
 * @param backup_id - The unique ID of the backup
 */
function wpvivid_initialize_download(backup_id){
    wpvivid_reset_backup_list();
    jQuery('#wpvivid_download_loading_'+backup_id).addClass('is-active');
    tmp_current_click_backupid = backup_id;
    var ajax_data = {
        'action':'wpvivid_init_download_page',
        'backup_id':backup_id
    };
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            jQuery('#wpvivid_download_loading_'+backup_id).removeClass('is-active');
            if (jsonarray.result === 'success') {
                jQuery('#wpvivid_file_part_' + backup_id).html("");
                var i = 0;
                var file_not_found = false;
                    var file_name = '';
                    jQuery.each(jsonarray.files, function (index, value) {
                        i++;
                        file_name = index;
                        if (value.status === 'need_download') {
                            jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                            //tmp_current_click_backupid = '';
                        }
                        else if (value.status === 'running') {
                            if (m_downloading_file_name === file_name) {
                                wpvivid_lock_download(tmp_current_click_backupid);
                            }
                            jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                        }
                        else if (value.status === 'completed') {
                            if (m_downloading_file_name === file_name) {
                                wpvivid_unlock_download(tmp_current_click_backupid);
                                m_downloading_id = '';
                                m_downloading_file_name = '';
                            }
                            jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                            //tmp_current_click_backupid = '';
                        }
                        else if (value.status === 'timeout') {
                            if (m_downloading_file_name === file_name) {
                                wpvivid_unlock_download(tmp_current_click_backupid);
                                m_downloading_id = '';
                                m_downloading_file_name = '';
                            }
                            jQuery('#wpvivid_file_part_' + backup_id).append(value.html);
                            //tmp_current_click_backupid = '';
                        }
                        else if (value.status === 'file_not_found') {
                            wpvivid_unlock_download(tmp_current_click_backupid);
                            wpvivid_reset_backup_list();
                            file_not_found = true;
                            alert("Download failed, file not found. The file might has been moved, renamed or deleted. Please verify the file exists and try again.");
                            //tmp_current_click_backupid = '';
                            return false;
                        }
                    });
                    if (file_not_found === false) {
                        jQuery('#wpvivid_file_part_' + backup_id).append(jsonarray.place_html);
                    }
            }
        }
        catch(err){
            alert(err);
            jQuery('#wpvivid_download_loading_'+backup_id).removeClass('is-active');
        }
    },function(XMLHttpRequest, textStatus, errorThrown){
        jQuery('#wpvivid_download_loading_'+backup_id).removeClass('is-active');
        var error_message = wpvivid_output_ajaxerror('initializing download information', textStatus, errorThrown);
        alert(error_message);
    });
}

function wpvivid_reset_backup_list(){
    jQuery('#wpvivid_backuplist tr').each(function(i){
        jQuery(this).children('td').each(function (j) {
            if (j == 2) {
                var backup_id = jQuery(this).parent().children('th').find("input[type=checkbox]").attr("id");
                var download_btn = '<div id="wpvivid_file_part_' + backup_id + '" style="float:left;padding:10px 10px 10px 0px;">' +
                    '<div style="cursor:pointer;" onclick="wpvivid_initialize_download(\'' + backup_id + '\');" title="Prepare to download the backup">' +
                    '<img id="wpvivid_download_btn_' + backup_id + '" src="' + wpvivid_plugurl + '/images/download.png" style="vertical-align:middle;" />Download' +
                    '<div class="spinner" id="wpvivid_download_loading_' + backup_id + '" style="float:right;width:auto;height:auto;padding:10px 180px 10px 0;background-position:0 0;"></div>' +
                    '</div>' +
                    '</div>';
                jQuery(this).html(download_btn);
            }
        });
    });
}

function wpvivid_lock_download(backup_id){
    jQuery('#wpvivid_backuplist tr').each(function(i){
        jQuery(this).children('td').each(function (j) {
            if (j == 2) {
                jQuery(this).css({'pointer-events': 'none', 'opacity': '0.4'});
            }
        });
    });
}

function wpvivid_unlock_download(backup_id){
    jQuery('#wpvivid_backuplist tr').each(function(i){
        jQuery(this).children('td').each(function (j) {
            if (j == 2) {
                jQuery(this).css({'pointer-events': 'auto', 'opacity': '1'});
            }
        });
    });
}

function wpvivid_clear_notice(notice_id){
    var t = document.getElementById(notice_id);
    var oDiv = t.getElementsByTagName("div");
    var count = oDiv.length;
    for (count; count > 0; count--) {
        var i = count - 1;
        oDiv[i].parentNode.removeChild(oDiv[i]);
    }
    jQuery('#'+notice_id).hide();
}

/**
 * Start downloading backup
 *
 * @param part_num  - The part number for the download object
 * @param backup_id - The unique ID for the backup
 * @param file_name - File name
 */
function wpvivid_prepare_download(part_num, backup_id, file_name){
    var ajax_data = {
        'action': 'wpvivid_prepare_download_backup',
        'backup_id':backup_id,
        'file_name':file_name
    };
    var progress = '0%';
    jQuery("#"+backup_id+"-text-part-"+part_num).html("<a>Retriving(remote storage to web server)</a>");
    jQuery("#"+backup_id+"-progress-part-"+part_num).css('width', progress);
    task_retry_times = 0;
    m_need_update = true;
    wpvivid_lock_download(backup_id);
    m_downloading_id = backup_id;
    tmp_current_click_backupid = backup_id;
    m_downloading_file_name = file_name;
    wpvivid_post_request(ajax_data, function(data)
    {
    }, function(XMLHttpRequest, textStatus, errorThrown)
    {
    }, 0);
}

/**
 * Download backups to user's computer.
 *
 * @param backup_id     - The unique ID for the backup
 * @param backup_type   - The types of the backup
 * @param file_name     - File name
 */
function wpvivid_download(backup_id, backup_type, file_name){
    wpvivid_location_href=true;
    location.href =ajaxurl+'?action=wpvivid_download_backup&backup_id='+backup_id+'&download_type='+backup_type+'&file_name='+file_name;
}

function wpvivid_click_check_backup(backup_id){
    var name = "";
    var all_check = true;
    jQuery('#wpvivid_backuplist tr').each(function (i) {
        jQuery(this).children('th').each(function (j) {
            if(j === 0) {
                var id = jQuery(this).find("input[type=checkbox]").attr("id");
                if (id === backup_id) {
                    name = jQuery(this).parent().children('td').eq(0).find("img").attr("name");
                    if (name === "unlock") {
                        if (jQuery(this).find("input[type=checkbox]").prop('checked') === false) {
                            all_check = false;
                        }
                    }
                    else {
                        jQuery(this).find("input[type=checkbox]").prop('checked', false);
                        all_check = false;
                    }
                }
                else {
                    if (jQuery(this).find("input[type=checkbox]").prop('checked') === false) {
                        all_check = false;
                    }
                }
            }
        });
    });
    if(all_check === true){
        jQuery('#backup_list_all_check').prop('checked', true);
    }
    else{
        jQuery('#backup_list_all_check').prop('checked', false);
    }
}

function wpvivid_getrequest() {
    switch(wpvivid_page_request){
        case "backup":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_general', false);
            break;
        case "transfer":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_migrate', false);
            break;
        case "settings":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_setting', false);
            break;
        case "schedule":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_schedule', false);
            break;
        case "remote":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_remote_storage', false);
            break;
        case "website":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_debug', false);
            break;
        case "log":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_log', false);
            break;
        case "key":
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_key', false);
            break;
        default:
            wpvivid_click_switch_page('wrap', 'wpvivid_tab_general', false);
            break;
    }
}

function wpvivid_click_switch_page(tab, type, scroll){
    jQuery('.'+tab+'-tab-content:not(.' + type + ')').hide();
    jQuery('.'+tab+'-tab-content.' + type).show();
    jQuery('.'+tab+'-nav-tab:not(#' + type + ')').removeClass('nav-tab-active');
    jQuery('.'+tab+'-nav-tab#' + type).addClass('nav-tab-active');
    if(scroll == true){
        var top = jQuery('#'+type).offset().top-jQuery('#'+type).height();
        jQuery('html, body').animate({scrollTop:top}, 'slow');
    }
}

function wpvivid_close_tab(event, hide_tab, type, show_tab){
    event.stopPropagation();
    jQuery('#'+hide_tab).hide();
    wpvivid_click_switch_page(type, show_tab, true);
}

/**
 * Retrieve the list of logs from the Log tab.
 */
function wpvivid_retrieve_log_list(){
    var ajax_data = {
        'action': 'wpvivid_get_log_list'
    };
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === "success") {
                jQuery('#wpvivid_loglist').html("");
                jQuery('#wpvivid_loglist').append(jsonarray.html);
                wpvivid_log_count = jsonarray.log_count;
                wpvivid_display_log_page();
            }
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        setTimeout(function () {
            wpvivid_retrieve_log_list();
        }, 3000);
    });
}

/**
 * Set a default remote storage for backups.
 */
function wpvivid_set_default_remote_storage(){
    var remote_storage = new Array();
    //remote_storage[0] = jQuery("input[name='remote_storage']:checked").val();
    jQuery.each(jQuery("input[name='remote_storage']:checked"), function()
    {
        remote_storage.push(jQuery(this).val());
    });

    var ajax_data = {
        'action': 'wpvivid_set_default_remote_storage',
        'remote_storage': remote_storage
    };
    jQuery('#wpvivid_remote_notice').html('');
    wpvivid_post_request(ajax_data, function(data){
        wpvivid_handle_remote_storage_data(data);
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('setting up the default remote storage', textStatus, errorThrown);
        alert(error_message);
    });
}

function wpvivid_pre_log_page(){
    if(wpvivid_cur_log_page > 1){
        wpvivid_cur_log_page--;
    }
    wpvivid_display_log_page();
}

function wpvivid_next_log_page(){
    var display_count = jQuery("#wpvivid_display_log_count option:selected").val();
    var max_pages=Math.ceil(wpvivid_log_count/display_count);
    if(wpvivid_cur_log_page < max_pages){
        wpvivid_cur_log_page++;
    }
    wpvivid_display_log_page();
}

function wpvivid_display_log_page(){
    var display_count = jQuery("#wpvivid_display_log_count option:selected").val();
    var max_pages=Math.ceil(wpvivid_log_count/display_count);
    if(max_pages == 0) max_pages = 1;
    jQuery('#wpvivid_log_page_info').html(wpvivid_cur_log_page+ " / "+max_pages);

    var begin = (wpvivid_cur_log_page - 1) * display_count;
    var end = parseInt(begin) + parseInt(display_count);
    jQuery("#wpvivid_loglist tr").hide();
    jQuery('#wpvivid_loglist tr').each(function(i){
        if (i >= begin && i < end)
        {
            jQuery(this).show();
        }
    });
}

/**
 * Set a lock for backups.
 *
 * @param backup_id   - An unique ID for the backup
 * @param lock_status - Current lock status
 */
function wpvivid_set_backup_lock(backup_id, lock_status){
    if(lock_status === "lock"){
        var lock=0;
    }
    else{
        var lock=1;
    }
    var ajax_data={
        'action': 'wpvivid_set_security_lock',
        'backup_id': backup_id,
        'lock': lock
    };
    wpvivid_post_request(ajax_data, function(data) {
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === 'success') {
                jQuery('#wpvivid_lock_'+backup_id).html(jsonarray.html);
            }
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('setting up a lock for the backup', textStatus, errorThrown);
        alert(error_message);
    });
}

function wpvivid_initialize_restore(backup_id, backup_time, backup_type, restore_type='backup'){
    var time_type = 'backup';
    var log_type = '';
    var tab_type = '';
    var page_type = 'backup';
    if(restore_type == 'backup'){
        time_type = 'backup';
        log_type = '';
        tab_type = '';
        page_type = 'backup';
    }
    else if(restore_type == 'transfer'){
        time_type = 'transfer';
        log_type = 'transfer_';
        tab_type = 'add_';
        page_type = 'migrate';
    }
    wpvivid_restore_backup_type = backup_type;
    jQuery('#wpvivid_restore_'+time_type+'_time').html(backup_time);
    m_restore_backup_id = backup_id;
    jQuery('#wpvivid_restore_'+log_type+'log').html("");
    jQuery('#wpvivid_'+tab_type+'tab_restore').show();
    wpvivid_click_switch_page(page_type, 'wpvivid_'+tab_type+'tab_restore', true);
    wpvivid_init_restore_data(restore_type);
}

function click_dismiss_restore_check_notice(obj){
    wpvivid_display_restore_check = false;
    jQuery(obj).parent().remove();
}

/**
 * This function will initialize restore information
 *
 * @param backup_id - The unique ID for the backup
 */
function wpvivid_init_restore_data(restore_type)
{
    wpvivid_resotre_is_migrate=0;
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }
    jQuery('#wpvivid_replace_domain').prop('checked', false);
    jQuery('#wpvivid_keep_domain').prop('checked', false);
    jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_restore_'+restore_method+'part').show();
    jQuery('#wpvivid_clean_'+restore_method+'part').hide();
    jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
    jQuery('#wpvivid_download_'+restore_method+'part').hide();
    /*if(wpvivid_restore_backup_type == 'Migration' || wpvivid_restore_backup_type == 'Upload') {
        jQuery('#wpvivid_restore_is_migrate').show();
        jQuery('#wpvivid_restore_is_migrate').css({'pointer-events': 'none', 'opacity': '0.4'});
    }
    else{
        jQuery('#wpvivid_restore_is_migrate').hide();
    }*/
    jQuery('#wpvivid_init_restore_data').addClass('is-active');
    var ajax_data = {
        'action':'wpvivid_init_restore_page',
        'backup_id':m_restore_backup_id
    };
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);
            var init_status = false;
            if(jsonarray.result === 'success') {
                jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_restore_'+restore_method+'part').show();
                jQuery('#wpvivid_download_'+restore_method+'part').hide();
                wpvivid_restore_need_download = false;
                init_status = true;
            }
            else if (jsonarray.result === "need_download"){
                init_status = true;
                wpvivid_restore_download_array = new Array();
                var download_num = 0;
                jQuery.each(jsonarray.files, function (index, value)
                {
                    if (value.status === "need_download")
                    {
                        wpvivid_restore_download_array[download_num] = new Array('file_name', 'size', 'md5');
                        wpvivid_restore_download_array[download_num]['file_name'] = index;
                        wpvivid_restore_download_array[download_num]['size'] = value.size;
                        wpvivid_restore_download_array[download_num]['md5'] = value.md5;
                        download_num++;
                    }
                });
                wpvivid_restore_download_index=0;
                wpvivid_restore_need_download = true;
                jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                jQuery('#wpvivid_download_'+restore_method+'part').show();
            }
            else if (jsonarray.result === "failed") {
                jQuery('#wpvivid_init_restore_data').removeClass('is-active');
                wpvivid_display_restore_msg(jsonarray.error, restore_type);
            }

            if(init_status){
                if(jsonarray.max_allow_packet_warning != false || jsonarray.memory_limit_warning != false) {
                    if(!wpvivid_display_restore_check) {
                        wpvivid_display_restore_check = true;
                        var output = '';
                        if(jsonarray.max_allow_packet_warning != false){
                            output += "<p>" + jsonarray.max_allow_packet_warning + "</p>";
                        }
                        if(jsonarray.memory_limit != false){
                            output += "<p>" + jsonarray.memory_limit_warning + "</p>";
                        }
                        var div = "<div class='notice notice-warning is-dismissible inline'>" +
                            output +
                            "<button type='button' class='notice-dismiss' onclick='click_dismiss_restore_check_notice(this);'>" +
                            "<span class='screen-reader-text'>Dismiss this notice.</span>" +
                            "</button>" +
                            "</div>";
                        jQuery('#wpvivid_restore_check').append(div);
                    }
                }
                jQuery('#wpvivid_init_restore_data').removeClass('is-active');
                if (jsonarray.has_exist_restore === 0) {
                    if(wpvivid_restore_need_download == false) {
                        jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_restore_' + restore_method + 'part').show();
                        jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
                        jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
                        jQuery('#wpvivid_restore_is_migrate').css({'pointer-events': 'auto', 'opacity': '1'});

                        jQuery('#wpvivid_restore_is_migrate').hide();
                        jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});

                        wpvivid_resotre_is_migrate = jsonarray.is_migrate;

                        if (jsonarray.is_migrate_ui === 1) {
                            jQuery('#wpvivid_restore_is_migrate').show()
                            jQuery('#wpvivid_replace_domain').prop('checked', false);
                            jQuery('#wpvivid_keep_domain').prop('checked', false);
                        }
                        else {
                            jQuery('#wpvivid_restore_is_migrate').hide();
                            jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        }

                        wpvivid_interface_flow_control();
                    }
                }
                else if (jsonarray.has_exist_restore === 1) {
                    jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                    jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'auto', 'opacity': '1'});
                    jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                    jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                    jQuery('#wpvivid_clean_'+restore_method+'part').show();
                    jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                    jQuery('#wpvivid_restore_is_migrate').hide();
                    wpvivid_display_restore_msg("An uncompleted restore task exists, please terminate it first.", restore_type);
                }
            }
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        jQuery('#wpvivid_init_restore_data').removeClass('is-active');
        var error_message = wpvivid_output_ajaxerror('initializing restore information', textStatus, errorThrown);
        wpvivid_display_restore_msg(error_message, restore_type);
    });
}

function wpvivid_restore_is_migrate(restore_type){
    var ajax_data = {
        'action': 'wpvivid_get_restore_file_is_migrate',
        'backup_id': m_restore_backup_id
    };
    var restore_method = '';
    wpvivid_post_request(ajax_data, function(data)
    {
        try
        {
            var jsonarray = jQuery.parseJSON(data);
            if(jsonarray.result === "success")
            {
                if (jsonarray.is_migrate_ui === 1)
                {
                    jQuery('#wpvivid_restore_is_migrate').show();
                    jQuery('#wpvivid_replace_domain').prop('checked', false);
                    jQuery('#wpvivid_keep_domain').prop('checked', false);
                }
                else {
                    jQuery('#wpvivid_restore_is_migrate').hide();
                    jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                }
            }
            else if (jsonarray.result === "failed") {
                jQuery('#wpvivid_init_restore_data').removeClass('is-active');
                wpvivid_display_restore_msg(jsonarray.error, restore_type);
            }
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown)
    {
        setTimeout(function()
        {
            wpvivid_restore_is_migrate(restore_type);
        }, 3000);
    });
}

/**
 * This function will start the process of restoring a backup
 */
function wpvivid_start_restore(restore_type = 'backup'){
    if(!wpvivid_restore_sure){
        var descript = 'Are you sure to continue?';
        var ret = confirm(descript);
    }
    else{
        ret = true;
    }
    if (ret === true) {
        wpvivid_restore_sure = true;
        var restore_method = '';
        if (restore_type == 'backup') {
            restore_method = '';
        }
        else if (restore_type == 'transfer') {
            restore_method = 'transfer_';
        }
        jQuery('#wpvivid_restore_' + restore_method + 'log').html("");
        jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_restore_' + restore_method + 'part').show();
        jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
        jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
        wpvivid_restore_lock();
        wpvivid_restoring = true;
        if (wpvivid_restore_need_download) {
            wpvivid_download_restore_file(restore_type);
        }
        else {
            wpvivid_monitor_restore_task(restore_type);
            if(wpvivid_resotre_is_migrate==0)
            {
                jQuery('input:radio[option=restore]').each(function()
                {
                    if(jQuery(this).prop('checked'))
                    {
                        var value = jQuery(this).prop('value');
                        if(value == '1')
                        {
                            wpvivid_resotre_is_migrate = '1';
                        }
                    }
                });
            }

            wpvivid_restore(restore_type);
        }
    }
}

function wpvivid_download_restore_file(restore_type)
{
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    wpvivid_restore_lock();
    if(wpvivid_restore_download_array.length===0)
    {
        wpvivid_display_restore_msg("Downloading backup file failed. Backup file might be deleted or network doesn't work properly. Please verify the file and confirm the network connection and try again later.", restore_type);
        wpvivid_restore_unlock();
        return false;
    }

    if(wpvivid_restore_download_index+1>wpvivid_restore_download_array.length)
    {
        wpvivid_display_restore_msg("Download succeeded.", restore_type);
        wpvivid_restore_is_migrate(restore_type);
        wpvivid_restore_need_download = false;
        jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_clean_' + restore_method + 'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_restore_' + restore_method + 'part').show();
        jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
        jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
        jQuery('#wpvivid_download_'+restore_method+'part').hide();
        //wpvivid_start_restore(restore_type);
    }
    else
    {
        wpvivid_display_restore_msg("Downloading backup file " +  wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'], restore_type);
        wpvivid_display_restore_msg('', restore_type, wpvivid_restore_download_index);
        var ajax_data = {
            'action': 'wpvivid_download_restore',
            'backup_id': m_restore_backup_id,
            'file_name': wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'],
            'size': wpvivid_restore_download_array[wpvivid_restore_download_index]['size'],
            'md5': wpvivid_restore_download_array[wpvivid_restore_download_index]['md5']
        }
        wpvivid_get_download_restore_progress_retry=0;
        wpvivid_monitor_download_restore_task(restore_type);
        wpvivid_post_request(ajax_data, function (data) {
        }, function (XMLHttpRequest, textStatus, errorThrown) {
        }, 0);
    }
}

function wpvivid_monitor_download_restore_task(restore_type)
{
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    var ajax_data={
        'action':'wpvivid_get_download_restore_progress',
        'file_name': wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'],
        'size': wpvivid_restore_download_array[wpvivid_restore_download_index]['size'],
        'md5': wpvivid_restore_download_array[wpvivid_restore_download_index]['md5']
    };

    wpvivid_post_request(ajax_data, function(data)
    {
        try
        {
            var jsonarray = jQuery.parseJSON(data);
            if(typeof jsonarray ==='object')
            {
                if(jsonarray.result === "success")
                {
                    if(jsonarray.status==='completed')
                    {
                        wpvivid_display_restore_msg(wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'] + ' download succeeded.', restore_type, wpvivid_restore_download_index, false);
                        wpvivid_restore_download_index++;
                        wpvivid_download_restore_file(restore_type);
                        wpvivid_restore_unlock();
                    }
                    else if(jsonarray.status==='error')
                    {
                        jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                        jQuery('#wpvivid_clean_'+restore_method+'part').hide();
                        jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                        jQuery('#wpvivid_download_'+restore_method+'part').show();
                        var error_message = jsonarray.error;
                        wpvivid_display_restore_msg(error_message,restore_type,wpvivid_restore_download_array[wpvivid_restore_download_index]['file_name'],false);
                        wpvivid_restore_unlock();
                    }
                    else if(jsonarray.status==='running')
                    {
                        jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        wpvivid_display_restore_msg(jsonarray.log, restore_type, wpvivid_restore_download_index, false);
                        setTimeout(function()
                        {
                            wpvivid_monitor_download_restore_task(restore_type);
                        }, 3000);
                        wpvivid_restore_lock();
                    }
                    else if(jsonarray.status==='timeout')
                    {
                        wpvivid_get_download_restore_progress_retry++;
                        if(wpvivid_get_download_restore_progress_retry>10)
                        {
                            jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                            jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                            jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                            jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                            jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                            jQuery('#wpvivid_clean_'+restore_method+'part').hide();
                            jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                            jQuery('#wpvivid_download_'+restore_method+'part').show();
                            var error_message = jsonarray.error;
                            wpvivid_display_restore_msg(error_message, restore_type);
                            wpvivid_restore_unlock();
                        }
                        else
                        {
                            setTimeout(function()
                            {
                                wpvivid_monitor_download_restore_task(restore_type);
                            }, 3000);
                        }
                    }
                    else
                    {
                        setTimeout(function()
                        {
                            wpvivid_monitor_download_restore_task(restore_type);
                        }, 3000);
                    }
                }
                else
                {
                    wpvivid_get_download_restore_progress_retry++;
                    if(wpvivid_get_download_restore_progress_retry>10)
                    {
                        jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
                        jQuery('#wpvivid_download_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                        jQuery('#wpvivid_restore_'+restore_method+'part').hide();
                        jQuery('#wpvivid_clean_'+restore_method+'part').hide();
                        jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
                        jQuery('#wpvivid_download_'+restore_method+'part').show();
                        var error_message = jsonarray.error;
                        wpvivid_display_restore_msg(error_message, restore_type);
                        wpvivid_restore_unlock();
                    }
                    else
                    {
                        setTimeout(function()
                        {
                            wpvivid_monitor_download_restore_task(restore_type);
                        }, 3000);
                    }
                }
            }
            else
            {
                setTimeout(function()
                {
                    wpvivid_monitor_download_restore_task(restore_type);
                }, 3000);
            }
        }
        catch(err){
            setTimeout(function()
            {
                wpvivid_monitor_download_restore_task(restore_type);
            }, 3000);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown)
    {
        setTimeout(function()
        {
            wpvivid_monitor_download_restore_task(restore_type);
        }, 1000);
    });
}

/**
 * Monitor restore task.
 */
function wpvivid_monitor_restore_task(restore_type){
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    var ajax_data={
        'action':'wpvivid_get_restore_progress',
        'wpvivid_restore' : '1',
    };

    if(wpvivid_restore_timeout){
        jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_restore_'+restore_method+'part').show();
        jQuery('#wpvivid_clean_'+restore_method+'part').hide();
        jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
        wpvivid_restore_unlock();
        wpvivid_restoring = false;
        wpvivid_display_restore_msg("Website restore times out.", restore_type);
    }
    else {
        wpvivid_post_request(ajax_data, function (data) {
            try {
                var jsonarray = jQuery.parseJSON(data);
                if (typeof jsonarray === 'object') {
                    if (jsonarray.result === "success") {
                        jQuery('#wpvivid_restore_' + restore_method + 'log').html("");
                        while (jsonarray.log.indexOf('\n') >= 0) {
                            var iLength = jsonarray.log.indexOf('\n');
                            var log = jsonarray.log.substring(0, iLength);
                            jsonarray.log = jsonarray.log.substring(iLength + 1);
                            var insert_log = "<div style=\"clear:both;\">" + log + "</div>";
                            jQuery('#wpvivid_restore_' + restore_method + 'log').append(insert_log);
                            var div = jQuery('#wpvivid_restore_' + restore_method + 'log');
                            div[0].scrollTop = div[0].scrollHeight;
                        }

                        if (jsonarray.status === 'wait') {
                            wpvivid_restoring = true;
                            jQuery('#wpvivid_restore_' + restore_method + 'btn').css({
                                'pointer-events': 'none',
                                'opacity': '0.4'
                            });
                            jQuery('#wpvivid_clean_' + restore_method + 'restore').css({
                                'pointer-events': 'none',
                                'opacity': '0.4'
                            });
                            jQuery('#wpvivid_rollback_' + restore_method + 'btn').css({
                                'pointer-events': 'none',
                                'opacity': '0.4'
                            });
                            jQuery('#wpvivid_restore_' + restore_method + 'part').show();
                            jQuery('#wpvivid_clean_' + restore_method + 'part').hide();
                            jQuery('#wpvivid_rollback_' + restore_method + 'part').hide();
                            wpvivid_restore(restore_type);
                            setTimeout(function () {
                                wpvivid_monitor_restore_task(restore_type);
                            }, 1000);
                        }
                        else if (jsonarray.status === 'completed') {
                            wpvivid_restoring = false;
                            wpvivid_restore(restore_type);
                            wpvivid_restore_unlock();
                            alert("Restore completed successfully.");
                            location.reload();
                        }
                        else if (jsonarray.status === 'error') {
                            wpvivid_restore_unlock();
                            wpvivid_restoring = false;
                            jQuery('#wpvivid_restore_' + restore_method + 'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                            alert("Restore failed.");
                        }
                        else {
                            setTimeout(function () {
                                wpvivid_monitor_restore_task(restore_type);
                            }, 1000);
                        }
                    }
                    else {
                        setTimeout(function () {
                            wpvivid_monitor_restore_task(restore_type);
                        }, 1000);
                    }
                }
                else {
                    setTimeout(function () {
                        wpvivid_monitor_restore_task(restore_type);
                    }, 1000);
                }
            }
            catch (err) {
                setTimeout(function () {
                    wpvivid_monitor_restore_task(restore_type);
                }, 1000);
            }
        }, function (XMLHttpRequest, textStatus, errorThrown) {
            setTimeout(function () {
                wpvivid_monitor_restore_task(restore_type);
            }, 1000);
        });
    }
}

function wpvivid_restore(restore_type){
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    var skip_old_site = '1';
    var extend_option = {
        'skip_backup_old_site':skip_old_site,
        'skip_backup_old_database':skip_old_site
    };

    var migrate_option = {
        'is_migrate':wpvivid_resotre_is_migrate,
    };
    jQuery.extend(extend_option, migrate_option);

    var restore_options = {
        0:'backup_db',
        1:'backup_themes',
        2:'backup_plugin',
        3:'backup_uploads',
        4:'backup_content',
        5:'backup_core'
    };
    jQuery.extend(restore_options, extend_option);
    var json = JSON.stringify(restore_options);
    var ajax_data={
        'action':'wpvivid_restore',
        'wpvivid_restore':'1',
        'backup_id':m_restore_backup_id,
        'restore_options':json
    };
    setTimeout(function () {
        wpvivid_restore_timeout = true;
    }, 1800000);
    wpvivid_post_request(ajax_data, function(data) {
    }, function(XMLHttpRequest, textStatus, errorThrown) {
    });
}

function wpvivid_display_restore_msg(msg, restore_type, div_id, append = true){
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    if(typeof div_id == 'undefined') {
        var restore_msg = "<div style=\"clear:both;\">" + msg + "</div>";
    }
    else{
        var restore_msg = "<div id=\"restore_file_"+div_id+"\"  style=\"clear:both;\">" + msg + "</div>";
    }
    if(append == true) {
        jQuery('#wpvivid_restore_'+restore_method+'log').append(restore_msg);
    }
    else{
        if(jQuery('#restore_file_'+div_id).length )
        {
            jQuery('#restore_file_'+div_id).html(msg);
        }
        else
        {
            jQuery('#wpvivid_restore_'+restore_method+'log').append(restore_msg);
        }
    }
    var div = jQuery('#wpvivid_restore_' + restore_method + 'log');
    div[0].scrollTop = div[0].scrollHeight;
}

/**
 * Delete the last incomplete restore task.
 */
function wpvivid_delete_incompleted_restore(restore_type = 'backup'){
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    var ajax_data={
        'action': 'wpvivid_delete_last_restore_data'
    };
    jQuery('#wpvivid_restore_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_clean_'+restore_method+'restore').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_restore_'+restore_method+'part').hide();
    jQuery('#wpvivid_clean_'+restore_method+'part').show();
    jQuery('#wpvivid_rollback_'+restore_method+'part').hide();
    wpvivid_post_request(ajax_data, function(data) {
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === "success") {
                wpvivid_display_restore_msg("The restore task is terminated.", restore_type);
                wpvivid_init_restore_data(restore_type);
            }
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('deleting the last incomplete restore task', textStatus, errorThrown);
        wpvivid_display_restore_msg(error_message, restore_type);
    });
}

/**
 * This function will start rollback task.
 */
function wpvivid_start_rollback(restore_type = 'backup'){
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'none', 'opacity': '0.4'});
    wpvivid_monitor_rollback_task(restore_type);
    wpvivid_rollback(restore_type);
}

function wpvivid_rollback(restore_type){
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    var ajax_data={
        'action': 'wpvivid_rollback'
    };
    wpvivid_post_request(ajax_data, function(data) {
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === "success") {
                wpvivid_display_restore_msg("Rollback completed.", restore_type);
                jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
            }
            else if (jsonarray.result === "failed") {
                wpvivid_display_restore_msg(jsonarray.error, restore_type);
                jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
            }
        }
        catch(err){
            alert(err);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('starting rollbacking', textStatus, errorThrown);
        wpvivid_display_restore_msg(error_message, restore_type);
    });
}

/**
 * This function will monitor the rollback task.
 */
function wpvivid_monitor_rollback_task(restore_type){
    var restore_method = '';
    if(restore_type == 'backup'){
        restore_method = '';
    }
    else if(restore_type == 'transfer'){
        restore_method = 'transfer_';
    }

    var ajax_data={
        'action':'wpvivid_get_rollback_progress',
        'wpvivid_restore':'1',
    };
    wpvivid_post_request(ajax_data, function(data){
        try {
            var jsonarray = jQuery.parseJSON(data);

            if(typeof jsonarray ==='object')
            {
                if(jsonarray.result === "success")
                {
                    jQuery('#wpvivid_restore_'+restore_method+'log').html("");
                    while(jsonarray.log.indexOf('\n') >= 0){
                        var iLength = jsonarray.log.indexOf('\n');
                        var log = jsonarray.log.substring(0, iLength);
                        jsonarray.log = jsonarray.log.substring(iLength+1);
                        var insert_log = "<div style=\"clear:both;\">"+log+"</div>";
                        jQuery('#wpvivid_restore_'+restore_method+'log').append(insert_log);
                    }

                    if(jsonarray.status==='wait')
                    {
                        wpvivid_restoring = true;
                        wpvivid_rollback(restore_type);
                        setTimeout(function()
                        {
                            wpvivid_monitor_rollback_task(restore_type);
                        }, 1000);
                    }
                    else if(jsonarray.status==='completed')
                    {
                        wpvivid_restoring = false;
                        wpvivid_rollback(restore_type);
                        wpvivid_restore_unlock();
                        jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                    else if(jsonarray.status==='error')
                    {
                        wpvivid_restoring = false;
                        jQuery('#wpvivid_rollback_'+restore_method+'btn').css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                    else
                    {
                        setTimeout(function()
                        {
                            wpvivid_monitor_rollback_task(restore_type);
                        }, 1000);
                    }
                }
                else
                {
                    setTimeout(function()
                    {
                        wpvivid_monitor_rollback_task(restore_type);
                    }, 1000);
                }
            }
            else
            {
                setTimeout(function()
                {
                    wpvivid_monitor_rollback_task(restore_type);
                }, 1000);
            }
        }
        catch(err){
            setTimeout(function()
            {
                wpvivid_monitor_rollback_task(restore_type);
            }, 1000);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        setTimeout(function()
        {
            wpvivid_monitor_rollback_task(restore_type);
        }, 1000);
    });
}

/**
 * Lock certain operations while a restore task is running.
 */
function wpvivid_restore_lock(){
    jQuery('#wpvivid_postbox_backup_percent').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_postbox_backup').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_postbox_backup_schedule').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_tab_backup').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_tab_backup_log').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_tab_restore').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#page-backups').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#storage-page').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#settings-page').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#debug-page').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#logs-page').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_tab_migrate').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_migrate').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_import').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_key').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_log').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_restore').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_restore_is_migrate').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_replace_domain').css({'pointer-events': 'none', 'opacity': '1'});
    jQuery('#wpvivid_keep_domain').css({'pointer-events': 'none', 'opacity': '1'});
}

/**
 * Unlock the operations once restore task completed.
 */
function wpvivid_restore_unlock(){
    jQuery('#wpvivid_postbox_backup_percent').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_postbox_backup').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_postbox_backup_schedule').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_quickbackup_btn').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_tab_backup').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_tab_backup_log').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_tab_restore').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#page-backups').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#storage-page').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#settings-page').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#debug-page').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#logs-page').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_tab_migrate').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_migrate').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_import').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_key').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_log').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_add_tab_restore').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_restore_is_migrate').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_replace_domain').css({'pointer-events': 'auto', 'opacity': '1'});
    jQuery('#wpvivid_keep_domain').css({'pointer-events': 'auto', 'opacity': '1'});
}

/**
 * This function will delete out of date backups.
 */
function wpvivid_delete_out_of_date_backups(){
    var ajax_data={
        'action': 'wpvivid_clean_out_of_date_backup'
    };
    jQuery('#wpvivid_delete_out_of_backup').css({'pointer-events': 'none', 'opacity': '0.4'});
    wpvivid_post_request(ajax_data, function(data){
        jQuery('#wpvivid_delete_out_of_backup').css({'pointer-events': 'auto', 'opacity': '1'});
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === "success") {
                alert("Out of date backups have been removed.");
                wpvivid_handle_backup_data(data);
            }
        }
        catch(err){
            alert(err);
            jQuery('#wpvivid_delete_out_of_backup').css({'pointer-events': 'auto', 'opacity': '1'});
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('deleting out of date backups', textStatus, errorThrown);
        alert(error_message);
        jQuery('#wpvivid_delete_out_of_backup').css({'pointer-events': 'auto', 'opacity': '1'});
    });
}

/**
 * Calculate the server disk space in use by WPvivid.
 */
function wpvivid_calculate_diskspaceused(){
    var ajax_data={
        'action': 'wpvivid_junk_files_info'
    };
    var current_size = jQuery('#wpvivid_junk_sum_size').html();
    jQuery('#wpvivid_calculate_size').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_clean_junk_file').css({'pointer-events': 'none', 'opacity': '0.4'});
    jQuery('#wpvivid_junk_sum_size').html("calculating...");
    wpvivid_post_request(ajax_data, function(data){
        jQuery('#wpvivid_calculate_size').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_clean_junk_file').css({'pointer-events': 'auto', 'opacity': '1'});
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === "success") {
                jQuery('#wpvivid_junk_sum_size').html(jsonarray.data.sum_size);
                jQuery('#wpvivid_junk_log_path').html(jsonarray.data.log_path);
                jQuery('#wpvivid_junk_file_path').html(jsonarray.data.junk_path);
                jQuery('#wpvivid_restore_temp_file_path').html(jsonarray.data.old_files_path);
            }
        }
        catch(err){
            alert(err);
            jQuery('#wpvivid_calculate_size').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_clean_junk_file').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_junk_sum_size').html(current_size);
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('calculating server disk space in use by WPvivid', textStatus, errorThrown);
        alert(error_message);
        jQuery('#wpvivid_calculate_size').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_clean_junk_file').css({'pointer-events': 'auto', 'opacity': '1'});
        jQuery('#wpvivid_junk_sum_size').html(current_size);
    });
}

/**
 * Clean junk files created during backups and restorations off your web server disk.
 */
function wpvivid_clean_junk_files(){
    var descript = 'The selected item(s) will be permanently deleted. Are you sure you want to continue?';
    var ret = confirm(descript);
    if(ret === true){
        var option_data = wpvivid_ajax_data_transfer('junk-files');
        var ajax_data = {
            'action': 'wpvivid_clean_local_storage',
            'options': option_data
        };
        jQuery('#wpvivid_calculate_size').css({'pointer-events': 'none', 'opacity': '0.4'});
        jQuery('#wpvivid_clean_junk_file').css({'pointer-events': 'none', 'opacity': '0.4'});
        wpvivid_post_request(ajax_data, function (data) {
            jQuery('#wpvivid_calculate_size').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_clean_junk_file').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('input[option="junk-files"]').prop('checked', false);
            try {
                var jsonarray = jQuery.parseJSON(data);
                alert(jsonarray.msg);
                if (jsonarray.result === "success") {
                    jQuery('#wpvivid_junk_sum_size').html(jsonarray.data.sum_size);
                    jQuery('#wpvivid_junk_log_path').html(jsonarray.data.log_path);
                    jQuery('#wpvivid_junk_file_path').html(jsonarray.data.junk_path);
                    jQuery('#wpvivid_restore_temp_file_path').html(jsonarray.data.old_files_path);
                    jQuery('#wpvivid_loglist').html("");
                    jQuery('#wpvivid_loglist').append(jsonarray.html);
                    wpvivid_log_count = jsonarray.log_count;
                    wpvivid_display_log_page();
                }
            }
            catch(err){
                alert(err);
            }
        }, function (XMLHttpRequest, textStatus, errorThrown) {
            var error_message = wpvivid_output_ajaxerror('cleaning out junk files', textStatus, errorThrown);
            alert(error_message);
            jQuery('#wpvivid_calculate_size').css({'pointer-events': 'auto', 'opacity': '1'});
            jQuery('#wpvivid_clean_junk_file').css({'pointer-events': 'auto', 'opacity': '1'});
        });
    }
}

/**
 * Download the relevant website info and error logs to your PC for debugging purposes.
 */
function wpvivid_download_website_info(){
    wpvivid_location_href=true;
    location.href =ajaxurl+'?action=wpvivid_create_debug_package';
}

function wpvivid_click_send_debug_info(){
    var wpvivid_user_mail = jQuery('#wpvivid_user_mail').val();
    var ajax_data = {
        'action': 'wpvivid_send_debug_info',
        'user_mail': wpvivid_user_mail
    };
    wpvivid_post_request(ajax_data, function (data) {
        try {
            var jsonarray = jQuery.parseJSON(data);
            if (jsonarray.result === "success") {
                alert("Send succeeded.");
            }
            else {
                alert(jsonarray.error);
            }
        }
        catch (err) {
            alert(err);
        }
    }, function (XMLHttpRequest, textStatus, errorThrown) {
        var error_message = wpvivid_output_ajaxerror('sending debug information', textStatus, errorThrown);
        alert(error_message);
    });
}

/**
 * Output ajax error in a standard format.
 *
 * @param action        - The specific operation
 * @param textStatus    - The textual status message returned by the server
 * @param errorThrown   - The error message thrown by server
 *
 * @returns {string}
 */
function wpvivid_output_ajaxerror(action, textStatus, errorThrown){
    action = 'trying to establish communication with your server';
    var error_msg = "wpvivid_request: "+ textStatus + "(" + errorThrown + "): an error occurred when " + action + ". " +
        "This error may be request not reaching or server not responding. Please try again later.";
        //"This error could be caused by an unstable internet connection. Please try again later.";
    return error_msg;
}

function wpvivid_add_review_info(review){
    var ajax_data={
        'action': 'wpvivid_need_review',
        'review': review
    };
    jQuery('#wpvivid_notice_rate').hide();
    wpvivid_post_request(ajax_data, function(res){
        if(typeof res != 'undefined' && res != ''){
            var tempwindow=window.open('_blank');
            tempwindow.location=res;
        }
    }, function(XMLHttpRequest, textStatus, errorThrown) {
    });
}

function wpvivid_ajax_data_transfer(data_type){
    var json = {};
    jQuery('input:checkbox[option='+data_type+']').each(function() {
        var value = '0';
        var key = jQuery(this).prop('name');
        if(jQuery(this).prop('checked')) {
            value = '1';
        }
        else {
            value = '0';
        }
        json[key]=value;
    });
    jQuery('input:radio[option='+data_type+']').each(function() {
        if(jQuery(this).prop('checked'))
        {
            var key = jQuery(this).prop('name');
            var value = jQuery(this).prop('value');
            json[key]=value;
        }
    });
    jQuery('input:text[option='+data_type+']').each(function(){
        var obj = {};
        var key = jQuery(this).prop('name');
        var value = jQuery(this).val();
        json[key]=value;
    });
    jQuery('input:password[option='+data_type+']').each(function(){
        var obj = {};
        var key = jQuery(this).prop('name');
        var value = jQuery(this).val();
        json[key]=value;
    });
    jQuery('select[option='+data_type+']').each(function(){
        var obj = {};
        var key = jQuery(this).prop('name');
        var value = jQuery(this).val();
        json[key]=value;
    });
    return JSON.stringify(json);
}