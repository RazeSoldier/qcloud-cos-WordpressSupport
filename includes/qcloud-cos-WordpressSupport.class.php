<?php
/** 
 * 插件主类
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 * 
 * @file
 */
namespace qcws;

class qcloud_cos_WordpressSupport{
    /*
     * 在启用插件的时候初始化选项
     */
    public static function install(){
	$options = array(
	    'cos_bucketName' => '',
	    'cos_region' => '',
	    'cos_appid' =>'',
	    'cos_secretid' => '',
	    'cos_secretkey' => '',
	    );
	add_option('COS_options', $options);
    }
    
    /**
     * @var string $IP 插件安装路径
     */
    private $IP;
    
    /**
     * @var array $cos_config 储存从数据库取来的选项
     */
    private $cos_config;
    
    /**
     * @var array $postRequest 存储POST请求的数据
     */
    private $postRequest;

    public function __construct($IP) {
	$this->IP = $IP; //导入外部变量(插件安装路径)
	
	$this->cos_config = get_option('COS_options');
	$this->postRequest = $_POST;
    }
    
    /**
     * 加载插件管理面板
     */
    public function loadSettingPage(){
	$this->checkAccessRight();
	add_options_page('腾讯云COS支持设置', '腾讯云COS支持', 'manage_options',
		'COS_SettingPage', array($this, 'setSettingPageHTML'));
    }
    
    /**
     * 检查用户是否有权限访问管理面板
     * 
     * @param string $right 要检查的权限名称(默认检查manage_options)
     */
    private function checkAccessRight($right='manage_options'){
	if (!current_user_can($right)) {
	    wp_die('权限不足!');
	}
    }
    
    /**
     * 定义管理面板的HTML代码
     */
    public function setSettingPageHTML(){
	$this->inputHandler();
	require_once $this->IP.'includes/admin/SettingPageHTML.php';
    }
    
    /**
     * 根据$this->$cos_config['cos_region']的值生成Region选择栏
     */
    private function generateRegionOptions(){
	switch ($this->cos_config['cos_region']) {
	    case 'gz':
		echo '<option value="gz" selected>华南</option>\n<option value="sh">华中</option>\n<option value="tj">华北</option>';
		break;
	    case 'sh':
		echo '<option value="gz">华南</option>\n<option value="sh" selected>华中</option>\n<option value="tj">华北</option>';
		break;
	    case 'tj':
		echo '<option value="gz">华南</option>\n<option value="sh">华中</option>\n<option value="tj" selected>华北</option>';
		break;
	    default :
		echo '<option value="gz" selected>华南</option>\n<option value="sh">华中</option>\n<option value="tj">华北</option>';
		break;
	}
    }
    
    /**
     * 处理用户输入的数据
     * 
     */
    private function inputHandler(){
	$config_bucketName = $this->postRequest['set_bucket'];
	$config_region = $this->postRequest['set_region'];
	$config_appid = $this->postRequest['set_appid'];
	$config_secretid = $this->postRequest['set_secretid'];
	$config_secretkey = $this->postRequest['set_secretkey'];
	
	$this->checkInputBucketName($config_bucketName);
	$this->checkInputRegion($config_region);
	
	if ($this->postRequest['settings_submit'] == '保存更改'){
	    $this->cos_config['cos_bucketName'] = $config_bucketName;
	    $this->cos_config['cos_region'] = $config_region;
	    $this->cos_config['cos_appid'] = $config_appid;
	    $this->cos_config['cos_secretid'] = $config_secretid;
	    $this->cos_config['cos_secretkey'] = $config_secretkey;
	    $this->updateData($this->cos_config);
	}
    }
    
    /**
     * 检查用户输入的bucket的数值
     * 
     * 检查bucket的数值是小写字母、数字的组合，而且不能超过40字符
     */
    private function checkInputBucketName($bucketName){
	$nameLength = strlen($bucketName); //$bucketName的长度
	$matchNumber = preg_match_all('/[a-z0-9]/', $bucketName); //匹配次数
	// 如果bucket的长度不等于符合条件的字符串个数，或者bucket的长度超过40
	if (!($nameLength == $matchNumber and $nameLength <= 40)){
	    wp_die('<script type="text/javascript">alert(\'Bucket名称不符合规范!\n请输入小写字母、数字的组合，且不能超过40字符\');window.location.href=\'\';</script>');
	}
    }
    
    /**
     * 检查用户输入的region的数值
     * 
     * @param string $region bucket的区域
     */
    private function checkInputRegion($region){
	if (!($region == 'gz' ||
	     $region == 'sh' ||
	     $region == 'tj' ||
	     $region == ''
	    )
	    ){
	    wp_die('非法操作!');
	}
    }
    
    /**
     * 更新数据
     * 
     * @param array $data 要更新的数据
     * @return bool
     */
    private function updateData($data){
	$update = update_option('cos_options', $data);
	if ($update){
	    echo '<div class="updated"><p><strong>设置已保存！</strong></p></div>';
	}else{
	    echo '更新失败';
	}
    }
    
    /**
     * 检查当前配置能否连接腾讯云
     */
    private function checkSettings(){
	if ($this->checkConfig()){
		    require_once $this->IP.'includes/admin/TestConnectionHTML.php';
		    if ($this->postRequest['test_submit'] == '测试'){
			require_once $this->IP.'includes/Interface.php';
			
			$config = array(
			    'app_id' => $this->cos_config['cos_appid'],
			    'secret_id' => $this->cos_config['cos_secretid'],
			    'secret_key' => $this->cos_config['cos_secretkey'],
			    'region' => $this->cos_config['cos_region'],
			    'timeout' => 10
			    );
			
			InterfaceSDK::testConnection($config, $this->cos_config['cos_bucketName']);
		    }
	}
    }
    
    /**
     * 检查用户是否设置了COSconfig
     * 
     * 如果没有设置或者没有设置完整，返回false；反之亦然
     * 
     * @return bool
     */
    protected function checkConfig(){
	if (!empty($this->cos_config['cos_bucketName']) and
		!empty($this->cos_config['cos_region']) and
		!empty($this->cos_config['cos_appid']) and
		!empty($this->cos_config['cos_secretid']) and
		!empty($this->cos_config['cos_secretkey'])
		){
	    return true;
	}else{
	    return false;
	}
    }
}