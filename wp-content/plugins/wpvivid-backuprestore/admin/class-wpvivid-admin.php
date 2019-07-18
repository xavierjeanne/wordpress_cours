<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wpvivid.com
 * @since      0.9.1
 *
 * @package    WPvivid
 * @subpackage WPvivid/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WPvivid
 * @subpackage WPvivid/admin
 * @author     wpvivid team
 */
if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
class WPvivid_Admin {

    /**
     * The ID of this plugin.
     *
     * 
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * 
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * 
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;



    }
    /**
     * Register the stylesheets for the admin area.
     *
     * 
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WPvivid_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WPvivid_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        if ('toplevel_page_'.$this->plugin_name == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-transfer' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-setting' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-schedule' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-remote' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-website' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-log' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-key' == get_current_screen()->id) {
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wpvivid-admin.css', array(), $this->version, 'all');
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * 
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in WPvivid_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The WPvivid_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        if ('toplevel_page_'.$this->plugin_name == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-transfer' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-setting' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-schedule' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-remote' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-website' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-log' == get_current_screen()->id ||
            'wpvivid-backup_page_wpvivid-key' == get_current_screen()->id) {
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wpvivid-admin.js', array('jquery'), $this->version, false);
            wp_localize_script($this->plugin_name, 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

            wp_enqueue_script('plupload-all');
        }
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * 
     */
    public function add_plugin_admin_menu() {

        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_menu_page(__('WPvivid Backup'), __('WPvivid Backup'), 'administrator', $this->plugin_name, array($this, 'display_plugin_backup_page'), 'dashicons-cloud', 100);
        $general_setting=WPvivid_Setting::get_setting(true, "");
        if(!isset($general_setting['options']['wpvivid_common_setting']['show_tab_menu'])){
            $wpvivid_show_tab_menu=true;
        }
        else {
            if ($general_setting['options']['wpvivid_common_setting']['show_tab_menu']) {
                $wpvivid_show_tab_menu=true;
            } else {
                $wpvivid_show_tab_menu=false;
            }
        }
        if($wpvivid_show_tab_menu) {
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Backup & Restore', 'wpvivid'), 'administrator', $this->plugin_name, array($this, 'display_plugin_backup_page'), false, 100);
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Schedule', 'wpvivid'), 'administrator', 'wpvivid-schedule', array($this, 'display_plugin_schedule_page'), false, 100);
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Auto-Migration', 'wpvivid'), 'administrator', 'wpvivid-transfer', array($this, 'display_plugin_transfer_page'), false, 100);
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Remote Storage', 'wpvivid'), 'administrator', 'wpvivid-remote', array($this, 'display_plugin_remote_page'), false, 100);
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Settings', 'wpvivid'), 'administrator', 'wpvivid-setting', array($this, 'display_plugin_setting_page'), false, 100);
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Website Info', 'wpvivid'), 'administrator', 'wpvivid-website', array($this, 'display_plugin_website_page'), false, 100);
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Logs', 'wpvivid'), 'administrator', 'wpvivid-log', array($this, 'display_plugin_log_page'), false, 100);
            add_submenu_page($this->plugin_name, __('WPvivid Backup'), __('Key', 'wpvivid'), 'administrator', 'wpvivid-key', array($this, 'display_plugin_key_page'), false, 100);
        }
    }

    function add_toolbar_items($wp_admin_bar){
        global $wpvivid_pulgin;
        $show_admin_bar = $wpvivid_pulgin->get_admin_bar_setting();
        if($show_admin_bar === true){
            $admin_url = admin_url();
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu',
                'title' => 'WPvivid Backup'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_backup',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Backup & Restore',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-backup'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_schedule',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Schedule',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-schedule'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_transfer',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Auto-Migration',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-transfer'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_addons',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Remote Storage',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-remote-storage'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_settings',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Settings',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-settings'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_debug',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Website Info',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-website-info'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_logs',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Logs',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-logs'
            ));
            $wp_admin_bar->add_menu(array(
                'id' => 'wpvivid_admin_menu_key',
                'parent' => 'wpvivid_admin_menu',
                'title' => 'Key',
                'href' => $admin_url . 'admin.php?page=WPvivid&tab-key'
            ));
        }
    }

    public function add_action_links( $links ) {
        $settings_link = array(
            '<a href="' . admin_url( 'admin.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );
    }

    public static function wpvivid_get_siteurl(){
        $wpvivid_siteurl = array();
        $wpvivid_siteurl['home_url'] = home_url();
        $wpvivid_siteurl['plug_url'] = plugins_url();
        return $wpvivid_siteurl;
    }

    /**
     * Render the settings page for this plugin.
     *
     * 
     */
    public function display_plugin_setup_page()
    {
        if(isset($_REQUEST['tab-backup'])){
            self::wpvivid_set_page_request('backup');
        }
        else if(isset($_REQUEST['tab-transfer'])){
            self::wpvivid_set_page_request('transfer');
        }
        else if(isset($_REQUEST['tab-settings'])){
            self::wpvivid_set_page_request('settings');
        }
        else if(isset($_REQUEST['tab-schedule'])){
            self::wpvivid_set_page_request('schedule');
        }
        else if(isset($_REQUEST['tab-remote-storage'])){
            self::wpvivid_set_page_request('remote');
        }
        else if(isset($_REQUEST['tab-website-info'])){
            self::wpvivid_set_page_request('website');
        }
        else if(isset($_REQUEST['tab-logs'])){
            self::wpvivid_set_page_request('log');
        }
        else if(isset($_REQUEST['tab-key'])){
            self::wpvivid_set_page_request('key');
        }
        global $wpvivid_pulgin;
        $wpvivid_pulgin->clean_cache();


        //
        $migrate_notice=false;
        $migrate_status=WPvivid_Setting::get_option('wpvivid_migrate_status');
        if(!empty($migrate_status) && $migrate_status == 'completed'){
            $migrate_notice=true;
            _e('<div class="notice notice-warning is-dismissible"><p>Migration is complete and htaccess file is replaced. In order to successfully complete the migration, you\'d better reinstall 301 redirect plugin, firewall and security plugin, and caching plugin if they exist.</p></div>');
            WPvivid_Setting::delete_option('wpvivid_migrate_status');
        }


        $restore = new WPvivid_restore_data();
        if ($restore->has_restore()) {
            $restore_status = $restore->get_restore_status();
            if ($restore_status === WPVIVID_RESTORE_COMPLETED) {
                $restore->clean_restore_data();
                $need_review=WPvivid_Setting::get_option('wpvivid_need_review');
                if($need_review=='not')
                {
                    WPvivid_Setting::update_option('wpvivid_need_review','show');
                    $msg = 'Cheers! WPvivid Backup plugin has restored successfully your website. If you found WPvivid Backup plugin helpful, a 5-star rating would be highly appreciated, which motivates us to keep providing new features.';
                    WPvivid_Setting::update_option('wpvivid_review_msg',$msg);
                }
                else{
                    if(!$migrate_notice) {
                        _e('<div class="notice notice-success is-dismissible"><p>Restore completed successfully.</p></div>');
                    }
                }
            }
        }

        $this->wpvivid_show_add_my_review();
        $this->wpvivid_check_extensions();

        include_once('partials/wpvivid-admin-display.php');
    }
    
    public function display_plugin_backup_page(){
        self::wpvivid_set_page_request('backup');
        $this->display_plugin_setup_page();
    }

    public function display_plugin_transfer_page(){
        self::wpvivid_set_page_request('transfer');
        $this->display_plugin_setup_page();
    }

    public function display_plugin_setting_page(){
        self::wpvivid_set_page_request('settings');
        $this->display_plugin_setup_page();
    }

    public function display_plugin_schedule_page(){
        self::wpvivid_set_page_request('schedule');
        $this->display_plugin_setup_page();
    }

    public function display_plugin_remote_page(){
        self::wpvivid_set_page_request('remote');
        $this->display_plugin_setup_page();
    }

    public function display_plugin_website_page(){
        self::wpvivid_set_page_request('website');
        $this->display_plugin_setup_page();
    }

    public function display_plugin_log_page(){
        self::wpvivid_set_page_request('log');
        $this->display_plugin_setup_page();
    }

    public function display_plugin_key_page(){
        self::wpvivid_set_page_request('key');
        $this->display_plugin_setup_page();
    }

    public function wpvivid_set_page_request($page){
        global $request_page;
        $request_page=$page;
    }

    public static function wpvivid_get_page_request(){
        global $request_page;
        return $request_page;
    }

    public static function wpvivid_show_add_my_review()
    {
        $review = WPvivid_Setting::get_option('wpvivid_need_review');
        $review_msg = WPvivid_Setting::get_option('wpvivid_review_msg');
        if (empty($review)) {
            WPvivid_Setting::update_option('wpvivid_need_review', 'not');
        } else {
            if ($review == 'not') {
            } else if ($review == 'show') {
                if(!empty($review_msg)) {
                    _e('<div class="notice notice-info is-dismissible" id="wpvivid_notice_rate">
                    <p>' . $review_msg . '</p>
                    <div style="padding-bottom: 10px;">
                    <span><input type="button" class="button-primary" option="review" name="rate-now" value="Rate Us" /></span>
                    <span><input type="button" class="button-secondary" option="review" name="ask-later" value="Maybe Later" /></span>
                    <span><input type="button" class="button-secondary" option="review" name="never-ask" value="Never" /></span>
                    </div>
                    </div>');
                }
            } else if ($review == 'do_not_ask') {
            } else {
                if (time() > $review) {
                    if(!empty($review_msg)) {
                        _e('<div class="notice notice-info is-dismissible" id="wpvivid_notice_rate">
                        <p>' . $review_msg . '</p>
                        <div style="padding-bottom: 10px;">
                        <span><input type="button" class="button-primary" option="review" name="rate-now" value="Rate Us" /></span>    
                        <span><input type="button" class="button-secondary" option="review" name="ask-later" value="Maybe Later" /></span>
                        <span><input type="button" class="button-secondary" option="review" name="never-ask" value="Never" /></span>
                        </div>
                        </div>');
                    }
                }
            }
        }
    }

    public static function wpvivid_check_extensions(){
        $need_php_extensions = array();
        $need_extensions_count = 0;
        $extensions=get_loaded_extensions();
        if(!function_exists("curl_init")){
            $need_php_extensions[$need_extensions_count] = 'curl';
            $need_extensions_count++;
        }
        if(!class_exists('PDO')){
            $need_php_extensions[$need_extensions_count] = 'PDO';
            $need_extensions_count++;
        }
        if(!function_exists("gzopen"))
        {
            $need_php_extensions[$need_extensions_count] = 'zlib';
            $need_extensions_count++;
        }
        if(!array_search('pdo_mysql',$extensions))
        {
            $need_php_extensions[$need_extensions_count] = 'pdo_mysql';
            $need_extensions_count++;
        }
        if(!empty($need_php_extensions)){
            $msg = '';
            $figure = 0;
            foreach ($need_php_extensions as $extension){
                $figure++;
                if($figure == 1){
                    $msg .= $extension;
                }
                else if($figure < $need_extensions_count) {
                    $msg .= ', '.$extension;
                }
                else if($figure == $need_extensions_count){
                    $msg .= ' and '.$extension;
                }
            }
            if($figure == 1){
                _e('<div class="notice notice-error"><p>The '.$msg.' extension is not detected. Please install the extension first.</p></div>');
            }
            else{
                _e('<div class="notice notice-error"><p>The '.$msg.' extensions are not detected. Please install the extensions first.</p></div>');
            }
        }

        if (!class_exists('PclZip')) include_once(ABSPATH.'/wp-admin/includes/class-pclzip.php');
        if (!class_exists('PclZip')) {
            _e('<div class="notice notice-error"><p>Class PclZip is not detected. Please update or reinstall your WordPress.</p></div>');
        }

        if(defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON){
            _e('<div class="notice notice-error"><p>In order to execute the scheduled backups properly, please set the DISABLE_WP_CRON constant to false.</p></div>');
        }
    }

    public function wpvivid_add_default_tab_page($page_array){
        $page_array['backup_restore'] = array('index' => '1', 'tab_func' => array($this, 'wpvivid_add_tab_backup_restore'), 'page_func' => array($this, 'wpvivid_add_page_backup'));
        $page_array['schedule'] = array('index' => '2', 'tab_func' => array($this, 'wpvivid_add_tab_schedule'), 'page_func' => array($this, 'wpvivid_add_page_schedule'));
        $page_array['remote_storage'] = array('index' => '4', 'tab_func' => array($this, 'wpvivid_add_tab_remote_storage'), 'page_func' => array($this, 'wpvivid_add_page_remote_storage'));
        $page_array['setting'] = array('index' => '5', 'tab_func' => array($this, 'wpvivid_add_tab_setting'), 'page_func' => array($this, 'wpvivid_add_page_setting'));
        $page_array['website_info'] = array('index' => '6', 'tab_func' => array($this, 'wpvivid_add_tab_website_info'), 'page_func' => array($this, 'wpvivid_add_page_website_info'));
        $page_array['log'] = array('index' => '7', 'tab_func' => array($this, 'wpvivid_add_tab_log'), 'page_func' => array($this, 'wpvivid_add_page_log'));
        $page_array['read_log'] = array('index' => '9', 'tab_func' => array($this, 'wpvivid_add_tab_read_log'), 'page_func' => array($this, 'wpvivid_add_page_read_log'));
        return $page_array;
    }

    public function wpvivid_add_tab_backup_restore(){
        ?>
        <a href="#" id="wpvivid_tab_general" class="nav-tab wrap-nav-tab nav-tab-active" onclick="switchTabs(event,'general-page')"><?php _e('Backup & Restore', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_schedule(){
        ?>
        <a href="#" id="wpvivid_tab_schedule" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'schedule-page')"><?php _e('Schedule', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_remote_storage(){
        ?>
        <a href="#" id="wpvivid_tab_remote_storage" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'storage-page')"><?php _e('Remote Storage', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_setting(){
        ?>
        <a href="#" id="wpvivid_tab_setting" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'settings-page')"><?php _e('Settings', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_website_info(){
        ?>
        <a href="#" id="wpvivid_tab_debug" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'debug-page')"><?php _e('Website Info', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_log(){
        ?>
        <a href="#" id="wpvivid_tab_log" class="nav-tab wrap-nav-tab" onclick="switchTabs(event,'logs-page')"><?php _e('Logs', 'wpvivid'); ?></a>
        <?php
    }

    public function wpvivid_add_tab_read_log(){
        ?>
        <a href="#" id="wpvivid_tab_read_log" class="nav-tab wrap-nav-tab delete" onclick="switchTabs(event,'log-read-page')" style="display: none;">
            <div style="margin-right: 15px;"><?php _e('Log', 'wpvivid'); ?></div>
            <div class="nav-tab-delete-img">
                <img src="<?php echo esc_url( WPVIVID_PLUGIN_URL.'/admin/partials/images/delete-tab.png' ); ?>" style="vertical-align:middle; cursor:pointer;" onclick="wpvivid_close_tab(event, 'wpvivid_tab_read_log', 'wrap', 'wpvivid_tab_log');" />
            </div>
        </a>
        <?php
    }

    public function wpvivid_add_page_backup(){
        $html_progress = '';
        $html_backup = '';
        $html_schedule = '';
        ?>
        <div id="general-page" class="wrap-tab-content wpvivid_tab_general" name="tab-backup" style="width:100%;">
            <div class="meta-box-sortables ui-sortable">
                <?php
                echo apply_filters('wpvivid_backuppage_load_progress_module', $html_progress);
                echo apply_filters('wpvivid_backuppage_load_backup_module', $html_backup);
                echo apply_filters('wpvivid_backuppage_load_schedule_module', $html_schedule);
                ?>
                <h2 class="nav-tab-wrapper" id="wpvivid_backup_tab" style="padding-bottom:0!important;">
                <?php
                $backuplist_array = array();
                $backuplist_array = apply_filters('wpvivid_backuppage_load_backuplist', $backuplist_array);
                foreach ($backuplist_array as $list_name) {
                    add_action('wpvivid_backuppage_add_tab', $list_name['tab_func'], $list_name['index']);
                    add_action('wpvivid_backuppage_add_page', $list_name['page_func'], $list_name['index']);
                }
                do_action('wpvivid_backuppage_add_tab');
                ?>
                </h2>
                <?php  do_action('wpvivid_backuppage_add_page'); ?>
            </div>
        </div>
        <script>
            <?php do_action('wpvivid_backup_do_js'); ?>
        </script>
        <?php
    }

    public function wpvivid_add_page_schedule(){
        ?>
        <div id="schedule-page" class="wrap-tab-content wpvivid_tab_schedule" name="tab-schedule" style="display: none;">
            <div>
                <table class="widefat">
                    <tbody>
                    <?php do_action('wpvivid_schedule_add_cell'); ?>
                    <tfoot>
                    <tr>
                        <th class="row-title"><input class="button-primary storage-account-button" id="wpvivid_schedule_save" type="submit" name="" value="<?php esc_attr_e( 'Save Changes', 'wpvivid' ); ?>" /></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    public function wpvivid_add_page_remote_storage(){
        ?>
        <div id="storage-page" class="wrap-tab-content wpvivid_tab_remote_storage" name="tab-storage" style="display:none;">
            <div>
                <div class="storage-content" id="storage-brand-2" style="">
                    <div class="postbox">
                        <?php do_action('wpvivid_add_storage_tab'); ?>
                    </div>
                    <div class="postbox storage-account-block" id="wpvivid_storage_account_block">
                        <?php do_action('wpvivid_add_storage_page'); ?>
                    </div>
                    <?php
                    $html = '';
                    $html = apply_filters('wpvivid_storage_list', $html);
                    echo $html;
                    ?>
                    <div class="storage-tab-content wpvivid_tab_storage_edit" id="page-storage_edit" style="display:none;">
                        <div><?php do_action('wpvivid_edit_remote_page'); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function wpvivid_add_page_setting(){
        ?>
        <div id="settings-page" class="wrap-tab-content wpvivid_tab_setting" name="tab-setting" style="display:none;">
            <div>
                <table class="widefat">
                    <tbody>
                    <?php do_action('wpvivid_setting_add_cell'); ?>
                    <tfoot>
                    <tr>
                        <th class="row-title"><input class="button-primary storage-account-button" id="wpvivid_setting_general_save" type="submit" name="" value="<?php esc_attr_e( 'Save Changes', 'wpvivid' ); ?>" /></th>
                        <th></th>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    public function wpvivid_add_page_website_info(){
        ?>
        <div id="debug-page" class="wrap-tab-content wpvivid_tab_debug" name="tab-debug" style="display:none;">
            <table class="widefat">
                <div style="padding: 0 0 20px 10px;">There are two ways available to send us the debug information. The first one is recommended.</div>
                <div style="padding-left: 10px;">
                    <strong><?php _e('Method 1.'); ?></strong> <?php _e('If you have configured SMTP on your site, enter your email address and click the button below to send us the relevant information (website info and errors logs) when you are encountering errors. This will help us figure out what happened. Once the issue is resolved, we will inform you by your email address.', 'wpvivid'); ?>
                </div>
                <div style="padding:10px 10px 0">
                    <span>WPvivid support email:</span><input type="text" id="wpvivid_support_mail" value="support@wpvivid.com" readonly />
                    <span>Your email:</span><input type="text" id="wpvivid_user_mail" />
                </div>
                <div class="schedule-tab-block">
                    <input class="button-primary" type="submit" value="<?php esc_attr_e( 'Send Debug Information to Us', 'wpvivid' ); ?>" onclick="wpvivid_click_send_debug_info();" />
                </div>
                <div style="clear:both;"></div>
                <div style="padding-left: 10px;">
                    <strong><?php _e('Method 2.'); ?></strong> <?php _e('If you didn’t configure SMTP on your site, click the button below to download the relevant information (website info and error logs) to your PC when you are encountering some errors. Sending the files to us will help us diagnose what happened.', 'wpvivid'); ?>
                </div>
                <div class="schedule-tab-block">
                    <input class="button-primary" id="wpvivid_download_website_info" type="submit" name="download-website-info" value="<?php esc_attr_e( 'Download', 'wpvivid' ); ?>" />
                </div>
                <thead class="website-info-head">
                <tr>
                    <th class="row-title" style="min-width: 260px;"><?php _e( 'Website Info Key', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Website Info Value', 'wpvivid' ); ?></th>
                </tr>
                </thead>
                <tbody class="wpvivid-websiteinfo-list" id="wpvivid_websiteinfo_list">
                <?php
                if(!empty($website_info['data'])){
                    foreach ($website_info['data'] as $key=>$value) { ?>
                        <?php
                        $website_value='';
                        if (is_array($value)) {
                            foreach ($value as $arr_value) {
                                if (empty($website_value)) {
                                    $website_value = $website_value . $arr_value;
                                } else {
                                    $website_value = $website_value . ', ' . $arr_value;
                                }
                            }
                        }
                        else{
                            if($value === true || $value === false){
                                if($value === true) {
                                    $website_value = 'true';
                                }
                                else{
                                    $website_value = 'false';
                                }
                            }
                            else {
                                $website_value = $value;
                            }
                        }
                        ?>
                        <tr>
                            <td class="row-title tablelistcolumn"><label for="tablecell"><?php _e($key, 'wpvivid'); ?></label></td>
                            <td class="tablelistcolumn"><?php _e($website_value, 'wpvivid'); ?></td>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function wpvivid_add_page_log(){
        global $wpvivid_pulgin;
        $display_log_count=array(0=>"10",1=>"20",2=>"30",3=>"40",4=>"50");
        $max_log_diaplay=20;
        $loglist=$wpvivid_pulgin->get_log_list_ex();
        ?>
        <div id="logs-page" class="wrap-tab-content wpvivid_tab_log" name="tab-logs" style="display:none;">
            <div style="padding-bottom: 10px; float: right;">
                <select name="" id="wpvivid_display_log_count">
                    <?php
                    foreach ($display_log_count as $value){
                        if($value == $max_log_diaplay){
                            _e('<option selected="selected" value="' . $value . '">' . $value . '</option>', 'wpvivid');
                        }
                        else {
                            _e('<option value="' . $value . '">' . $value . '</option>', 'wpvivid');
                        }
                    }
                    ?>
                </select>
            </div>
            <table class="wp-list-table widefat plugins">
                <thead class="log-head">
                <tr>
                    <th class="row-title"><?php _e( 'Date', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Log Type', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Log File Name', 'wpvivid' ); ?></th>
                    <th><?php _e( 'Action', 'wpvivid' ); ?></th>
                </tr>
                </thead>
                <tbody class="wpvivid-loglist" id="wpvivid_loglist">
                <?php
                $html = '';
                $html = apply_filters('wpvivid_get_log_list', $html);
                echo $html['html'];
                ?>
                </tbody>
            </table>
            <div style="padding-top: 10px; text-align: center;">
                <input class="button-secondary log-page" id="wpvivid_pre_log_page" type="submit" value="<?php esc_attr_e( ' < Pre page ', 'wpvivid' ); ?>" />
                <div style="font-size: 12px; display: inline-block; padding-left: 10px;">
                                <span id="wpvivid_log_page_info" style="line-height: 35px;">
                                    <?php
                                    $current_page=1;
                                    $max_page=ceil(sizeof($loglist['log_list']['file'])/$max_log_diaplay);
                                    if($max_page == 0) $max_page = 1;
                                    _e($current_page.' / '.$max_page, 'wpvivid');
                                    ?>
                                </span>
                </div>
                <input class="button-secondary log-page" id="wpvivid_next_log_page" type="submit" value="<?php esc_attr_e( ' Next page > ', 'wpvivid' ); ?>" />
            </div>
        </div>
        <?php
    }

    public function wpvivid_add_page_read_log(){
        ?>
        <div id="log-read-page" class="wrap-tab-content wpvivid_tab_read_log" style="display:none;">
            <div class="postbox restore_log" id="wpvivid_read_log_content">
                <div></div>
            </div>
        </div>
        <?php
    }
}