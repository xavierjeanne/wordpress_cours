<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
if(!defined('WPVIVID_COMPRESS_ZIPCLASS')){
    define('WPVIVID_COMPRESS_ZIPCLASS','zipclass');
}

define('WPVIVID_ZIPCLASS_JSONFILE_NAME','wpvivid_zipclass.json');
require_once WPVIVID_PLUGIN_DIR . '/includes/class-wpvivid-compress-default.php';
class WPvivid_ZipClass extends Wpvivid_Compress_Default
{
	public $last_error = '';
	public $path_filter=array();

	public function __construct() {
		if (!class_exists('PclZip')) include_once(ABSPATH.'/wp-admin/includes/class-pclzip.php');
		if (!class_exists('PclZip')) {
			$this->last_error = array('result'=>WPVIVID_FAILED,'error'=>"Class PclZip is not detected. Please update or reinstall your WordPress.");
		}
	}

	public function get_packages($data)
    {
        if(!function_exists('get_home_path'))
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        $files = $this -> filesplit($data['compress']['max_file_size'],$data['files']);

        $temp_dir = $data['path'].'temp-'.$data['prefix'].DIRECTORY_SEPARATOR;
        if(!file_exists($temp_dir))
            @mkdir($temp_dir);
        $packages = array();
        if(sizeof($files) > 1)
        {
            for($i =0;$i <sizeof($files);$i ++)
            {
                $package = array();
                $path = $data['path'].$data['prefix'].'.part'.sprintf('%03d',($i +1)).'.zip';

                $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

                if(isset($data['json_info']))
                {
                    $package['json']=$data['json_info'];
                }

                $package['json']['root'] = substr($data['root_path'], $remove_path_size);
                $package['json']['file']=basename($path);
                $package['path'] = $path;
                $package['files'] = $files[$i];
                $packages[] = $package;
            }
        }else {
            $package = array();
            $path = $data['path'].$data['prefix'].'.zip';

            $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

            if(isset($data['json_info']))
            {
                $package['json']=$data['json_info'];
            }

            $package['json']['root'] = substr($data['root_path'], $remove_path_size);
            $package['json']['file']=basename($path);
            $package['path'] = $path;
            $package['files'] = $files[0];
            $packages[] = $package;
        }

        $ret['packages']=$packages;
        $ret['temp_dir']=$temp_dir;
        return $ret;
    }

    public function get_plugin_packages($data)
    {
        if(!function_exists('get_home_path'))
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        $files = $this -> filesplit_plugin(3000,$data['files']);

        $temp_dir = $data['path'].'temp-'.$data['prefix'].DIRECTORY_SEPARATOR;
        if(!file_exists($temp_dir))
            @mkdir($temp_dir);
        $packages = array();

        if(sizeof($files) > 1)
        {
            for($i =0;$i <sizeof($files);$i ++)
            {
                $package = array();
                $path = $data['path'].$data['prefix'].'.part'.sprintf('%03d',($i +1)).'.zip';

                $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

                if(isset($data['json_info']))
                {
                    $package['json']=$data['json_info'];
                }

                $package['json']['root'] = substr($data['root_path'], $remove_path_size);
                $package['json']['file']=basename($path);
                $package['path'] = $path;
                $package['files'] = $files[$i];
                $packages[] = $package;
            }
        }else {
            $package = array();
            $path = $data['path'].$data['prefix'].'.zip';

            $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

            if(isset($data['json_info']))
            {
                $package['json']=$data['json_info'];
            }

            $package['json']['root'] = substr($data['root_path'], $remove_path_size);
            $package['json']['file']=basename($path);
            $package['path'] = $path;
            $package['files'] = $files[0];
            $packages[] = $package;
        }

        $ret['packages']=$packages;
        $ret['temp_dir']=$temp_dir;
        return $ret;
    }

    public function get_upload_packages($data)
    {
        if(!function_exists('get_home_path'))
            require_once(ABSPATH . 'wp-admin/includes/file.php');

        $max_size= $data['compress']['max_file_size'];
        $max_size = str_replace('M', '', $max_size);
        $size = intval($max_size) * 1024 * 1024;

        $files = $this -> filesplit_plugin($size,$data['files'],0);

        $temp_dir = $data['path'].'temp-'.$data['prefix'].DIRECTORY_SEPARATOR;
        if(!file_exists($temp_dir))
            @mkdir($temp_dir);
        $packages = array();

        if(sizeof($files) > 1)
        {
            for($i =0;$i <sizeof($files);$i ++)
            {
                $package = array();
                $path = $data['path'].$data['prefix'].'.part'.sprintf('%03d',($i +1)).'.zip';

                $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

                if(isset($data['json_info']))
                {
                    $package['json']=$data['json_info'];
                }

                $package['json']['root'] = substr($data['root_path'], $remove_path_size);
                $package['json']['file']=basename($path);
                $package['path'] = $path;
                $package['files'] = $files[$i];
                $packages[] = $package;
            }
        }else {
            $package = array();
            $path = $data['path'].$data['prefix'].'.zip';

            $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

            if(isset($data['json_info']))
            {
                $package['json']=$data['json_info'];
            }

            $package['json']['root'] = substr($data['root_path'], $remove_path_size);
            $package['json']['file']=basename($path);
            $package['path'] = $path;
            $package['files'] = $files[0];
            $packages[] = $package;
        }

        $ret['packages']=$packages;
        $ret['temp_dir']=$temp_dir;
        return $ret;
    }

	public function compress($data)
    {
        if(!function_exists('get_home_path'))
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        global $wpvivid_pulgin;
        $wpvivid_pulgin->wpvivid_log->WriteLog('Start compressing '.$data['key'],'notice');
	    $files = $this -> filesplit($data['compress']['max_file_size'],$data['files']);

        $temp_dir = $data['path'].'temp-'.$data['prefix'].DIRECTORY_SEPARATOR;
        if(!file_exists($temp_dir))
            @mkdir($temp_dir);
        $packages = array();
	    if(sizeof($files) > 1)
	    {
            for($i =0;$i <sizeof($files);$i ++)
            {
                $package = array();
                $path = $data['path'].$data['prefix'].'.part'.sprintf('%03d',($i +1)).'.zip';

                $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

                if(isset($data['json_info']))
                {
                    $package['json']=$data['json_info'];
                }

                $package['json']['root'] = substr($data['root_path'], $remove_path_size);
                $package['json']['file']=basename($path);
                $package['path'] = $path;
                $package['files'] = $files[$i];
                $packages[] = $package;
            }
        }else {
	        $package = array();
            $path = $data['path'].$data['prefix'].'.zip';

            $remove_path_size = strlen( $this -> transfer_path(get_home_path()));

            if(isset($data['json_info']))
            {
                $package['json']=$data['json_info'];
            }

            $package['json']['root'] = substr($data['root_path'], $remove_path_size);
            $package['json']['file']=basename($path);
            $package['path'] = $path;
            $package['files'] = $files[0];
            $packages[] = $package;
        }

        $ret['result']=WPVIVID_SUCCESS;
        $ret['files']=array();

        foreach ($packages as $package)
        {
            if(!empty($package['files']))
            {
                $zip_ret=$this -> _zip($package['path'],$package['files'], $data,$package['json']);
                if($zip_ret['result']==WPVIVID_SUCCESS)
                {
                    $ret['files'][] = $zip_ret['file_data'];
                }
                else
                {
                    $ret=$zip_ret;
                    break;
                }
            }else {
                continue;
            }
        }
        $wpvivid_pulgin->wpvivid_log->WriteLog('Compressing '.$data['key'].' completed','notice');
        return $ret;
    }

    public function extract($files,$path = '')
    {
        global $wpvivid_pulgin;
        //$wpvivid_pulgin->restore_data->write_log('start prepare extract','notice');
        define(PCLZIP_TEMPORARY_DIR,dirname($path));

        $ret['result']=WPVIVID_SUCCESS;
        foreach ($files as $file)
        {
            $wpvivid_pulgin->restore_data->write_log('start extract file:'.$file,'notice');
            $archive = new PclZip($file);
            $zip_ret = $archive->extract(PCLZIP_OPT_PATH, $path,PCLZIP_OPT_REPLACE_NEWER,PCLZIP_CB_PRE_EXTRACT,'wpvivid_function_pre_extract_callback',PCLZIP_OPT_TEMP_FILE_THRESHOLD,16);
            if(!$zip_ret)
            {
                $ret['result']=WPVIVID_FAILED;
                $ret['error'] = $archive->errorInfo(true);
                $wpvivid_pulgin->restore_data->write_log('extract finished:'.json_encode($ret),'notice');
                break;
            }
            else
            {
                $wpvivid_pulgin->restore_data->write_log('extract finished file:'.$file,'notice');
            }
        }
        //$this->restore_data->write_log('extract finished files:'.json_encode($all_files),'notice');

        return $ret;
    }

    public function extract_by_files($files,$zip,$path = ''){
        define(PCLZIP_TEMPORARY_DIR,$path);
        $flag = true;
        $table = array();
        $archive = new PclZip($zip);
        $list = $archive -> listContent();
        foreach ($list as $item){
            if(strstr($item['filename'],WPVIVID_ZIPCLASS_JSONFILE_NAME)){
                $result = $archive->extract(PCLZIP_OPT_BY_NAME, WPVIVID_ZIPCLASS_JSONFILE_NAME);
                if($result){
                    $json = json_decode(file_get_contents(dirname($zip).WPVIVID_ZIPCLASS_JSONFILE_NAME),true);
                    $path = $json['root_path'];
                }
            }
        }

        $str = $archive->extract(PCLZIP_OPT_PATH, $path, PCLZIP_OPT_BY_NAME, $files, PCLZIP_OPT_REPLACE_NEWER,PCLZIP_OPT_TEMP_FILE_THRESHOLD,16);
        if(!$str){
            $flag = false;
            $error = $archive->errorInfo(true);
        }else{
            $success_num = 0;
            $error_num = 0;
            $last_error = '';
            foreach ($str as $item){
                if($item['status'] === 'ok'){
                    $success_num ++;
                }else{
                    $error_num ++;
                    $last_error = 'restore '.$item['filename'].' failed status:'.$item['status'];
                }
            }
            $table['succeed'] = $success_num;
            $table['failed'] = $error_num;
            $error = $last_error;
        }

        if($flag){
            return array('result'=>WPVIVID_SUCCESS,'table'=>$table,'error' => $error);
        }else{
            return array('result'=>'failed','error'=>$error);
        }
    }

    public function get_include_zip($files,$allpackages){
        $i = sizeof($files);
        $zips = array();
        foreach ( $allpackages as $item){
            $archive = new PclZip($item);
            $lists = $archive -> listContent();
            foreach ($lists as $file){
                if($this -> _in_array($file['filename'],$files)){
                    $zips[$item][] = $file['filename'];
                    if($i -- === 0)
                        break 2;
                }
            }
        }
        return $zips;
    }

    public function _zip($name,$files,$options,$json_info=false)
    {
        global $wpvivid_pulgin;

        if(file_exists($name))
            @unlink($name);
        $archive = new PclZip($name);

        if(isset($options['compress']['no_compress']))
        {
            $no_compress=$options['compress']['no_compress'];
        }
        else
        {
            $no_compress=1;
        }

        if(isset($options['compress']['use_temp_file']))
        {
            $use_temp_file=1;
        }
        else
        {
            $use_temp_file=0;
        }

        if(isset($options['compress']['use_temp_size']))
        {
            $use_temp_size=$options['compress']['use_temp_size'];
        }
        else
        {
            $use_temp_size=16;
        }

        if(isset($options['root_path']))
        {
            $replace_path=$options['root_path'];
        }
        else
        {
            $replace_path=WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir();
        }

        if($json_info!==false)
        {
            $temp_path = dirname($name).DIRECTORY_SEPARATOR.'wpvivid_package_info.json';
            if(file_exists($temp_path))
            {
                @unlink($temp_path);
            }
            file_put_contents($temp_path,print_r(json_encode($json_info),true));
            $archive -> add($temp_path,PCLZIP_OPT_REMOVE_PATH,dirname($temp_path));
            @unlink($temp_path);
        }

        $wpvivid_pulgin->wpvivid_log->WriteLog('Prepare to zip files. file: '.basename($name),'notice');

        if($no_compress)
        {
            if($use_temp_file==1)
            {
                if($use_temp_size!=0)
                {
                    $ret = $archive -> add($files,PCLZIP_OPT_REMOVE_PATH,$replace_path,PCLZIP_CB_PRE_ADD,'wpvivid_function_per_add_callback',PCLZIP_OPT_NO_COMPRESSION,PCLZIP_OPT_TEMP_FILE_THRESHOLD,$use_temp_size);
                }
                else
                {
                    $ret = $archive -> add($files,PCLZIP_OPT_REMOVE_PATH,$replace_path,PCLZIP_CB_PRE_ADD,'wpvivid_function_per_add_callback',PCLZIP_OPT_NO_COMPRESSION,PCLZIP_OPT_TEMP_FILE_ON);
                }
            }
            else
            {
                $ret = $archive -> add($files,PCLZIP_OPT_REMOVE_PATH,$replace_path,PCLZIP_CB_PRE_ADD,'wpvivid_function_per_add_callback',PCLZIP_OPT_NO_COMPRESSION,PCLZIP_OPT_TEMP_FILE_OFF);
            }
        }
        else
        {
            if($use_temp_file==1)
            {
                if($use_temp_size!=0)
                {
                    $ret = $archive -> add($files,PCLZIP_OPT_REMOVE_PATH,$replace_path,PCLZIP_CB_PRE_ADD,'wpvivid_function_per_add_callback',PCLZIP_OPT_TEMP_FILE_THRESHOLD,$use_temp_size);
                }
                else
                {
                    $ret = $archive -> add($files,PCLZIP_OPT_REMOVE_PATH,$replace_path,PCLZIP_CB_PRE_ADD,'wpvivid_function_per_add_callback',PCLZIP_OPT_TEMP_FILE_ON);
                }
            }
            else
            {
                $ret = $archive -> add($files,PCLZIP_OPT_REMOVE_PATH,$replace_path,PCLZIP_CB_PRE_ADD,'wpvivid_function_per_add_callback',PCLZIP_OPT_TEMP_FILE_OFF);
            }
        }

        if(!$ret)
        {
            $wpvivid_pulgin->wpvivid_log->WriteLog('Failed to add zip files, error: '.$archive->errorInfo(true),'notice');
            return array('result'=>WPVIVID_FAILED,'error'=>$archive->errorInfo(true));
        }

        $wpvivid_pulgin->wpvivid_log->WriteLog('Adding zip files completed.'.basename($name).', filesize: '.size_format(filesize($name),2),'notice');
        $file_data = array();
        $file_data['file_name'] = basename($name);
        $file_data['size'] = filesize($name);

        return array('result'=>WPVIVID_SUCCESS,'file_data'=>$file_data);
    }

    public function listcontent($path){
        $zip = new PclZip($path);
        $list = $zip->listContent();
        return $list;
    }
    public function listnum($path , $includeFolder = false){
        $zip = new PclZip($path);
        $list = $zip->listContent();
        $index = 0;
        foreach ($list as $item){
            if(!$includeFolder && $item['folder'])
                continue;
            $index ++;
        }
        return $index;
    }

    private function transfer_path($path)
    {
        $path = str_replace('\\','/',$path);
        $values = explode('/',$path);
        return implode(DIRECTORY_SEPARATOR,$values);
    }

    public function get_json_data($path)
    {
        $archive = new PclZip($path);
        $list = $archive->listContent();
        if($list == false){
            return array('result'=>WPVIVID_FAILED,'error'=>$archive->errorInfo(true));
        }
        else {
            $b_exist = false;
            foreach ($list as $item) {
                if (basename($item['filename']) === 'wpvivid_package_info.json') {
                    $b_exist = true;
                    $result = $archive->extract(PCLZIP_OPT_BY_NAME, 'wpvivid_package_info.json', PCLZIP_OPT_EXTRACT_AS_STRING);
                    if ($result != 0) {
                        return array('result'=>WPVIVID_SUCCESS,'json_data'=>$result[0]['content']);
                    } else {
                        return array('result'=>WPVIVID_FAILED,'error'=>$archive->errorInfo(true));
                    }
                }
            }
            if(!$b_exist){
                return array('result'=>WPVIVID_FAILED,'error'=>'Failed to get json, this may be a old version backup.');
            }
        }
        return array('result'=>WPVIVID_FAILED,'error'=>'Unknown error');
    }

    public function list_file($path)
    {
        $archive = new PclZip($path);
        $list = $archive->listContent();

        $files=array();
        foreach ($list as $item)
        {
            if(basename($item['filename'])==='wpvivid_package_info.json')
            {
                continue;
            }
            $file['file_name']=$item['filename'];
            $files[]=$file;
        }

        return $files;
    }

    public function filesplit_plugin($max_file_size,$files,$is_num=true)
    {
        $packages=array();
        if($max_file_size == 0 || empty($max_file_size))
        {
            $packages[] = $files;
        }else{
            $folder_num_sum = 0;
            $package = array();

            foreach ($files as $file)
            {
                $folder_num=0;
                if(is_dir($file))
                {
                    if($is_num)
                    {
                        $folder_num=$this->get_folder_file_count($file);
                    }
                    else
                    {
                        $folder_num=$this->get_folder_file_size($file);
                    }
                }
                else
                {
                    $folder_num_sum+=filesize($file);
                }

                if($folder_num > $max_file_size)
                {
                    $temp_package[] = $file;
                    $packages[] = $temp_package;
                    $temp_package = array();
                    continue;
                }
                else
                {
                    $folder_num_sum+=$folder_num;
                }

                if($folder_num_sum > $max_file_size)
                {
                    $package[] = $file;
                    $packages[] = $package;
                    $package = array();
                    $folder_num_sum=0;
                }
                else{
                    $package[] = $file;
                 }

            }
            if(!empty($package))
                $packages[] = $package;
        }
        return $packages;
    }

    public function get_folder_file_count($file)
    {
        $count=0;
        $this->get_folder_file_count_loop($file,$count);

        return $count;
    }

    function get_folder_file_count_loop($path,&$count)
    {
        $handler = opendir($path);

        while (($filename = readdir($handler)) !== false)
        {
            if ($filename != "." && $filename != "..")
            {
                $count++;

                if(is_dir($path . DIRECTORY_SEPARATOR . $filename))
                {
                    $this->get_folder_file_count_loop($path . DIRECTORY_SEPARATOR . $filename,$count);
                }
            }
        }
        if($handler)
            @closedir($handler);
    }

    function get_folder_file_size($file)
    {
        $count=0;
        $this->get_folder_file_size_loop($file,$count);

        return $count;
    }

    function get_folder_file_size_loop($path,&$count)
    {
        $handler = opendir($path);

        while (($filename = readdir($handler)) !== false)
        {
            if ($filename != "." && $filename != "..")
            {
                if(is_dir($path . DIRECTORY_SEPARATOR . $filename))
                {
                    $this->get_folder_file_size_loop($path . DIRECTORY_SEPARATOR . $filename,$count);
                }
                else
                {
                    $count+=filesize($path . DIRECTORY_SEPARATOR . $filename);
                }
            }
        }
        if($handler)
            @closedir($handler);
    }
}

$wpvivid_old_time=0;

function wpvivid_function_per_add_callback($p_event, &$p_header)
{
    global $wpvivid_old_time;
    if(time()-$wpvivid_old_time>30)
    {
        $wpvivid_old_time=time();
        global $wpvivid_pulgin;
        $wpvivid_pulgin->check_cancel_backup($wpvivid_pulgin->current_task['id']);
        WPvivid_taskmanager::update_backup_task_status($wpvivid_pulgin->current_task['id']);
    }

    return 1;
}

function wpvivid_function_pre_extract_callback($p_event, &$p_header)
{
    $plugins = substr(WP_PLUGIN_DIR, strpos(WP_PLUGIN_DIR, 'wp-content/'));

    if(strpos($p_header['filename'],$plugins.DIRECTORY_SEPARATOR.'wpvivid-backuprestore')!==false)
    {
        return 0;
    }

    if(strpos($p_header['filename'],'wp-config.php')!==false)
    {
        return 0;
    }

    if(strpos($p_header['filename'],'wpvivid_package_info.json')!==false)
    {
        return 0;
    }

    return 1;
}