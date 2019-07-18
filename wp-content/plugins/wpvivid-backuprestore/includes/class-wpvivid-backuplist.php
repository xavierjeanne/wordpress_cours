<?php

if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
class WPvivid_Backuplist
{
    public static function get_backuplist()
    {
        $list =  WPvivid_Setting::get_option('wpvivid_backup_list');

        $list =self::sort_list($list);

        return $list;
    }

    public static function get_transferlist()
    {
        $list =  WPvivid_Setting::get_option('wpvivid_transfer_list');

        $list =self::sort_list($list);

        return $list;
    }

    public static function get_backuplist_by_key($key)
    {
        $list = self::get_backuplist();
        foreach ($list as $k=>$backup)
        {
            if ($key == $k)
            {
                return $backup;
            }
        }
        $list = self::get_transferlist();
        foreach ($list as $k=>$backup)
        {
            if($key == $k)
            {
                return $backup;
            }
        }
        return false;
    }

    public static function add_new_backup($task_id,$backup_ret)
    {
        $task=WPvivid_taskmanager::get_task($task_id);
        if($task!=false)
        {
            $backup_data=array();
            $backup_data['type']=$task['type'];
            $status=WPvivid_taskmanager::get_backup_task_status($task_id);
            $backup_data['create_time']=$status['start_time'];
            $backup_data['manual_delete']=0;
            $backup_options=WPvivid_taskmanager::get_task_options($task_id,'backup_options');
            $lock=WPvivid_taskmanager::get_task_options($task_id,'lock');
            $backup_data['local']['path']=$backup_options['dir'];
            $backup_data['compress']['compress_type']=$backup_options['compress']['compress_type'];
            $backup_data['save_local']=$task['options']['save_local'];

            global $wpvivid_pulgin;
            $backup_data['log']=$wpvivid_pulgin->wpvivid_log->log_file;

            $backup_data['backup']=$backup_ret;
            $backup_data['remote']=array();
            if($lock==1)
                $backup_data['lock']=1;
            $list = WPvivid_Setting::get_option('wpvivid_backup_list');
            $list[$task_id]=$backup_data;
            WPvivid_Setting::update_option('wpvivid_backup_list',$list);
        }
    }

    public static function add_new_upload_backup($task_id,$backup,$log='')
    {
        $backup_data=array();
        $backup_data['type']='Upload';
        $backup_data['create_time']=time();
        $backup_data['manual_delete']=0;
        $backup_data['local']['path']=WPvivid_Setting::get_backupdir();
        $backup_data['compress']['compress_type']='zip';
        $backup_data['save_local']=1;
        $backup_data['log']=$log;

        $backup_data['backup']=$backup;
        $backup_data['remote']=array();
        $backup_data['lock']=0;
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');
        $list[$task_id]=$backup_data;
        WPvivid_Setting::update_option('wpvivid_backup_list',$list);
    }

    public static function update_backup($id,$key,$data)
    {
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');
        $list[$id][$key]=$data;
        WPvivid_Setting::update_option('wpvivid_backup_list',$list);
    }

    public static function set_backup_file_data($file_data)
    {
        $ret=array();
        $i=0;
        foreach ($file_data as $file)
        {
            $ret[$i]['file_name']=$file['file_name'];
            $ret[$i]['size']=$file['size'];
            $ret[$i]['md5']=$file['md5'];
            $i++;
        }

        return $ret;
    }

    public static function delete_backup($key)
    {
        $list = self::get_backuplist();
        foreach ($list as $k=>$backup)
        {
            if ($key == $k)
            {
                unset($list[$key]);
                WPvivid_Setting::update_option('wpvivid_backup_list',$list);
            }
        }
        $list = self::get_transferlist();
        foreach ($list as $k=>$backup)
        {
            if($key == $k)
            {
                unset($list[$key]);
                WPvivid_Setting::update_option('wpvivid_transfer_list',$list);
            }
        }
    }

    public static function sort_list($list)
    {
        uasort ($list,function($a, $b)
        {
            if($a['create_time']>$b['create_time'])
            {
                return -1;
            }
            else if($a['create_time']===$b['create_time'])
            {
                return 0;
            }
            else
            {
                return 1;
            }
        });

        return $list;
    }

    public static function check_backuplist_limit($max_count)
    {
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');
        $size=sizeof($list);
        if($size>=$max_count)
        {
            $ret['result']='need_delete';
            $oldest_id='not set';
            $oldest=0;
            foreach ($list as $k=>$backup)
            {
                if($oldest==0)
                {
                    $oldest=$backup['create_time'];
                    $oldest_id=$k;
                }
                else
                {
                    if(!array_key_exists('lock',$backup))
                    {
                        if($oldest>$backup['create_time'])
                        {
                            $oldest_id=$k;
                        }
                    }
                }
            }

            if($oldest_id!='not set')
            {
                $ret['oldest_id']=$oldest_id;
            }
            return $ret;
        }
        else
        {
            $ret['result']='ok';
            return $ret;
        }
    }

    public static function get_out_of_date_backuplist($max_count)
    {
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');
        $size=sizeof($list);
        $out_of_date_list=array();

        if($max_count==0)
            return $out_of_date_list;

        while($size>$max_count)
        {
            $oldest_id='not set';

            $oldest=0;
            foreach ($list as $k=>$backup)
            {
                if($oldest==0)
                {
                    $oldest=$backup['create_time'];
                    $oldest_id=$k;
                }
                else
                {
                    if(!array_key_exists('lock',$backup))
                    {
                        if($oldest>$backup['create_time'])
                        {
                            $oldest_id=$k;
                        }
                    }
                }
            }

            if($oldest_id!='not set')
            {
                $out_of_date_list[]=$oldest_id;
                unset($list[$oldest_id]);
            }
            $new_size=sizeof($list);
            if($new_size==$size)
            {
                break;
            }
            else
            {
                $size=$new_size;
            }
        }

        return $out_of_date_list;
    }

    public static function get_out_of_date_backuplist_info($max_count)
    {
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');
        $size=sizeof($list);
        $out_of_date_list['size']=0;
        $out_of_date_list['count']=0;

        if($max_count==0)
            return $out_of_date_list;

        while($size>$max_count)
        {
            $oldest_id='not set';

            $oldest=0;
            foreach ($list as $k=>$backup)
            {
                if($oldest==0)
                {
                    $oldest=$backup['create_time'];
                    $oldest_id=$k;
                }
                else
                {
                    if(!array_key_exists('lock',$backup))
                    {
                        if($oldest>$backup['create_time'])
                        {
                            $oldest_id=$k;
                        }
                    }
                }
            }

            if($oldest_id!='not set')
            {
                $out_of_date_list['size']+=self::get_size($oldest_id);
                $out_of_date_list['count']++;
                unset($list[$oldest_id]);
            }
            $new_size=sizeof($list);
            if($new_size==$size)
            {
                break;
            }
            else
            {
                $size=$new_size;
            }
        }

        return $out_of_date_list;
    }

    public static function get_size($backup_id)
    {
        $size=0;
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');
        $backup=$list[$backup_id];
        if(isset($backup['backup']['files'])){
            foreach ($backup['backup']['files'] as $file) {
                $size+=$file['size'];
            }
        }
        else{
            if(isset($backup['backup']['data']['type'])){
                foreach ($backup['backup']['data']['type'] as $type) {
                    foreach ($type['files'] as $file) {
                        $size+=$file['size'];
                    }
                }
            }
        }

        return $size;
    }
    public static function set_security_lock($backup_id,$lock)
    {
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');

        if(array_key_exists($backup_id,$list))
        {
            if($lock==1)
            {
                $list[$backup_id]['lock']=1;
            }
            else
            {
                if(array_key_exists('lock',$list[$backup_id]))
                {
                    unset($list[$backup_id]['lock']);
                }
            }
        }

        WPvivid_Setting::update_option('wpvivid_backup_list',$list);
    }

    public static function get_has_remote_backuplist()
    {
        $backup_id_list=array();
        $list = WPvivid_Setting::get_option('wpvivid_backup_list');
        foreach ($list as $k=>$backup)
        {
            if(!empty($backup['remote']))
            {
                $backup_id_list[]=$k;
            }
        }
        return $backup_id_list;
    }
}