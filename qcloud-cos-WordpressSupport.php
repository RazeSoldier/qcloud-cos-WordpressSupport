<?php
/*
Plugin Name: 腾讯云对象存储服务支持
Plugin URI: https://github.com/RazeSoldier/qcloud-cos-WordpressSupport
Description: 本插件可以增加Wordpress对腾讯云对象存储服务的支持
Version: 0.1
Author: RazeSoldier
Author URI: https://www.razesoldier.cn
License: GPLv3
 * 
 * 插件主文件
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

if ( !function_exists( 'add_action' ) ) {
    echo '(｡･∀･)ﾉﾞ嗨！我只是一个插件，直接访问我的话，我是不会直接工作的！';
    die (1);
}

// 调用插件主类
require_once __DIR__ . '/includes/qcloud-cos-WordpressSupport.class.php';

register_activation_hook(__FILE__, array('qcloud_cos_WordpressSupport', 'install')); //在启用插件的时候初始化选项

$qcws_IP = plugin_dir_path(__FILE__); //插件的安装路径
$run = new qcloud_cos_WordpressSupport($qcws_IP);
add_action('admin_menu', array($run, 'loadSettingPage')); //加载插件管理面板