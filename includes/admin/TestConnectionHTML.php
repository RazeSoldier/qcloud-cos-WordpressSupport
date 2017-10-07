<?php
/** 
 * 测试与腾讯云的连接的HTML代码
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
<hr/>
<h2>测试连接</h2>
本测试将试图根据你提供的设置连接COS<br>
<form name="test" method="post" action="./options-general.php?page=COS_SettingPage#test_submit">
    <?php submit_button('测试', 'secondary', 'test_submit'); ?>
</form>