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
    protected $IP;
    
    /**
     * @var array $cos_config 储存从数据库取来的选项
     */
    protected $cos_config;
    
    /**
     * @var array $postRequest 存储POST请求的数据
     */
    protected $postRequest;

    public function __construct($IP) {
	$this->IP = $IP; //导入外部变量(插件安装路径)
	
	$this->cos_config = get_option('COS_options');
	$this->postRequest = $_POST;
    }
    
    /**
     * 检查用户是否有权限访问管理面板
     * 
     * @param string $right 要检查的权限名称(默认检查manage_options)
     */
    protected function checkAccessRight($right='manage_options'){
	if (!current_user_can($right)) {
	    wp_die('权限不足!');
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