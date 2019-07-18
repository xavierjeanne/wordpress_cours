<?php
if (!defined('WPVIVID_PLUGIN_DIR')){
    die;
}
if(!defined('WPVIVID_REMOTE_AMAZONS3'))
    define('WPVIVID_REMOTE_AMAZONS3','amazons3');
if(!defined('WPVIVID_AMAZONS3_DEFAULT_FOLDER'))
    define('WPVIVID_AMAZONS3_DEFAULT_FOLDER','/wpvivid_backup');

require_once WPVIVID_PLUGIN_DIR . '/includes/customclass/class-wpvivid-remote.php';
require_once 'class-wpvivid-base-s3.php';
class WPvivid_AMAZONS3Class extends WPvivid_Remote{

    public $options;
    public $bucket='';

    private $upload_chunk_size = 5242880;
    private $download_chunk_size = 5242880;

    public function __construct($options=array())
    {
        if(empty($options))
        {
            add_action('wpvivid_add_storage_tab',array($this,'wpvivid_add_storage_tab_amazons3'), 11);
            add_action('wpvivid_add_storage_page',array($this,'wpvivid_add_storage_page_amazons3'), 11);
            add_action('wpvivid_edit_remote_page',array($this,'wpvivid_edit_storage_page_amazons3'), 11);
            add_filter('wpvivid_remote_pic',array($this,'wpvivid_remote_pic_amazons3'),11);
            add_filter('wpvivid_get_out_of_date_remote',array($this,'wpvivid_get_out_of_date_amazons3'),10,2);
            add_filter('wpvivid_storage_provider_tran',array($this,'wpvivid_storage_provider_amazons3'),10);
        }
        else
        {
            $this->options=$options;
        }
    }

    public function wpvivid_add_storage_tab_amazons3()
    {
        ?>
        <div class="storage-providers" remote_type="amazons3" onclick="select_remote_storage(event, 'storage_account_amazons3');">
            <img src="<?php echo esc_url(WPVIVID_PLUGIN_URL.'/admin/partials/images/storage-amazon-s3.png'); ?>" style="vertical-align:middle;"/><?php _e('Amazon S3', 'wpvivid'); ?>
        </div>
        <?php
    }

    public function wpvivid_add_storage_page_amazons3()
    {
        if(!function_exists('simplexml_load_string')){
            $need_extension = true;
            $add_btn_style = 'pointer-events: none; opacity: 0.4;';
        }
        else{
            $need_extension = false;
            $add_btn_style = 'pointer-events: auto; opacity: 1;';
        }
        ?>
        <div id="storage_account_amazons3"  class="storage-account-page" style="display:none;">
            <h2><span><?php _e( 'Enter Your Amazon S3 Account ','wpvivid'); ?></span></h2>
            <div class="storage-account-form">
                <input type="text" autocomplete="off" option="amazons3" name="name" placeholder="Enter an unique alias: e.g. Amazon S3-001" class="regular-text" onkeyup="value=value.replace(/[^a-zA-Z0-9\-_]/g,'')" />
            </div>
            <div class="storage-account-form">
                <input type="text" autocomplete="off" option="amazons3" name="access" placeholder="Amazon S3 access key" class="regular-text"/>
            </div>
            <div class="storage-account-form">
                <input type="password" autocomplete="new-password" option="amazons3" name="secret" placeholder="Amazon S3 secret key" class="regular-text"/>
            </div>
            <div class="storage-account-form">
                <input type="text" autocomplete="off" option="amazons3" name="s3Path" placeholder="Amazon S3 path(e.g. test)" class="regular-text" onkeyup="value=value.replace(/^\//g, '')" style="width: 245px;" />
                <span><?php _e(WPVIVID_AMAZONS3_DEFAULT_FOLDER); ?></span>
            </div>
            <div style="padding-left: 10px; margin-bottom: -16px;">
                <p><span>Amazon S3 storage path:</span><span id="wpvivid_amazons3_root_path">*<?php _e(WPVIVID_AMAZONS3_DEFAULT_FOLDER); ?></span></p>
            </div>
            <div class="remote-storage-set-default-block">
                <label>
                    <input type="checkbox" option="amazons3" name="default" checked /><?php _e('Set as the default remote storage.', 'wpvivid'); ?>
                </label>
            </div>
            <div class="remote-storage-amazons3-storage-class">
                <label>
                    <input type="checkbox" option="amazons3" name="classMode"/><?php _e('Storage class: Standard (infrequent access).', 'wpvivid'); ?>
                </label>
            </div>
            <div class="remote-storage-amazons3-encryption">
                <label>
                    <input type="checkbox" option="amazons3" name="sse"/><?php _e('Server-side encryption.', 'wpvivid'); ?>
                </label>
            </div>
            <div id="wpvivid_storage_account_notice"></div>
            <?php
            if($need_extension){
                ?>
                <p style="padding-left: 10px;">The simplexml extension is not detected. Please install the extension first.</p>
                <?php
            }
            ?>
            <div>
                <input class="button-primary storage-account-button" option="add-remote" type="button" name="Example" value="<?php _e( 'Test and Add', 'wpvivid' ); ?>" style="<?php esc_attr_e($add_btn_style); ?>" />
            </div>
        </div>
        <script>
            jQuery("input:text[option=amazons3][name=s3Path]").keyup(function(){
                var value = jQuery(this).val();
                if(value == ''){
                    value = '*';
                }
                value = value + '/wpvivid_backup';
                jQuery('#wpvivid_amazons3_root_path').html(value);
            });
        </script>
        <?php
    }

    public function wpvivid_edit_storage_page_amazons3()
    {
        ?>
        <div id="remote_storage_edit_amazons3" class="postbox storage-account-block remote-storage-edit" style="display:none;">
            <h2><span><?php _e( 'Enter Your Amazon S3 Account ','wpvivid'); ?></span></h2>
            <div class="storage-account-form">
                <input type="text" option="edit-amazons3" name="name" placeholder="Enter an unique alias: e.g. Amazon S3-001" class="regular-text" onkeyup="value=value.replace(/[^a-zA-Z0-9\-_]/g,'')" />
            </div>
            <div class="storage-account-form">
                <input type="text" option="edit-amazons3" name="access" placeholder="Amazon S3 access key" class="regular-text"/>
            </div>
            <div class="storage-account-form">
                <input type="password" option="edit-amazons3" name="secret" placeholder="Amazon S3 secret key" class="regular-text"/>
            </div>
            <div class="storage-account-form">
                <input type="text" autocomplete="off" option="edit-amazons3" name="s3Path" placeholder="Amazon S3 path(e.g. test)" class="regular-text" onkeyup="value=value.replace(/^\//g, '')" style="width: 245px;" />
                <span><?php _e(WPVIVID_AMAZONS3_DEFAULT_FOLDER); ?></span>
            </div>
            <div style="padding-left: 10px;">
                <p><span>Amazon S3 storage path:</span><span id="wpvivid_edit_amazons3_root_path"><?php _e(WPVIVID_AMAZONS3_DEFAULT_FOLDER); ?></span></p>
            </div>
            <div class="remote-storage-amazons3-storage-class">
                <label>
                    <input type="checkbox" option="edit-amazons3" name="classMode"/><?php _e('Storage class: Standard (infrequent access).', 'wpvivid'); ?>
                </label>
            </div>
            <div class="remote-storage-amazons3-encryption">
                <label>
                    <input type="checkbox" option="edit-amazons3" name="sse"/><?php _e('Server-side encryption.', 'wpvivid'); ?>
                </label>
            </div>
            <div class=""><input class="button-primary storage-account-button" option="edit-remote" type="button" name="amazons3" value="<?php _e( 'Save Changes', 'wpvivid' ); ?>" /></div>
        </div>
        <script>
            jQuery("input:text[option=edit-amazons3][name=s3Path]").keyup(function(){
                var value = jQuery(this).val();
                if(value == ''){
                    value = '*';
                }
                value = value + '/wpvivid_backup';
                jQuery('#wpvivid_edit_amazons3_root_path').html(value);
            });
        </script>
        <?php
    }

    public function wpvivid_remote_pic_amazons3($remote){
        $remote['amazons3']['default_pic'] = '/admin/partials/images/storage-amazon-s3(gray).png';
        $remote['amazons3']['selected_pic'] = '/admin/partials/images/storage-amazon-s3.png';
        $remote['amazons3']['title'] = 'Amazon S3';
        return $remote;
    }

    public function test_connect()
    {
        try{
            $amazons3 = $this -> getS3();
            if(is_array($amazons3) && $amazons3['result'] === WPVIVID_FAILED)
                return $amazons3;
            $temp_file = md5(rand());
            if(!$amazons3 -> putObjectString($temp_file,$this -> bucket,$this->options['s3Path'].$temp_file)){
                return array('result'=>WPVIVID_FAILED,'error'=>'We successfully accessed the bucket, but create test file failed.');
            }
            if(!$amazons3 -> deleteObject($this -> bucket,$this->options['s3Path'].$temp_file)){
                return array('result'=>WPVIVID_FAILED,'error'=>'We successfully accessed the bucket, and create test file succeed, but delete test file failed.');
            }
        }
        catch(Exception $e){
            return array('result'=>WPVIVID_FAILED,'error'=>$e -> getMessage());
        }
        catch(Error $e){
            return array('result'=>WPVIVID_FAILED,'error'=>$e -> getMessage());
        }
        return array('result'=>WPVIVID_SUCCESS);
    }

    public function sanitize_options($skip_name='')
    {
        $ret['result']=WPVIVID_FAILED;
        if(!isset($this->options['name']))
        {
            $ret['error']="Warning: An alias for remote storage is required.";
            return $ret;
        }

        $this->options['name']=sanitize_text_field($this->options['name']);

        if(empty($this->options['name']))
        {
            $ret['error']="Warning: An alias for remote storage is required.";
            return $ret;
        }

        $remoteslist=WPvivid_Setting::get_all_remote_options();
        foreach ($remoteslist as $key=>$value)
        {
            if(isset($value['name'])&&$value['name'] == $this->options['name']&&$skip_name!=$value['name'])
            {
                $ret['error']="Warning: The alias already exists in storage list.";
                return $ret;
            }
        }

        if(!isset($this->options['access']))
        {
            $ret['error']="Warning: The access key for Amazon S3 is required.";
            return $ret;
        }

        $this->options['access']=sanitize_text_field($this->options['access']);

        if(empty($this->options['access']))
        {
            $ret['error']="Warning: The access key for Amazon S3 is required.";
            return $ret;
        }

        if(!isset($this->options['secret']))
        {
            $ret['error']="Warning: The storage secret key is required.";
            return $ret;
        }

        $this->options['secret']=sanitize_text_field($this->options['secret']);

        if(empty($this->options['secret']))
        {
            $ret['error']="Warning: The storage secret key is required.";
            return $ret;
        }

        if(!isset($this->options['s3Path']))
        {
            $ret['error']="Warning: The storage path is required.";
            return $ret;
        }

        $this->options['s3Path']=sanitize_text_field($this->options['s3Path']);

        if(empty($this->options['s3Path']))
        {
            $ret['error']="Warning: The storage path is required.";
            return $ret;
        }

        $this->options['s3Path'] = $this->options['s3Path'] . WPVIVID_AMAZONS3_DEFAULT_FOLDER;

        $ret['result']=WPVIVID_SUCCESS;
        $ret['options']=$this->options;
        return $ret;
    }

    public function upload($task_id,$files,$callback='')
    {
        $amazons3 = $this -> getS3();
        if(is_array($amazons3) && $amazons3['result'] == WPVIVID_FAILED)
            return $amazons3;

        $upload_job=WPvivid_taskmanager::get_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3);
        if(empty($upload_job))
        {
            $job_data=array();
            foreach ($files as $file)
            {
                $file_data['size']=filesize($file);
                $file_data['uploaded']=0;
                $job_data[basename($file)]=$file_data;
            }
            WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3,WPVIVID_UPLOAD_UNDO,'Start uploading',$job_data);
            $upload_job=WPvivid_taskmanager::get_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3);
        }

        foreach ($files as $file){
            if(is_array($upload_job['job_data']) &&array_key_exists(basename($file),$upload_job['job_data']))
            {
                if($upload_job['job_data'][basename($file)]['uploaded']==1)
                    continue;
            }

            $this -> last_time = time();
            $this -> last_size = 0;

            if(!file_exists($file))
                return array('result' =>WPVIVID_FAILED,'error' =>$file.' not found. The file might has been moved, renamed or deleted. Please reload the list and verify the file exists.');
            $result = $this -> _put($task_id,$amazons3,$file,$callback);
            if($result['result'] !==WPVIVID_SUCCESS){
                return $result;
            }
        }
        return array('result' =>WPVIVID_SUCCESS);
    }
    private function _put($task_id,$amazons3,$file,$callback)
    {
        $upload_job=WPvivid_taskmanager::get_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3);
        $this -> current_file_size = filesize($file);
        $this -> current_file_name = basename($file);

        $chunk_num = floor($this -> current_file_size / $this -> upload_chunk_size);
        if($this -> current_file_size % $this -> upload_chunk_size > 0) $chunk_num ++;

        for($i =0;$i <WPVIVID_REMOTE_CONNECT_RETRY_TIMES;$i ++)
        {
            try
            {
                WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3,WPVIVID_UPLOAD_UNDO,'Start uploading '.basename($file).'.',$upload_job['job_data']);
                if($chunk_num > 1)
                {
                    if(!empty($upload_job['job_data'][basename($file)]['upload_id']))
                    {
                        $build_id = $upload_job['job_data'][basename($file)]['upload_id'];
                    }else{
                        $build_id = $amazons3 -> initiateMultipartUpload($this -> bucket,$this->options['s3Path'].$this -> current_file_name);
                        $upload_job['job_data'][basename($file)]['upload_id'] = $build_id;
                        WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3,WPVIVID_UPLOAD_UNDO,'InitiateMultipartUpload, created build id of '.basename($file).'.',$upload_job['job_data']);
                    }
                    if(!empty($upload_job['job_data'][basename($file)]['upload_chunks']))
                    {
                        $chunks = $upload_job['job_data'][basename($file)]['upload_chunks'];
                    }else{
                        $chunks = array();
                        $upload_job['job_data'][basename($file)]['upload_chunks'] = $chunks;
                        WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3,WPVIVID_UPLOAD_UNDO,'Start multipartupload of '.basename($file).'.',$upload_job['job_data']);
                    }

                    for($i =sizeof($chunks);$i <$chunk_num;$i ++)
                    {
                        $chunk_id = $amazons3 -> uploadPart($this -> bucket,$this->options['s3Path'].$this -> current_file_name,$build_id,$file,$i+1,$this ->upload_chunk_size);
                        if(!$chunk_id){
                            $chunks = array();
                            $upload_job['job_data'][basename($file)]['upload_chunks'] = $chunks;
                            WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_DROPBOX,WPVIVID_UPLOAD_FAILED,'Start multipartupload of '.basename($file).'.',$upload_job['job_data']);
                            return array('result' => WPVIVID_FAILED,'error' => 'upload '.$file.' failed.');
                        }
                        $chunks[] = $chunk_id;
                        $upload_job['job_data'][basename($file)]['upload_chunks'] = $chunks;
                        WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3,WPVIVID_UPLOAD_UNDO,'Uploading '.basename($file).'.',$upload_job['job_data']);

                        $offset = (($i + 1) * $this -> upload_chunk_size) > $this -> current_file_size ? $this -> current_file_size : (($i + 1) * $this -> upload_chunk_size);
                        if((time() - $this -> last_time) >3)
                        {
                            if(is_callable($callback))
                            {
                                call_user_func_array($callback,array($offset,$this -> current_file_name,
                                    $this->current_file_size,$this -> last_time,$this -> last_size));
                            }
                            $this -> last_size = $offset;
                            $this -> last_time = time();
                        }
                    }
                    $result = $amazons3 -> completeMultipartUpload($this -> bucket,$this->options['s3Path'].$this -> current_file_name,$build_id,$chunks);
                }else{
                    $input = $amazons3 -> inputFile($file);
                    $result = $amazons3 -> putObject($input,$this ->bucket,$this->options['s3Path'].$this -> current_file_name);
                }
            }catch(Exception $e)
            {
                if(strstr($e -> getMessage(), 'upload ID may be invalid'))
                {
                    $upload_job['job_data'][basename($file)]['upload_id'] = '';
                    $upload_job['job_data'][basename($file)]['upload_chunks'] = '';
                    continue;
                }
                return array('result' => WPVIVID_FAILED,'error'=>$e -> getMessage());
            }
            if($result){
                $upload_job['job_data'][basename($file)]['uploaded']=1;
                WPvivid_taskmanager::update_backup_sub_task_progress($task_id,'upload',WPVIVID_REMOTE_AMAZONS3,WPVIVID_UPLOAD_SUCCESS,'Uploading '.basename($file).' completed.',$upload_job['job_data']);
                break;
            }
            if(!$result && $i == (WPVIVID_REMOTE_CONNECT_RETRY_TIMES - 1))
            {
                return array('result'=>WPVIVID_FAILED,'error'=>'Uploading '.$file.' to Amazon S3 server failed. '.$file.' might be deleted or network doesn\'t work properly. Please verify the file and confirm the network connection and try again later.');
            }
            sleep(WPVIVID_REMOTE_CONNECT_RETRY_INTERVAL);
        }
        return array('result' =>WPVIVID_SUCCESS);
    }

    public function download($file,$local_path,$callback = '')
    {
        try {
            global $wpvivid_pulgin;
            $this->current_file_name = $file['file_name'];
            $this->current_file_size = $file['size'];
            $file_md5 = $file['md5'];
            $wpvivid_pulgin->wpvivid_download_log->WriteLog('Get amazons3 client.','notice');
            $amazons3 = $this->getS3();
            if (is_array($amazons3) && $amazons3['result'] === WPVIVID_FAILED) {
                return $amazons3;
            }

            $file_path = trailingslashit($local_path) . $this->current_file_name;
            $start_offset = file_exists($file_path) ? filesize($file_path) : 0;
            $wpvivid_pulgin->wpvivid_download_log->WriteLog('Create local file.','notice');
            $fh = fopen($file_path, 'a');
            $wpvivid_pulgin->wpvivid_download_log->WriteLog('Downloading file ' . $file['file_name'] . ', Size: ' . $file['size'] ,'notice');
            while ($start_offset < $this->current_file_size) {
                $last_byte = min($start_offset + $this->download_chunk_size - 1, $this->current_file_size - 1);
                $headers['Range'] = "bytes=$start_offset-$last_byte";
                $response = $amazons3->getObject($this->bucket, $this->options['s3Path'] . $this->current_file_name, $fh, $headers['Range']);
                if (!$response)
                    return array('result' => WPVIVID_FAILED, 'error' => 'download ' . $this->options['s3Path'] . $this->current_file_name . ' failed.');
                clearstatcache();
                $state = stat($file_path);
                $start_offset = $state['size'];

                if ((time() - $this->last_time) > 3) {
                    if (is_callable($callback)) {
                        call_user_func_array($callback, array($start_offset, $this->current_file_name,
                            $this->current_file_size, $this->last_time, $this->last_size));
                    }
                    $this->last_size = $start_offset;
                    $this->last_time = time();
                }
            }
            @fclose($fh);

            if(filesize($file_path) == $file['size']){
                if($wpvivid_pulgin->wpvivid_check_zip_valid()) {
                    $res = TRUE;
                }
                else{
                    $res = FALSE;
                }
            }
            else{
                $res = FALSE;
            }

            if ($res !== TRUE) {
                @unlink($file_path);
                return array('result' => WPVIVID_FAILED, 'error' => 'Downloading ' . $file['file_name'] . ' failed. ' . $file['file_name'] . ' might be deleted or network doesn\'t work properly. Please verify the file and confirm the network connection and try again later.');
            }

            return array('result' => WPVIVID_SUCCESS);
        }
        catch (Exception $error){
            $message = 'An exception has occurred. class: '.get_class($error).';msg: '.$error->getMessage().';code: '.$error->getCode().';line: '.$error->getLine().';in_file: '.$error->getFile().';';
            error_log($message);
            return array('result'=>WPVIVID_FAILED, 'error'=>$message);
        }
    }

    public function cleanup($files)
    {
        $amazons3 = $this -> getS3();

        if(is_array($amazons3) && $amazons3['result'] === WPVIVID_FAILED)
            return $amazons3;
        foreach ($files as $file){
            $amazons3 -> deleteObject($this -> bucket , $this->options['s3Path'].$file);
        }
        return array('result' => WPVIVID_SUCCESS);
    }

    private function getS3()
    {
        $path_temp = str_replace('s3://','',$this->options['s3Path']);
        if (preg_match("#^/*([^/]+)/(.*)$#", $path_temp, $bmatches))
        {
            $this->bucket = $bmatches[1];
            if(empty($bmatches[2])){
                $this->options['s3Path'] = '';
            }else{
                $this->options['s3Path'] = trailingslashit($bmatches[2]);
            }
        } else {
            $this->bucket = $path_temp;
            $this->options['s3Path'] = '';
        }

        $amazons3 = new WPvivid_Base_S3($this->options['access'],$this->options['secret']);
        $amazons3 -> setExceptions();
        if($this->options['classMode'])
            $amazons3 -> setStorageClass();
        if($this->options['sse'])
            $amazons3 -> setServerSideEncryption();

        try{
            $region = $amazons3 -> getBucketLocation($this->bucket);
        }catch(Exception $e){
            return array('result' => WPVIVID_FAILED,'error' => $e -> getMessage());
        }
        $endpoint = $this -> getEndpoint($region);
        if(!empty($endpoint))
            $amazons3 -> setEndpoint($endpoint);
        return $amazons3;
    }
    private function getEndpoint($region){
        switch ($region) {
            case 'EU':
            case 'eu-west-1':
                $endpoint = 's3-eu-west-1.amazonaws.com';
                break;
            case 'us-east-1':
                $endpoint = 's3.amazonaws.com';
                break;
            case 'us-west-1':
            case 'us-east-2':
            case 'us-west-2':
            case 'eu-west-2':
            case 'eu-west-3':
            case 'ap-southeast-1':
            case 'ap-southeast-2':
            case 'ap-northeast-2':
            case 'sa-east-1':
            case 'ca-central-1':
            case 'us-gov-west-1':
            case 'eu-central-1':
                $endpoint = 's3-'.$region.'.amazonaws.com';
                break;
            case 'ap-northeast-1':
                $endpoint = 's3.'.$region.'.amazonaws.com';
                break;
            case 'ap-south-1':
            case 'cn-north-1':
                $endpoint = 's3.'.$region.'.amazonaws.com.cn';
                break;
            default:
                break;
        }
        return $endpoint;
    }

    public function wpvivid_get_out_of_date_amazons3($out_of_date_remote, $remote)
    {
        if($remote['type'] == WPVIVID_REMOTE_AMAZONS3){
            $out_of_date_remote = $remote['s3Path'];
        }
        return $out_of_date_remote;
    }

    public function wpvivid_storage_provider_amazons3($storage_type)
    {
        if($storage_type == WPVIVID_REMOTE_AMAZONS3){
            $storage_type = 'Amazon S3';
        }
        return $storage_type;
    }
}