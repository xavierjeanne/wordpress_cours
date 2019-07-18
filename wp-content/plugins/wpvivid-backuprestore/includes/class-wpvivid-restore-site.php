<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-zipclass.php';
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-backup.php';
include_once plugin_dir_path( dirname( __FILE__ ) ) .'includes/class-wpvivid-rollback.php';
class WPvivid_RestoreSite
{

    public function restore($option,$files)
    {
        global $wpvivid_pulgin;

        if(isset($option['has_child']))
        {
            $root_path=WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir();

            if(!file_exists($root_path))
            {
                @mkdir($root_path);
            }
            $wpvivid_pulgin->restore_data->write_log('extract root:'.$root_path,'notice');
            $zip = new WPvivid_ZipClass();
            $all_files = array();
            foreach ($files as $file)
            {
                $all_files[] =WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir().DIRECTORY_SEPARATOR.$file;
            }

            return $zip -> extract($all_files,$root_path);
        }
        else if(isset($option['dump_db']))
        {
            $path = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir().DIRECTORY_SEPARATOR.WPVIVID_DEFAULT_ROLLBACK_DIR.DIRECTORY_SEPARATOR.'wpvivid_old_database';
            if(file_exists($path))
            {
                @mkdir($path);
            }

            $zip = new WPvivid_ZipClass();
            $all_files = array();
            foreach ($files as $file)
            {
                $all_files[] = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir().DIRECTORY_SEPARATOR.$file;
            }

            $ret= $zip -> extract($all_files,$path);

            unset($zip);

            return $ret;
        }
        else
        {
            $root_path=$this->transfer_path(get_home_path().$option['root']);

            $root_path = rtrim($root_path, '/');
            $root_path = rtrim($root_path, DIRECTORY_SEPARATOR);

            $old_path=WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir().DIRECTORY_SEPARATOR.WPVIVID_DEFAULT_ROLLBACK_DIR.DIRECTORY_SEPARATOR.'wpvivid_old_site'.DIRECTORY_SEPARATOR.$option['root'];

            $exclude_path[]=$this->transfer_path(WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir());

            if(isset($option['include_path']))
            {
                $include_path=$option['include_path'];
            }
            else
            {
                $include_path=array();
            }

            if(!isset($option['skip_backup_old_site']))
            {
                $wpvivid_pulgin->restore_data->write_log('backup old file site','notice');
                $this->pre_restore($root_path,$old_path,$include_path,$exclude_path);
            }


            $zip = new WPvivid_ZipClass();
            $all_files = array();
            foreach ($files as $file)
            {
                $all_files[] = WP_CONTENT_DIR.DIRECTORY_SEPARATOR.WPvivid_Setting::get_backupdir().DIRECTORY_SEPARATOR.$file;
            }

            $wpvivid_pulgin->restore_data->write_log('restore from files:'.json_encode($all_files),'notice');

            $ret= $zip->extract($all_files,$root_path);

            unset($zip);

            if(isset($option['wp_core'])&&isset($option['is_migrate']))
            {
                if($option['is_migrate'] == 1) {
                    @rename(get_home_path() . '.htaccess', get_home_path() . '.htaccess_old');
                    if (function_exists('save_mod_rewrite_rules')) {
                        save_mod_rewrite_rules();
                    }
                    WPvivid_Setting::update_option('wpvivid_migrate_status', 'completed');
                }
            }
            return $ret;
        }
    }

    public function pre_restore($path,$save_old_path,$include_path,$exclude_path)
    {
        if(!file_exists($save_old_path))
            @mkdir($save_old_path);
        return $this->copy_old_files($path,$save_old_path,$path,$include_path,$exclude_path);
    }

    private function copy_old_files($path,$save_old_path,$root_path,$include_path,$exclude_path)
    {
        $result = array('result'=>WPVIVID_SUCCESS);

        $handler=opendir($path);
        while(($filename=readdir($handler))!==false)
        {
            if($filename != "." && $filename != "..")
            {
                $new_dir=$save_old_path.str_replace($root_path,'',$path.DIRECTORY_SEPARATOR.$filename);
                if(is_dir($path.DIRECTORY_SEPARATOR.$filename))
                {
                    if(!empty($include_path))
                    {
                        if( $this->has_include_dir($path.DIRECTORY_SEPARATOR.$filename,$include_path,$root_path))
                        {
                            if(!file_exists($new_dir))
                                @mkdir($new_dir);
                            $this->copy_old_files($path.DIRECTORY_SEPARATOR.$filename,$save_old_path,$root_path,$include_path,$exclude_path);
                        }
                        else
                        {
                            continue;
                        }
                    }

                    if(!empty($exclude_path))
                    {
                        $check_path=$this->transfer_path($path.DIRECTORY_SEPARATOR.$filename);
                        if(in_array($check_path,$exclude_path))
                        {
                            continue;
                        }
                    }

                    if(!file_exists($new_dir))
                        @mkdir($new_dir);
                    $this->copy_old_files($path.DIRECTORY_SEPARATOR.$filename,$save_old_path,$root_path,$include_path,$exclude_path);
                }else {
                    if(!file_exists($new_dir))
                    {
                        @copy($path.DIRECTORY_SEPARATOR.$filename,$new_dir);
                    }
                }
            }
        }
        if($handler)
            @closedir($handler);
        return $result;
    }

    private function transfer_path($path)
    {
        $path = str_replace('\\','/',$path);
        $values = explode('/',$path);
        return implode(DIRECTORY_SEPARATOR,$values);
    }

    private function has_include_dir($path,$include_path,$root)
    {
        $path=$this->transfer_path($path);
        foreach ($include_path as $needed_path)
        {
            $needed_path=$this->transfer_path($root.DIRECTORY_SEPARATOR.$needed_path);
            if(strpos($path,$needed_path)!==false)
            {
                return true;
            }
        }
        return false;
    }

    private function _restore($restorePath,$path , $files){
        $zip = new WPvivid_ZipClass();
        $allfiles = array();
        foreach ($files as $file){
            $allfiles[] = $path.DIRECTORY_SEPARATOR.$file['file_name'];
        }
        return $zip -> zipextract($restorePath , $allfiles);
    }

    public function restore_copy($data){
        $src_path = $data['data']['src'];
        $dst_path = $data['data']['dst'];
        $replace_path = $data['data']['replace'];
        return $this -> _restore_copy_loop($src_path,$dst_path,$replace_path);
    }
    private function _restore_copy_loop($path,$temp_path,$replace_path){
        $result = array('result'=>WPVIVID_SUCCESS);
        if(empty($path)) {
            return array('result'=>'failed','error'=>'The old folder not found. It may be deleted, renamed, or moved. Please verify the folder exists.');
        }
        $handler=opendir($path);
        while(($filename=readdir($handler))!==false)
        {
            if($filename != "." && $filename != "..")
            {
                if(is_dir($path.DIRECTORY_SEPARATOR.$filename))
                {
                    @mkdir(str_replace($replace_path,$temp_path,$path.DIRECTORY_SEPARATOR.$filename));
                    $result = $this->_restore_copy_loop($path.DIRECTORY_SEPARATOR.$filename,$temp_path,$replace_path);
                    if($result['result'] != WPVIVID_SUCCESS)
                        break;
                }else{
                    if(file_exists($path.DIRECTORY_SEPARATOR.$filename))
                    {
                        if(!copy($path.DIRECTORY_SEPARATOR.$filename,str_replace($replace_path,$temp_path,$path.DIRECTORY_SEPARATOR.$filename))){
                            $result = array('result'=>'failed','error'=>'Copying '.$path.DIRECTORY_SEPARATOR.$filename.' into '.$temp_path.DIRECTORY_SEPARATOR.$filename.' failed. The file may be occupied, or the folder may not be granted a permission to write. Please try again.');
                            break;
                        }
                    }
                }
            }
        }
        if($handler)
            @closedir($handler);
        return $result;
    }
}