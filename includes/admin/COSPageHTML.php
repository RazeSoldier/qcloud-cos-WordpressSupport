<?php
/** 
 * COS服务页面的HTML代码
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
?>
<div class="wrap">
    <h1>腾讯云对象存储服务总览</h1>
    <table border="1" style="text-align: center">
	<caption><b>COS配置</b></caption>
	<tbody>
	    <tr>
		<td><b>Bucket名称</b></td>
		<td><?php echo $this->cos_config['cos_bucketName']; ?></td>
	    </tr>
	    <tr>
		<td><b>Bucket地域</b></td>
		<td><?php echo $this->cos_config['cos_region']; ?></td>
	    </tr>
	</tbody>
    </table>
</div>