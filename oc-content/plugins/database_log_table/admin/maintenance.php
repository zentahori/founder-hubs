<?php if (!defined('OC_ADMIN') || OC_ADMIN!==true) exit('Access is not allowed.');

	// MANUAL CLEANUP
	if(Params::getParam('plugin_action') == 'database_log_table_manual') {
		if(Params::getParam('database_log_table_manual_cleanup_selected_value') == '1') {
			// truncate internal log table
			$DAO = new DAO;
			$sql = sprintf("TRUNCATE TABLE %st_log", DB_TABLE_PREFIX);
			$DAO->dao->query($sql);

			// flash message
			osc_add_flash_ok_message(__('Database Log Table Maintenance Completed', 'database_log_table'), 'admin');

			// redirect prevents form re-submit on page reload/refresh
			header('Location: ' . osc_admin_render_plugin_url('database_log_table/admin/maintenance.php'));

			// clear array
			osc_reset_preferences();
		}
	}

	// AUTO CRON CLEANUP
	if(Params::getParam('plugin_action') == 'database_log_table_autocron') {
		$autocron = Params::getParam('database_log_table_autocron_selected_value');
		if($autocron != 'disabled') {
			$nextcron = time() + ($autocron * 60 * 60 * 24 * 30);
			osc_set_preference('autocron', $autocron, 'database-log-table', 'STRING');
			osc_set_preference('nextcron', $nextcron, 'database-log-table', 'INTEGER');
		} else {
			osc_set_preference('autocron', 'disabled', 'database-log-table', 'STRING');
			osc_set_preference('nextcron', '', 'database-log-table', 'INTEGER');
		}

		// flash message
		osc_add_flash_ok_message(__('Settings updated.', 'database_log_table'), 'admin');

		// redirect prevents form re-submit on page reload/refresh
		header('Location: ' . osc_admin_render_plugin_url('database_log_table/admin/maintenance.php'));

		// clear array
		osc_reset_preferences();
	}

?>

<div id="settings_form" style="border:1px solid #ccc; background:#eee;">
	<div style="padding:20px;">

		<h2><?php _e('Database Log Table Maintenance', 'database_log_table');?></h2>
		<p style="display:block; max-width:400px; color:#F00; font-weight:700; background-color:#FDD; padding:10px; text-align:center;"><?php _e('WARNING: This will empty entire log from database! Create t_log table backup first in case you need it.', 'database_log_table'); ?></p>

	<br/><hr/><br/>

		<form name="database_log_table_manual_form" id="database_log_table_manual_form" action="<?php osc_admin_base_url(true); ?>" method="post" enctype="multipart/form-data">

			<input type="hidden" name="page" value="plugins"/>
			<input type="hidden" name="action" value="renderplugin"/>
			<input type="hidden" name="file" value="database_log_table/admin/maintenance.php"/>
			<input type="hidden" name="plugin_action" value="database_log_table_manual"/>

			<div class="row">
				<label style="display:inline-block; min-width:125px; vertical-align:9px; font-weight:700; color:#F00;"><?php _e('Manual Log CleanUp', 'database_log_table'); ?></label>
				<select name="database_log_table_manual_cleanup_selected_value" id="database_log_table_manual_cleanup_selected_value">
					<option value="" selected><?php _e('Select', 'database_log_table'); ?></option>
					<option value="0"><?php _e('NO', 'database_log_table'); ?></option>
					<option value="1"><?php _e('YES', 'database_log_table'); ?></option>
				</select>
				<br/>
			</div>
			<br/>
			<div>
				<button type="submit" class="btn btn-submit"><?php _e('DELETE', 'database_log_table');?></button>
			</div>
		</form>

	<br/><hr/><br/>

		<form name="database_log_table_autocron_form" id="database_log_table_autocron_form" action="<?php osc_admin_base_url(true); ?>" method="post" enctype="multipart/form-data">

			<input type="hidden" name="page" value="plugins"/>
			<input type="hidden" name="action" value="renderplugin"/>
			<input type="hidden" name="file" value="database_log_table/admin/maintenance.php"/>
			<input type="hidden" name="plugin_action" value="database_log_table_autocron"/>

			<div class="row">
				<label style="display:inline-block; min-width:125px; vertical-align:9px; font-weight:700; color:#F00;"><?php _e('Auto Cron CleanUp', 'database_log_table'); ?></label>
				<select name="database_log_table_autocron_selected_value" id="database_log_table_autocron_selected_value">
					<option value="disabled" <?php if(osc_get_preference('autocron', 'database-log-table') == 'disabled') { echo 'selected'; } ?>><?php _e('Disabled', 'database_log_table'); ?></option>
					<option value="1" <?php if(osc_get_preference('autocron', 'database-log-table') == '1') { echo 'selected'; } ?>><?php _e('Clear Logs Every 1 month', 'database_log_table'); ?></option>
					<option value="2" <?php if(osc_get_preference('autocron', 'database-log-table') == '2') { echo 'selected'; } ?>><?php _e('Clear Logs Every 2 months', 'database_log_table'); ?></option>
					<option value="3" <?php if(osc_get_preference('autocron', 'database-log-table') == '3') { echo 'selected'; } ?>><?php _e('Clear Logs Every 3 months', 'database_log_table'); ?></option>
					<option value="6" <?php if(osc_get_preference('autocron', 'database-log-table') == '6') { echo 'selected'; } ?>><?php _e('Clear Logs Every 6 months', 'database_log_table'); ?></option>
					<option value="12" <?php if(osc_get_preference('autocron', 'database-log-table') == '12') { echo 'selected'; } ?>><?php _e('Clear Logs Every 12 months', 'database_log_table'); ?></option>
					<option value="24" <?php if(osc_get_preference('autocron', 'database-log-table') == '24') { echo 'selected'; } ?>><?php _e('Clear Logs Every 24 months', 'database_log_table'); ?></option>
					<option value="36" <?php if(osc_get_preference('autocron', 'database-log-table') == '36') { echo 'selected'; } ?>><?php _e('Clear Logs Every 36 months', 'database_log_table'); ?></option>
				</select>
				<br/>
			</div>
			<br/>
			<div>
				<button type="submit" class="btn btn-submit"><?php _e('UPDATE', 'database_log_table');?></button>
			</div>
			<br/>
		</form>

	<!-- CRON INFO -->
	<?php if(osc_get_preference('autocron', 'database-log-table') != 'disabled') { ?>
	<hr/><br/>
	<div style="display:inline-block; font-weight:700; padding:10px 3px; border-radius:4px; background-color:#F7F7F7;">
		<?php echo __('Scheduled CleanUp', 'database_log_table') . ': ' . '<span style="color:#F40;">' . date(osc_date_format(), osc_get_preference('nextcron', 'database-log-table')) . ' @ ' . date(osc_time_format(), osc_get_preference('nextcron', 'database-log-table')) . '</span>'; ?>
	</div>
	<div style="display:inline-block; font-weight:700; padding:10px 3px; border-radius:4px; background-color:#F7F7F7;">
		<?php
			$cron = Cron::newInstance()->getCronByType('DAILY');
			if( is_array($cron) ) {
				$i_next = strtotime($cron['d_next_exec']);
			}
		?>
		<?php echo __('Next Daily Cron', 'database_log_table') . ': ' . '<span style="color:#F40;">' . date(osc_date_format(), $i_next) . ' @ ' . date(osc_time_format(), $i_next) . '</span>'; ?>
	</div>
	<br/>
	<?php } ?>

	<br/><hr/><br/>

	<!-- HELP -->
	<div style="display:inline-block; background-color:#FFF; padding:20px; border:1px solid #CCC; border-radius:10px;">
		<h2>Database Log Table</h2>
		<p>Plugin performs manual and/or automatic cleanup and maintenance of internal <strong>t_log</strong> table inside Osclass database, preventing it to get too large and affect performance.</p>
		<p><strong>Manual cleanup mode:</strong> For security reasons you need to select YES option and press DELETE button in order to perform table purge, can be used at any time desired.</p>
		<p><strong>Auto Cron cleanup mode:</strong> Select prefered cleanup interval and save settings. Please note that actual cleanup is performed at daily cron job times once the Scheduled CleanUp time is reached, which is provided for reference only. In case you use built-in cron and no visitors are present at the scheduled + daily cron time, both events will be missed, and cron will run next time a user or bot visits your website. For higher accuracy external cron is highly recommended.</p>
		<p><strong>Table Data Backup:</strong> After t_log table cleanup procedure is performed, permanent loss of data will occur. Create t_log table and/or complete database backup in case you need logs for later use.</p>
	</div>

	</div>
</div>