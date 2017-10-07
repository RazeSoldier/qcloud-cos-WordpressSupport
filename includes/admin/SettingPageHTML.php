<?php
/** 
 * 插件管理面板的html文件
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
    <h1>腾讯云对象存储服务设置</h1>
    <form name="setting" method="post" action="./options-general.php?page=COS_SettingPage">  
	<h2>Bucket设置</h2>
	<table class="form-table">
	    <tr>
		<th scope="row"><label>Bucket名称</label></th>
		    <td>
			<input name="set_bucket" type="text" size="50" maxlength="40" value="<?php echo $this->cos_config['cos_bucketName']; ?>">
		    </td>
	    </tr>
	    <tr>
		<th scope="row"><label>地域</label></th>
		<td><select name="set_region" size="1">
			<?php $this->generateRegionOptions(); ?>
		    </select>
		</td>
	    </tr>
	</table>
	<h2>访问设置</h2>
	<table class="form-table">
	    <tr>
		<th scope="row"><label>APPID</label></th>
		    <td>
			<input name="set_appid" type="text" size="50" maxlength="50" value="<?php echo $this->cos_config['cos_appid']; ?>">
		    </td>
	    </tr>
	    <tr>
		<th scope="row"><label>SecretId</label></th>
		    <td>
			<input name="set_secretid" type="text" size="50" maxlength="50" value="<?php echo $this->cos_config['cos_secretid']; ?>">
		    </td>
	    </tr>
	    <tr>
		<th scope="row"><label>SecretKey</label></th>
		    <td>
			<input name="set_secretkey" type="text" size="50" maxlength="50" value="<?php echo $this->cos_config['cos_secretkey']; ?>">
		    </td>
	    </tr>
	</table>
	<?php submit_button('保存更改', 'primary', 'settings_submit'); ?>
    </form>
    <?php $this->checkSettings(); ?>
</div>