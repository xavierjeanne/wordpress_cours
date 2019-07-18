<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
//include_once plugin_dir_path( __FILE__ ) .'class-wpvivid-tools.php';
//include_once plugin_dir_path( __FILE__ ) .'phpseclib/Net/SCP.php';

class WPvivid_downloader
{
    private $task;

    public function ready_download($download_info)
    {
        $files=array();
        $backup=WPvivid_Backuplist::get_backuplist_by_key($download_info['backup_id']);
        if(!$backup)
        {
            return false;
        }
        $download_option='';
        if(isset($backup['backup']['files']))
        {
            foreach ($backup['backup']['files'] as $file)
            {
                if ($file['file_name'] == $download_info['file_name'])
                {
                    $download_option = 'all';
                    $files[] = $file;
                    break;
                }
            }
        }
        else if ($backup['backup']['ismerge'] == 1) {
            $backup_files = $backup['backup']['data']['meta']['files'];
            foreach ($backup_files as $file) {
                if ($file['file_name'] == $download_info['file_name']) {
                    $download_option = 'all';
                    $files[] = $file;
                    break;
                }
            }
        } else {
            foreach ($backup['backup']['data']['type'] as $type) {
                $backup_files = $type['files'];
                foreach ($backup_files as $file) {
                    if ($file['file_name'] == $download_info['file_name']) {
                        $download_option = $type['type_name'];
                        $files[] = $file;
                        break;
                    }
                }
            }
        }

        if(empty($files))
        {
            return false;
        }


        $local_path=WP_CONTENT_DIR.DIRECTORY_SEPARATOR.$backup['local']['path'].DIRECTORY_SEPARATOR;
        $need_download_files=array();
        foreach ($files as $file)
        {
            $local_file=$local_path.$file['file_name'];
            if(file_exists($local_file))
            {
                if(filesize($local_file)==$file['size'])
                {
                    $new_md5=md5_file($local_file);
                    if($file['md5']!=$new_md5)
                    {
                        $need_download_files[$file['file_name']]=$file;
                        unlink($local_file);
                    }
                }
                else
                {
                    if(filesize($local_file)>$file['size'])
                    {
                        unlink($local_file);
                    }
                    $need_download_files[$file['file_name']]=$file;
                }
            }
            else
            {
                $need_download_files[$file['file_name']]=$file;
            }
        }

        if(empty($need_download_files))
        {
            delete_option('wpvivid_download_cache');
        }
        else
        {
            if(WPvivid_taskmanager::is_download_task_running_v2($download_info['file_name']))
            {
                global $wpvivid_pulgin;
                $wpvivid_pulgin->wpvivid_log->WriteLog('has a downloading task,exit download.','test');
                return false;
            }
            else
            {
                //$task=WPvivid_taskmanager::new_download_task($download_info['backup_id'],$download_option,$need_download_files);
                foreach ($need_download_files as $file){
                    $filename=$file['file_name'];
                }
                $task=WPvivid_taskmanager::new_download_task_v2($filename);
            }
        }

        foreach ($need_download_files as $file)
        {
            $ret=$this->download_ex($task,$backup['remote'],$file,$local_path);
            if($ret['result']==WPVIVID_FAILED)
            {
                return false;
            }
        }

        return true;
    }

    public function download_ex(&$task,$remotes,$file,$local_path)
    {
        $this->task=$task;

        $remote_option=array_shift($remotes);

        if(is_null($remote_option))
        {
            return array('result' => WPVIVID_FAILED ,'error'=>'Retrieving the cloud storage information failed while downloading backups. Please try again later.');
        }

        global $wpvivid_pulgin;

        $remote=$wpvivid_pulgin->remote_collection->get_remote($remote_option);

        $ret=$remote->download($file,$local_path,array($this,'download_callback_v2'));

        if($ret['result']==WPVIVID_SUCCESS)
        {
            $progress=100;
            $wpvivid_pulgin->wpvivid_download_log->WriteLog('Download completed.', 'notice');
            WPvivid_taskmanager::update_download_task_v2( $task,$progress,'completed');
            return $ret;
        }
        else
        {
            $progress=0;
            $message=$ret['error'];
            if($wpvivid_pulgin->wpvivid_download_log){
                $wpvivid_pulgin->wpvivid_download_log->WriteLog('Download failed, ' . $message ,'error');
                WPvivid_error_log::create_error_log($wpvivid_pulgin->wpvivid_download_log->log_file);
                $wpvivid_pulgin->wpvivid_download_log->CloseFile();
            }
            else {
                $id = uniqid('wpvivid-');
                $log_file_name = $id . '_download';
                $log = new WPvivid_Log();
                $log->CreateLogFile($log_file_name, 'no_folder', 'download');
                $log->WriteLog($message, 'notice');
                WPvivid_error_log::create_error_log($log->log_file);
                $log->CloseFile();
            }
            WPvivid_taskmanager::update_download_task_v2($task,$progress,'error',$message);
            return $ret;
        }
    }

    public function download_callback_v2($offset,$current_name,$current_size,$last_time,$last_size)
    {
        global $wpvivid_pulgin;
        $progress= floor(($offset/$current_size)* 100) ;
        $text='Total size:'.size_format($current_size,2).' downloaded:'.size_format($offset,2);
        $this->task['download_descript']=$text;
        $wpvivid_pulgin->wpvivid_download_log->WriteLog('Total Size: '.$current_size.', Downloaded Size: '.$offset ,'notice');
        WPvivid_taskmanager::update_download_task_v2( $this->task,$progress,'running');
    }

    public static function delete($remote , $files)
    {
        global $wpvivid_pulgin;

        set_time_limit(60);

        $remote=$wpvivid_pulgin->remote_collection->get_remote($remote);

        $result =$remote->cleanup($files);

        return $result;
    }
}