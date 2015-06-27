<?php
/*
  Plugin Name: Contact counter
  Plugin URI: garciademarina.com/contact-counter-osclass-plugin
  Description: This plugin counts listing contacts
  Version: 1.0.0
  Author: garciademarina
  Short Name: contact_counter
  Author URI:
  Plugin update URI: contact-counter
 */

require_once 'ModelContactCounter.php';
require_once 'StatsContactCounter.php';

//Delete item
osc_add_hook('before_delete_item', 'contact_counter_delete');
function contact_counter_delete($item) {
    ModelContactCounter::newInstance()->deleteItemStat($item) ;
}

osc_add_hook('posted_item', 'contact_counter_insert');
function contact_counter_insert($item) {
    ModelContactCounter::newInstance()->insertItemStat($item['pk_i_id']) ;
}

osc_add_hook('hook_email_item_inquiry', 'contact_counter_increase');
function contact_counter_increase($item) {
    ModelContactCounter::newInstance()->increaseItemStat($item['id']) ;
}

osc_register_plugin(osc_plugin_path(__FILE__), 'contact_counter_install');
function contact_counter_install() {
    // create table structure
    ModelContactCounter::newInstance()->import("contact_counter/struct.sql") ;

    // initialize stats
    ModelContactCounter::newInstance()->init() ;

}

osc_add_hook(osc_plugin_path(__FILE__) . "_uninstall", 'contact_counter_uninstall');
function contact_counter_uninstall() {
    // remove table structure
    ModelContactCounter::newInstance()->uninstall();
}

// add link to item contact stats page / manage listing, under more actions link
function contact_counter_more_actions_link( $options_more, $aRow) {
    // get number of contact by listing
    $num_contacts = ModelContactCounter::newInstance()->getTotalContactsByItemId($aRow['pk_i_id']);
    $aux = $options_more;
    $aux[] = '<a href="' . osc_route_admin_url('stats-contact-counter', array('id' => $aRow['pk_i_id'])) . '">' . sprintf(__('<b>%s</b> contacts +'),$num_contacts) . '</a>';
    return $aux;
}
osc_add_hook('actions_manage_items', 'contact_counter_more_actions_link');

// admin menu
function contact_counter_admin_menu() {
    if (osc_version() < 320) {
        echo '<h3><a href="#">'.__('Contact counter', 'contact_counter').'</a></h3>
            <ul>
                <li><a href="' . osc_admin_configure_plugin_url("contact_counter/admin/stats.php") . '">&raquo; ' . __('Contact stats', 'contact_counter') . '</a></li>
                <li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'admin/help.php') . '">&raquo; ' . __('Help', 'contact_counter') . '</a></li>
            </ul>';
    } else {
        osc_add_admin_submenu_page('stats', __('View contact stats', 'contact_counter'), osc_route_admin_url('stats-contact-counter', array('id' => '')), '', 'administrator');
        osc_add_admin_submenu_divider('plugins', __('Contact counter', 'contact_counter'), 'contact_counter');
        osc_add_admin_submenu_page('plugins', __('Help', 'contact_counter'), osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'admin/help.php'),  'contact_counter_help', 'administrator');
    }
}

function feed_admin_menu() {
    echo '<h3><a href="#">Extra Feeds help</a></h3>
    <ul>
        <li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'conf.php') . '">&raquo; ' . __('Help', 'extra_feeds') . '</a></li>
    </ul>';
}

if(osc_version()<320) {
    osc_add_hook('admin_menu', 'contact_counter_admin_menu');
} else {
    osc_add_hook('admin_menu_init', 'contact_counter_admin_menu');
}

//  routes
osc_add_route('stats-contact-counter', 'stats-contact-counter/(.+)/([0-9]+)', 'stats-contact-counter/{type_stat}/{id}', osc_plugin_folder(__FILE__).'admin/stats.php');

// custom title/header stats page
if(Params::getParam('page') == 'plugins' && Params::getParam('file') == 'contact_counter/admin/stats.php' || Params::getParam('route') == 'stats-contact-counter') {
    osc_add_hook('admin_header',        'contact_counter_remove_title_header');
    osc_add_hook('admin_page_header',   'contact_counter_PageHeader_stats');
    osc_add_filter('admin_title',       'contact_counter_customPageTitle');
}

function contact_counter_remove_title_header() {
    osc_remove_hook('admin_page_header','customPageHeader');
}

function contact_counter_PageHeader_stats() { ?>
    <h1><?php _e('Contact stats', 'contact_counter'); ?>
        <a href="#" class="btn ico ico-32 ico-help float-right"></a>
    </h1>
<?php
}
function contact_counter_customPageTitle($string) {
    return sprintf(__('Contact Statistics &raquo; %s'), $string);
}


// helper functions

function cc_contacts_by_listing($itemId) {
    if($itemId!='' && is_numeric($itemId)) {
        return ModelContactCounter::newInstance()->getTotalContactsByItemId($itemId);
    }
    return 0;
}

function cc_contacts_by_user($userId) {
    if($userId!='' && is_numeric($userId)) {
        return ModelContactCounter::newInstance()->getTotalContactsByUser($userId);
    }
    return 0;
}

?>