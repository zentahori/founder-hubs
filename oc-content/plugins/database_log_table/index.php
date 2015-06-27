<?php if(!defined('ABS_PATH')) exit();
/*
Plugin Name: Database Log Table
Plugin URI: http://www.osclass.org/
Description: Auto/Manual Internal Log Table Cleaner
Version: 1.0.0
Author: dev101
Author URI: 
Short Name: database-log-table
Plugin update URI: database-log-table
*/

function database_log_table_install() {
	osc_set_preference('autocron', 'disabled', 'database-log-table', 'STRING');
	osc_set_preference('nextcron', '', 'database-log-table', 'INTEGER');
}

function database_log_table_uninstall() {
	osc_delete_preference('autocron', 'database-log-table');
	osc_delete_preference('nextcron', 'database-log-table');
}

// AutoCron Cleanup
function database_log_table_autocron() {
	$currtime = time();
	$autocron = osc_get_preference('autocron', 'database-log-table');
	$nextcron = osc_get_preference('nextcron', 'database-log-table');
	if($autocron != 'disabled') {
		if ($currtime > $nextcron) {
			// calculate new next cron
			$newnextcron = $nextcron + ($autocron * 60 * 60 * 24 * 30);

			// set next cron
			osc_set_preference('nextcron', $newnextcron, 'database-log-table', 'INTEGER');

			// truncate internal log table
			$DAO = new DAO;
			$sql = sprintf("TRUNCATE TABLE %st_log", DB_TABLE_PREFIX);
			$DAO->dao->query($sql);
		}
	}
}
osc_add_hook('cron_daily', 'database_log_table_autocron');

// Admin
function database_log_table_admin_menu() {
	if(osc_version()<320) {
		echo '<h3><a href="#">DB Log Table</a></h3>
		<ul>
			<li><a href="' . osc_admin_render_plugin_url(osc_plugin_path(dirname(__FILE__)) . '/admin/maintenance.php') . '">&raquo; ' . __('Maintenance', 'database_log_table') . '</a></li>
		</ul>';
	} else {
		osc_add_admin_submenu_divider('plugins', 'DB Log Table', 'database_log_table_divider', 'administrator');
		osc_add_admin_submenu_page('plugins', '&raquo;' . ' ' . __('Maintenance', 'database_log_table'), osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'admin/maintenance.php'), 'database_log_table_maintenance', 'administrator');
	}
}

// Config
function database_log_table_config() {
	osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/admin/maintenance.php') ;
}

// Activate Plugin
osc_register_plugin(osc_plugin_path(__FILE__), 'database_log_table_install');

// Uninstall Plugin
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'database_log_table_uninstall') ;

// Admin Menu
if(osc_version()<320) {
	osc_add_hook('admin_menu', 'database_log_table_admin_menu');
} else {
	osc_add_hook('admin_menu_init', 'database_log_table_admin_menu');
}

// Configure Link
osc_add_hook(__FILE__ . '_configure', 'database_log_table_config');

?>