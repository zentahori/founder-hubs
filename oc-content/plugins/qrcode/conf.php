<?php if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    if(Params::getParam('plugin_action')=='done') {
        osc_set_preference('upload_path', Params::getParam('upload_path'), 'qrcode', 'STRING');
        osc_set_preference('upload_url', Params::getParam('upload_url'), 'qrcode', 'STRING');
        osc_set_preference('code_size', Params::getParam('code_size'), 'qrcode', 'INTEGER');
        echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. The plugin is now configured', 'qrcode') . '.</p></div>' ;
        osc_reset_preferences();
    }
?>
<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
    <div style="padding: 20px;">
        <div style="float: left; width: 100%;">
            <fieldset>
                <legend><?php _e('QR Code Settings', 'qrcode'); ?></legend>
                <form name="qrcode_form" id="qrcode_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
                    <div style="float: left; width: 100%;">
                    <input type="hidden" name="page" value="plugins" />
                    <input type="hidden" name="action" value="renderplugin" />
                    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>conf.php" />
                    <input type="hidden" name="plugin_action" value="done" />
                        <label for="upload_path"><?php _e('Upload path', 'qrcode'); ?></label>
                        <br/>
                        <input type="text" name="upload_path" id="upload_path" value="<?php echo osc_get_preference('upload_path', 'qrcode'); ?>"/>
                        <br/>
                        <label for="upload_url"><?php _e('Upload url', 'qrcode'); ?></label>
                        <br/>
                        <input type="text" name="upload_url" id="upload_url" value="<?php echo osc_get_preference('upload_url', 'qrcode'); ?>"/>
                        <br/>
                        <label for="code_size"><?php _e('Code size (from 1 to 10)', 'qrcode'); ?></label>
                        <br/>
                        <input type="text" name="code_size" id="code_size" value="<?php echo osc_get_preference('code_size', 'qrcode'); ?>"/>
                        <br/>
                        <span style="float:right;"><button type="submit" style="float: right;"><?php _e('Update', 'qrcode');?></button></span>
                    </div>
                    <br/>
                    <div style="clear:both;"></div>
                </form>
            </fieldset>
        </div>
        <div style="clear: both;"></div>										
    </div>
</div>
