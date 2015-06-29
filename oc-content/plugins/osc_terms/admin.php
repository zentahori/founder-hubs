<?php

    $state            = '';
    $dao_preference = new Preference();
    if(Params::getParam('state') != '') {
        $state = Params::getParam('state');
    } else {
        $state = (osc_state() != '') ? osc_state() : '' ;
    }
    $country            = '';
    $dao_preference = new Preference();
    if(Params::getParam('country') != '') {
        $country = Params::getParam('country');
    } else {
        $country = (osc_country() != '') ? osc_country() : '' ;
    }
    
    if( Params::getParam('option') == 'stepone' ) {
        $dao_preference->update(array("s_value" => $state), array("s_section" => "plugin-tac", "s_name" => "tac_state")) ;
        $dao_preference->update(array("s_value" => $country), array("s_section" => "plugin-tac", "s_name" => "tac_country")) ;
        $words = array();
        $words[] = array('{WEB_TITLE}', '{C_WEB_TITLE}', '{STATE}', '{COUNTRY}' , '{SITE_EMAIL}');
        $words[] = array(osc_page_title(), strtoupper(osc_page_title()), $state, $country, osc_contact_email());
        $terms_con = osc_mailBeauty(osc_terms(), $words);
        $conn = getConnection();
        $page_id = $conn->osc_dbFetchResult("SELECT * FROM %st_pages WHERE s_internal_name = 'terms_conditions'", DB_TABLE_PREFIX);
        $conn->osc_dbExec("UPDATE %st_pages_description SET s_text = '%s' WHERE fk_i_pages_id = '%d'", DB_TABLE_PREFIX, $terms_con ,$page_id['pk_i_id']);
		  
        echo '<div style="text-align:center; font-size:22px; background-color:#00bb00;"><p>' . __('Settings Saved', 'osc_terms') . '.</p></div>';
    }
    unset($dao_preference) ;
    
?>

<form action="<?php osc_admin_base_url(true); ?>" method="post">
    <input type="hidden" name="page" value="plugins" />
    <input type="hidden" name="action" value="renderplugin" />
    <input type="hidden" name="file" value="osc_terms/admin.php" />
    <input type="hidden" name="option" value="stepone" />
    <div>
    <fieldset>
        <h2><?php _e('OSC Terms Preferences', 'osc_terms'); ?></h2> <label for="state" style="font-weight: bold;"><?php _e('Enter your State', 'osc_terms'); ?></label>:<br />
        <input type="text" name="state" id="state" value="<?php echo $state; ?>" />
        <br />
        <br />
        <label for="country" style="font-weight: bold;"><?php _e('Enter your Country', 'osc_terms'); ?></label>:<br />
        <input type="text" name="country" id="country" value="<?php echo $country; ?>" />
        <br />
        <br />
        <p><?php _e('* Note if you have edited the terms and conditions and then edit your state and or country','osc_terms');?> 
        <br /><?php _e('your changes to the terms will be lost.','osc_terms'); ?></p>
        <input type="submit" value="<?php _e('Save', 'osc_terms'); ?>" />
     </fieldset>
    </div>
</form>
