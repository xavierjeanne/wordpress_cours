<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
define('NECESSARY','1');
define('OPTION','0');
class WPvivid_Backup_Database
{
    private $task_id;

    public function __construct()
    {
    }

    public function backup_database($data,$task_id = '')
    {
        global $wpvivid_pulgin;
        $dump=null;

        try
        {
            $this->task_id=$task_id;

            $backup_file =$data['sql_file_name'];

            require_once 'class-wpvivid-mysqldump-method.php';
            require_once 'class-wpvivid-mysqldump.php';

            $db_method=new WPvivid_DB_Method();
            $version =$db_method->get_mysql_version();

            if(version_compare('4.1.0',$version) > 0)
            {
                return array('result'=>WPVIVID_FAILED,'error'=>'Your MySQL version is too old. Please upgrade at least to MySQL 4.1.0.');
            }

            if(version_compare('5.3.0',phpversion()) > 0){
                return array('result'=>WPVIVID_FAILED,'error'=>'Your PHP version is too old. Please upgrade at least to PHP 5.3.0.');
            }

            $db_method->check_max_allowed_packet();
            add_filter('wpvivid_exclude_db_table', array($this, 'exclude_table'),10,2);
            $exclude=array();
            $exclude = apply_filters('wpvivid_exclude_db_table',$exclude, $data);

            //$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            $dump = new WPvivid_Mysqldump(DB_HOST,DB_NAME, DB_USER, DB_PASSWORD , array('exclude-tables'=>$exclude,'add-drop-table' => true,'extended-insert'=>false));

            if(file_exists($backup_file))
                @unlink($backup_file);

            $dump->task_id=$task_id;
            $dump->start($backup_file);
            unset($pdo);
        }
        catch (Exception $e)
        {
            $str_last_query_string='';
            if(!is_null($dump))
            {
                $str_last_query_string=$dump->last_query_string;
            }
            if(!empty($str_last_query_string))
            {
                $wpvivid_pulgin->wpvivid_log->WriteLog('last query string:'.$str_last_query_string,'error');
            }
            $message = 'A exception ('.get_class($e).') occurred '.$e->getMessage().' (Code: '.$e->getCode().', line '.$e->getLine().' in '.$e->getFile().')';
            return array('result'=>WPVIVID_FAILED,'error'=>$message);
        }

	    $files = array();
        $files[] = $backup_file;
        return array('result'=>WPVIVID_SUCCESS,'files'=>$files);
    }

    public function exclude_table($exclude,$data)
    {
        global $wpdb;
        if (is_multisite() && !defined('MULTISITE'))
        {
            $prefix = $wpdb->base_prefix;
        } else {
            $prefix = $wpdb->get_blog_prefix(0);
        }
        $exclude = array('/^(?!' . $prefix . ')/');
        return $exclude;
    }
}