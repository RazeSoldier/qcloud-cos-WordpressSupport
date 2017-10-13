<?php
/** 
 * 处理COS服务页面的子类
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

class COSpage extends qcloud_cos_WordpressSupport{
    /**
     * 加载COS服务页面
     */
    public function loadCOSPage(){
	if ($this->checkConfig()){
	    $this->addCOSPageMeun();
	}
    }
    
    /**
     * 在后台添加COS服务页面的菜单
     */
    private function addCOSPageMeun(){
	//添加顶级菜单
	add_menu_page( '腾讯云对象存储服务', '腾讯云对象存储服务', 'manage_options', 'COS', array($this, 'setCOSpage'));
    }
    
    /**
     * 定义COS服务页面
     */
    public function setCOSpage(){
	require_once $this->IP.'includes/admin/COSPageHTML.php';
    }
    
    /**
     * 转换Bucket的地域为对应的中文
     * 
     * @return string
     */
    private function convertRegion(){
	$region = $this->cos_config['cos_region'];
	switch ($region) {
	    case 'gz':
		return '华南';
	    case 'sh':
		return '华中';
	    case 'tj':
		return '华北';
	}
    }
}