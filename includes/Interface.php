<?php
/** 
 * 本文件作为插件和SDK之间的接口
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

global $qcws_IP;
require_once $qcws_IP.'includes/src/include.php';

use QCloud\Cos\Api;

class InterfaceSDK{
    public static function testConnection($config, $bucketName){
	$cosApi = new Api($config);
	$ret = $cosApi->listFolder($bucketName, '/');
	if ($ret['message'] == 'SUCCESS'){
	    echo '<p><strong>连接成功！</strong></p>';
	}else{
	    echo '<p><strong>连接失败！请检查你的设置是否正确</strong></p>';
	}
    }
}