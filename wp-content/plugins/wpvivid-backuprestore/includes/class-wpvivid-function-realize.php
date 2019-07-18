<?php

class WPvivid_Function_Realize
{
    public function __construct()
    {

    }

    public function _backup_cancel($task_id)
    {
        global $wpvivid_pulgin;
        if (WPvivid_taskmanager::get_task($task_id) !== false) {
            $file_name = WPvivid_taskmanager::get_task_options($task_id, 'file_prefix');
            $backup_options = WPvivid_taskmanager::get_task_options($task_id, 'backup_options');
            $file = WP_CONTENT_DIR . DIRECTORY_SEPARATOR . $backup_options['dir'] . DIRECTORY_SEPARATOR . $file_name . '_cancel';
            touch($file);
        }

        $timestamp = wp_next_scheduled(WPVIVID_TASK_MONITOR_EVENT, array($task_id));

        if ($timestamp === false) {
            $wpvivid_pulgin->add_monitor_event($task_id, 10);
        }
        $ret['result'] = 'success';
        $ret['msg'] = __('The backup will be canceled after backing up the current chunk ends.', 'wpvivid');
        return $ret;
    }

    public function _get_log_file($read_type, $param){
        global $wpvivid_pulgin;
        $ret['result']='failed';
        if($read_type == 'backuplist'){
            $backup_id = $param;
            $backup = WPvivid_Backuplist::get_backuplist_by_key($backup_id);
            if(!$backup) {
                $ret['result']='failed';
                $ret['error']=__('Retrieving the backup information failed while showing log. Please try again later.', 'wpvivid');
                return $ret;
            }
            if(!file_exists($backup['log'])) {
                $ret['result']='failed';
                $ret['error']=__('The log not found.', 'wpvivid');
                return $ret;
            }
            $ret['result']='success';
            $ret['log_file']=$backup['log'];
        }
        else if($read_type == 'lastlog'){
            $option = $param;
            $log_file_name= $wpvivid_pulgin->wpvivid_log->GetSaveLogFolder().$option.'_log.txt';
            if(!file_exists($log_file_name))
            {
                $information['result']='failed';
                $information['error']=__('The log not found.', 'wpvivid');
                return $information;
            }
            $ret['result']='success';
            $ret['log_file']=$log_file_name;
        }
        else if($read_type == 'tasklog'){
            $backup_task_id = $param;
            $option=WPvivid_taskmanager::get_task_options($backup_task_id,'log_file_name');
            if(!$option) {
                $information['result']='failed';
                $information['error']=__('Retrieving the backup information failed while showing log. Please try again later.', 'wpvivid');
                return $information;
            }
            $log_file_name= $wpvivid_pulgin->wpvivid_log->GetSaveLogFolder().$option.'_log.txt';
            if(!file_exists($log_file_name)) {
                $information['result']='failed';
                $information['error']=__('The log not found.', 'wpvivid');
                return $information;
            }
            $ret['result']='success';
            $ret['log_file']=$log_file_name;
        }
        return $ret;
    }

    public function _set_remote($remote){
        WPvivid_Setting::update_option('wpvivid_upload_setting',$remote['upload']);
        $history=WPvivid_Setting::get_option('wpvivid_user_history');
        $history['remote_selected']=$remote['history']['remote_selected'];
        WPvivid_Setting::update_option('wpvivid_user_history',$history);
    }

    public function _get_default_remote_storage(){
        $remote_storage_type = '';
        $remoteslist=WPvivid_Setting::get_all_remote_options();
        $default_remote_storage='';
        foreach ($remoteslist['remote_selected'] as $value) {
            $default_remote_storage=$value;
        }
        foreach ($remoteslist as $key=>$value)
        {
            if($key === $default_remote_storage)
            {
                $remote_storage_type=$value['type'];
            }
        }
        return $remote_storage_type;
    }
}