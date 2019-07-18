<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}

include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-restore-database.php';
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-restore-site.php';
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-log.php';
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-zipclass.php';

class WPvivid_Restore
{
    public function restore()
    {
        @set_time_limit(1800);

        global $wpvivid_pulgin;

        $next_task=$wpvivid_pulgin->restore_data->get_next_restore_task();

        if($next_task===false)
        {
            $wpvivid_pulgin->restore_data->write_log('Restore task completed.','notice');
            $wpvivid_pulgin->restore_data->update_status(WPVIVID_RESTORE_COMPLETED);
            return array('result'=>WPVIVID_SUCCESS);
        }
        else if($next_task===WPVIVID_RESTORE_RUNNING)
        {
            $wpvivid_pulgin->restore_data->update_error('A restore task is already running.');
            $wpvivid_pulgin->restore_data->write_log('A restore task is already running.','error');
            return array('result'=>WPVIVID_FAILED,'error'=> 'A restore task is already running.');
        }
        else
        {
            $result = $this -> execute_restore($next_task);
            $wpvivid_pulgin->restore_data->update_sub_task($next_task['index'],$result);

            if($result['result'] != WPVIVID_SUCCESS)
            {
                $wpvivid_pulgin->restore_data->update_error($result['error']);
                $wpvivid_pulgin->restore_data->write_log($result['error'],'error');
                return array('result'=>WPVIVID_FAILED,'error'=>$result['error']);
            }
            else {
                $wpvivid_pulgin->restore_data->update_status(WPVIVID_RESTORE_WAIT);
                return array('result'=> WPVIVID_SUCCESS);
            }
        }
    }

    function execute_restore($restore_task)
    {
        global $wpvivid_pulgin;

        $backup=$wpvivid_pulgin->restore_data->get_backup_data();
        $backup_item=new WPvivid_Backup_Item($backup);
        $json=$backup_item->get_file_info($restore_task['files'][0]);
        $option=array();
        if($json!==false)
        {
            $option=$json;
        }
        $option=array_merge($option,$restore_task['option']);

        if(isset($option['dump_db']))
        {
            $restore_site = new WPvivid_RestoreSite();
            $wpvivid_pulgin->restore_data->write_log('Start restoring '.$restore_task['files'][0],'notice');
            $ret= $restore_site -> restore($option,$restore_task['files']);
            if($ret['result']==WPVIVID_SUCCESS)
            {
                $path = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir().DIRECTORY_SEPARATOR.WPVIVID_DEFAULT_ROLLBACK_DIR.DIRECTORY_SEPARATOR.'wpvivid_old_database'.DIRECTORY_SEPARATOR;
                $sql_file = $backup_item->get_sql_file($restore_task['files'][0]);
                $wpvivid_pulgin->restore_data->write_log('sql file: '.$sql_file,'notice');
                $restore_db=new WPvivid_RestoreDB();
                $restore_db->restore($path,$sql_file,$option);
                $wpvivid_pulgin->restore_data->write_log('Finished restoring '.$restore_task['files'][0],'notice');
                $wpvivid_pulgin->restore_data->update_need_unzip_file($restore_task['index'],$restore_task['files']);
                return array('result'=>WPVIVID_SUCCESS);
            }
            else
            {
                return $ret;
            }
        }
        else
        {
            $restore_site = new WPvivid_RestoreSite();

            $files=$wpvivid_pulgin->restore_data->get_need_unzip_file($restore_task);
            $wpvivid_pulgin->restore_data->write_log('Start restoring '.$files[0],'notice');
            $ret= $restore_site -> restore($option,$files);
            $wpvivid_pulgin->restore_data->update_need_unzip_file($restore_task['index'],$files);
            $wpvivid_pulgin->restore_data->write_log('Finished restoring '.$files[0],'notice');
            return $ret;
        }
    }

    private function transfer_path($path)
    {
        $path = str_replace('\\','/',$path);
        $values = explode('/',$path);
        return implode(DIRECTORY_SEPARATOR,$values);
    }
}