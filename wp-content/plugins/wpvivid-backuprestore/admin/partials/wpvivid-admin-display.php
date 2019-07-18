<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wpvivid.com
 * @since      0.9.1
 *
 * @package    WPvivid
 * @subpackage WPvivid/admin/partials
 */

include_once WPVIVID_PLUGIN_DIR .'/admin/partials/wpvivid-backup-restore-page-display.php';
include_once WPVIVID_PLUGIN_DIR .'/admin/partials/wpvivid-remote-storage-page-display.php';
include_once WPVIVID_PLUGIN_DIR .'/admin/partials/wpvivid-settings-page-display.php';
include_once WPVIVID_PLUGIN_DIR .'/admin/partials/wpvivid-schedule-page-display.php';
include_once WPVIVID_PLUGIN_DIR .'/admin/partials/wpvivid-website-info-page-display.php';
include_once WPVIVID_PLUGIN_DIR .'/admin/partials/wpvivid-logs-page-display.php';
include_once WPVIVID_PLUGIN_DIR .'/admin/partials/wpvivid-log-read-page-display.php';

if (!defined('WPVIVID_PLUGIN_DIR'))
{
    die;
}

global $wpvivid_pulgin;
$backuplist=WPvivid_Backuplist::get_backuplist();
$remoteslist=WPvivid_Setting::get_all_remote_options();
$select=WPvivid_Setting::get_user_history('remote_selected');
$schedule=WPvivid_Schedule::get_schedule();
$backupdir=WPvivid_Setting::get_backupdir();
$general_setting=WPvivid_Setting::get_setting(true, "");
$last_msg=WPvivid_Setting::get_last_backup_message('wpvivid_last_msg');
$out_of_date=$wpvivid_pulgin->_get_out_of_date_info();
$junk_file=$wpvivid_pulgin->_junk_files_info();
$website_info=$wpvivid_pulgin->get_website_info();
$loglist=$wpvivid_pulgin->get_log_list_ex();
$default_remote_storage='';
foreach ($remoteslist['remote_selected'] as $value) {
    $default_remote_storage=$value;
}
$backup_task=$wpvivid_pulgin->_list_tasks(false);
$wpvivid_version=WPVIVID_PLUGIN_VERSION;

do_action('show_notice');


function wpvivid_schedule_module($html){
    $html = '';
    return $html;
}
add_filter('wpvivid_schedule_module', 'wpvivid_schedule_module', 10);

?>

<?php

$page_array = array();
$page_array = apply_filters('wpvivid_add_tab_page', $page_array);
foreach ($page_array as $page_name){
    add_action('wpvivid_backuprestore_add_tab', $page_name['tab_func'], $page_name['index']);
    add_action('wpvivid_backuprestore_add_page', $page_name['page_func'], $page_name['index']);
}

?>

<div class="wrap">
<h1><?php _e('WPvivid Backup Plugin', 'wpvivid'); ?></h1>
    <div id="wpvivid_backup_notice">
        <?php
        if($schedule['enable'] == true) {
            if($schedule['backup']['remote'] === 1)
            {
                if($default_remote_storage == ''){
                    _e('<div class="notice notice-warning is-dismissible"><p>Warning: There is no default remote storage available for the scheduled backups, please set up it first.</p></div>');
                }
            }
        }
        ?>
    </div>
    <div id="wpvivid_remote_notice"></div>
</div>
<h2 class="nav-tab-wrapper">
    <?php
    do_action('wpvivid_backuprestore_add_tab');
    ?>
</h2>
<div class="wrap" style="max-width:1720px;">
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="inside" style="margin-top:0;">
                    <?php
                    do_action('wpvivid_backuprestore_add_page');
                    ?>
                </div>

            </div>

            <div id="postbox-container-1" class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">
                        <h2><span>Current Version: <?php _e($wpvivid_version, 'wpvivid'); ?></span></h2>
                    </div>
                    <div>
                        <?php
                        $schedule_html = '';
                        echo apply_filters('wpvivid_schedule_module', $schedule_html);
                        ?>
                    </div>
                    <div class="postbox">
                        <h2><span>How-to</span></h2>
                        <div class="inside">
                            <table class="widefat" cellpadding="0">
                                <tbody>
                                <tr class="alternate"><td class="row-title"><a href="https://wpvivid.com/get-started-settings.html" target="_blank">WPvivid Backup Settings</a></td></tr>
                                <tr><td class="row-title"><a href="https://wpvivid.com/get-started-create-a-manual-backup.html" target="_blank">Create a Manual Backup</a></td></tr>
                                <tr class="alternate"><td class="row-title"><a href="https://wpvivid.com/get-started-restore-site.html" target="_blank">Restore Your Site from a Backup</a></td></tr>
                                <tr><td class="row-title"><a href="https://wpvivid.com/get-started-transfer-site.html" target="_blank">Migrate WordPress</a></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br class="clear">
    </div>
</div>

<script>
    function switchTabs(evt,contentName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("wrap-tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="wrap-nav-tab" and remove the class "active"
        tablinks = document.getElementsByClassName("wrap-nav-tab");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" nav-tab-active", "");
        }

        // Show the current tab, and add an "nav-tab-active" class to the button that opened the tab
        document.getElementById(contentName).style.display = "block";
        evt.currentTarget.className += " nav-tab-active";
    }
    function switchrestoreTabs(evt,contentName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="table-list-content" and hide them
        tabcontent = document.getElementsByClassName("backup-tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="table-nav-tab" and remove the class "nav-tab-active"
        tablinks = document.getElementsByClassName("backup-nav-tab");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" nav-tab-active", "");
        }

        // Show the current tab, and add an "storage-menu-active" class to the button that opened the tab
        document.getElementById(contentName).style.display = "block";
        evt.currentTarget.className += " nav-tab-active";
    }

    var wpvivid_siteurl = '<?php
        $wpvivid_siteurl = array();
        $wpvivid_siteurl=WPvivid_Admin::wpvivid_get_siteurl();
        echo esc_url($wpvivid_siteurl['home_url']);
        ?>';
    var wpvivid_plugurl =  '<?php
        echo plugins_url( '', __FILE__ );
        ?>';
    var wpvivid_log_count = '<?php
        _e(sizeof($loglist['log_list']['file']), 'wpvivid');
        ?>';
    var wpvivid_log_array = '<?php
        _e(json_encode($loglist), 'wpvivid');
        ?>';
    var wpvivid_page_request = '<?php
        $page_request = WPvivid_Admin::wpvivid_get_page_request();
        _e($page_request, 'wpvivid');
        ?>';
    var wpvivid_default_remote_storage = '<?php
        _e($default_remote_storage, 'wpvivid');
        ?>';

</script>
