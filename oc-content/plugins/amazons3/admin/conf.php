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
        osc_set_preference('bucket', Params::getParam('bucket'), 'amazons3', 'STRING');
        osc_set_preference('access_key', Params::getParam('access_key'), 'amazons3', 'STRING');
        osc_set_preference('secret_key', Params::getParam('secret_key'), 'amazons3', 'STRING');
        if(osc_version()<320) {
            echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Congratulations. The plugin is now configured', 'amazons3') . '.</p></div>' ;
            osc_reset_preferences();
        } else {
            // HACK : This will make possible use of the flash messages ;)
            ob_get_clean();
            osc_add_flash_ok_message(__('Congratulations, the plugin is now configured', 'amazons3'), 'admin');
            osc_redirect_to(osc_route_admin_url('amazons3-admin-conf'));
        }
    }
?>
<div id="settings_form" style="border: 1px solid #ccc; background: #eee; ">
    <div style="padding: 20px;">
        <div style="float: left; width: 100%;">
            <fieldset>
                <legend><?php _e('Amazon S3 Settings', 'amazons3'); ?></legend>
                <form name="amazons3_form" id="amazons3_form" action="<?php echo osc_admin_base_url(true); ?>" method="post" enctype="multipart/form-data" >
                    <div style="float: left; width: 100%;">
                    <input type="hidden" name="page" value="plugins" />
                    <input type="hidden" name="action" value="renderplugin" />
                    <?php if(osc_version()<320) { ?>
                        <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>conf.php" />
                    <?php } else { ?>
                        <input type="hidden" name="route" value="amazons3-admin-conf" />
                    <?php }; ?>
                    <input type="hidden" name="plugin_action" value="done" />
                        <label for="bucket"><?php _e('Name of the bucket (it should be a worldwide-unique name)', 'amazons3'); ?></label>
                        <br/>
                        <input type="text" name="bucket" id="bucket" value="<?php echo osc_get_preference('bucket', 'amazons3'); ?>"/>
                        <br/>
                        <label for="access_key"><?php _e('Access key', 'amazons3'); ?></label>
                        <br/>
                        <input type="text" name="access_key" id="access_key" value="<?php echo osc_get_preference('access_key', 'amazons3'); ?>"/>
                        <br/>
                        <label for="secret_key"><?php _e('Secret key', 'amazons3'); ?></label>
                        <br/>
                        <input type="text" name="secret_key" id="secret_key" value="<?php echo osc_get_preference('secret_key', 'amazons3'); ?>"/>
                        <br/>
                        <?php printf(__("You need an Amazon S3 account. More information on %s",'amazons3k'), '<a href="http://aws.amazon.com/s3/">http://aws.amazon.com/s3/</a>'); ?>
                        <br/>
                        <span style="float:right;"><button type="submit" style="float: right;"><?php _e('Update', 'amazons3');?></button></span>
                    </div>
                    <br/>
                    <div style="clear:both;"></div>
                </form>
            </fieldset>
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
