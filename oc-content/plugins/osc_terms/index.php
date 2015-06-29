<?php
/*
Plugin Name: Terms and Conditions
Plugin URI: http://www.osclass.org/
Description: This Plugin adds a terms and conditions checkbox
Version: 1.0
Author: JChapman
Author URI: http://www.osclass.org/
Short Name: TaC
*/

function tac_install() {

   $conn = getConnection();
	$conn->autocommit(false);
		try {
        $conn->commit();
        osc_set_preference('tac_state', '', 'plugin-tac', 'STRING');
        osc_set_preference('tac_country', '', 'plugin-tac', 'STRING');
        osc_set_preference('tac_terms', '<div style="text-align: justify; font-family: Lucida sans;"><br /> Welcome to our online site! {WEB_TITLE} and its associates provide their  services to you subject to the following conditions. If you visit or  post ads within this website, you accept these conditions. Please read  them carefully. <br /><br />
<h2>PRIVACY</h2>
<p> </p>
Please review our Privacy Notice, which also governs your visit to our website, to understand our practices. <br /><br />
<h2>ELECTRONIC COMMUNICATIONS</h2>
<p> </p>
When you visit {WEB_TITLE} or send e-mails to us, you are communicating  with us electronically. You consent to receive communications from us  electronically. We will communicate with you by e-mail or by posting  notices on this site. You agree that all agreements, notices,  disclosures and other communications that we provide to you  electronically satisfy any legal requirement that such communications be  in writing. <br /><br />
<h2>COPYRIGHT</h2>
<p> </p>
All content included on this site, such as text, graphics, logos, button  icons, images, audio clips, digital downloads, data compilations, and  software, is the property of {WEB_TITLE} or its content suppliers and  protected by international copyright laws. The compilation of all  content on this site is the exclusive property of {WEB_TITLE}, with  copyright authorship for this collection by {WEB_TITLE}, and protected by  international copyright laws. <br /><br />
<h2>TRADE MARKS</h2>
<p> </p>
{WEB_TITLE}\'s trademarks and trade dress may not be used in connection with  any product or service that is not {WEB_TITLE}s, in any manner that is  likely to cause confusion among customers, or in any manner that  disparages or discredits {WEB_TITLE}. All other trademarks not owned by  {WEB_TITLE} or its subsidiaries that appear on this site are the property  of their respective owners, who may or may not be affiliated with,  connected to, or sponsored by {WEB_TITLE} or its subsidiaries. <br /><br />
<h2>LICENSE AND SITE ACCESS</h2>
<p> </p>
{WEB_TITLE} grants you a limited license to access and make personal use  of this site and not to download (other than page caching) or modify it,  or any portion of it, except with express written consent of {WEB_TITLE}.  This license does not include any resale or commercial use of this site  or its contents: any collection and use of any product listings,  descriptions, or prices: any derivative use of this site or its  contents: any downloading or copying of account information for the  benefit of another merchant: or any use of data mining, robots, or  similar data gathering and extraction tools. This site or any portion of  this site may not be reproduced, duplicated, copied, sold, resold,  visited, or otherwise exploited for any commercial purpose without  express written consent of {WEB_TITLE}. You may not frame or utilize  framing techniques to enclose any trademark, logo, or other proprietary  information (including images, text, page layout, or form) of {WEB_TITLE}  and our associates without express written consent. You may not use any  meta tags or any other "hidden text" utilizing {WEB_TITLE}s name or  trademarks without the express written consent of {WEB_TITLE}. Any  unauthorized use terminates the permission or license granted by  {WEB_TITLE}. You are granted a limited, revocable, and nonexclusive right  to create a hyperlink to the home page of {WEB_TITLE} so long as the link  does not portray {WEB_TITLE}, its associates, or their products or  services in a false, misleading, derogatory, or otherwise offensive  matter. You may not use any {WEB_TITLE} logo or other proprietary graphic  or trademark as part of the link without express written permission. <br /><br />
<h2>YOUR MEMBERSHIP ACCOUNT</h2>
<p> </p>
If you use this site, you are responsible for maintaining the  confidentiality of your account and password and for restricting access  to your computer, and you agree to accept responsibility for all  activities that occur under your account or password. If you are under  18, you may use our website only with involvement of a parent or  guardian. {WEB_TITLE} and its associates reserve the right to refuse  service, terminate accounts, remove or edit content, or cancel orders in  their sole discretion. <br /><br />
<h2>REVIEWS, COMMENTS, EMAILS, AND OTHER CONTENT</h2>
<p> </p>
Visitors may post reviews, comments, and other content: and submit  suggestions, ideas, comments, questions, or other information, so long  as the content is not illegal, obscene, threatening, defamatory,  invasive of privacy, infringing of intellectual property rights, or  otherwise injurious to third parties or objectionable and does not  consist of or contain software viruses, political campaigning,  commercial solicitation, chain letters, mass mailings, or any form of  "spam." You may not use a false e-mail address, impersonate any person  or entity, or otherwise mislead as to the origin of a card or other  content. {WEB_TITLE} reserves the right (but not the obligation) to remove  or edit such content, but does not regularly review posted content. If  you do post content or submit material, and unless we indicate  otherwise, you grant {WEB_TITLE} and its associates a nonexclusive,  royalty-free, perpetual, irrevocable, and fully sublicensable right to  use, reproduce, modify, adapt, publish, translate, create derivative  works from, distribute, and display such content throughout the world in  any media. You grant {WEB_TITLE} and its associates and sublicensees the  right to use the name that you submit in connection with such content,  if they choose. You represent and warrant that you own or otherwise  control all of the rights to the content that you post: that the content  is accurate: that use of the content you supply does not violate this  policy and will not cause injury to any person or entity: and that you  will indemnify {WEB_TITLE} or its associates for all claims resulting from  content you supply. {WEB_TITLE} has the right but not the obligation to  monitor and edit or remove any activity or content. {WEB_TITLE} takes no  responsibility and assumes no liability for any content posted by you or  any third party. <br /><br />
<h2>RISK OF LOSS</h2>
<p> </p>
All items purchased from {WEB_TITLE} are made pursuant to a shipment  contract. This basically means that the risk of loss and title for such  items pass to you upon our delivery to the carrier. <br /><br />
<h2>PRODUCT DESCRIPTIONS</h2>
<p> </p>
{WEB_TITLE} and its associates attempt to be as accurate as possible.  However, {WEB_TITLE} does not warrant that product descriptions or other  content of this site is accurate, complete, reliable, current, or  error-free. If a product offered by {WEB_TITLE} itself is not as  described, your sole remedy is to return it in unused condition. <br /><br /> DISCLAIMER OF WARRANTIES AND LIMITATION OF LIABILITY THIS SITE IS  PROVIDED BY {C_WEB_TITLE} ON AN "AS IS" AND "AS AVAILABLE" BASIS. {C_WEB_TITLE}  MAKES NO REPRESENTATIONS OR WARRANTIES OF ANY KIND, EXPRESS OR IMPLIED,  AS TO THE OPERATION OF THIS SITE OR THE INFORMATION, CONTENT, MATERIALS,  OR PRODUCTS INCLUDED ON THIS SITE. YOU EXPRESSLY AGREE THAT YOUR USE OF  THIS SITE IS AT YOUR SOLE RISK. TO THE FULL EXTENT PERMISSIBLE BY  APPLICABLE LAW, {C_WEB_TITLE} DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED,  INCLUDING, BUT NOT LIMITED TO, IMPLIED WARRANTIES OF MERCHANTABILITY AND  FITNESS FOR A PARTICULAR PURPOSE. {C_WEB_TITLE} DOES NOT WARRANT THAT THIS  SITE, ITS SERVERS, OR E-MAIL SENT FROM {C_WEB_TITLE} ARE FREE OF VIRUSES OR  OTHER HARMFUL COMPONENTS. {C_WEB_TITLE} WILL NOT BE LIABLE FOR ANY DAMAGES  OF ANY KIND ARISING FROM THE USE OF THIS SITE, INCLUDING, BUT NOT  LIMITED TO DIRECT, INDIRECT, INCIDENTAL, PUNITIVE, AND CONSEQUENTIAL  DAMAGES. CERTAIN STATE LAWS DO NOT ALLOW LIMITATIONS ON IMPLIED  WARRANTIES OR THE EXCLUSION OR LIMITATION OF CERTAIN DAMAGES. IF THESE  LAWS APPLY TO YOU, SOME OR ALL OF THE ABOVE DISCLAIMERS, EXCLUSIONS, OR  LIMITATIONS MAY NOT APPLY TO YOU, AND YOU MIGHT HAVE ADDITIONAL RIGHTS. <br /><br />
<h2>APPLICABLE LAW</h2>
<p> </p>
By visiting {WEB_TITLE}, you agree that the laws of the state of  {STATE}, {COUNTRY}, without regard to principles of conflict  of laws, will govern these Conditions of Use and any dispute of any sort  that might arise between you and {WEB_TITLE} or its associates. <br /><br />
<h2>DISPUTES</h2>
<p> </p>
Any dispute relating in any way to your visit to {WEB_TITLE} or to  products you purchase through {WEB_TITLE} shall be submitted to  confidential arbitration in {STATE}, {COUNTRY}, except that,  to the extent you have in any manner violated or threatened to violate  {WEB_TITLE}s intellectual property rights, {WEB_TITLE} may seek injunctive  or other appropriate relief in any state or federal court in the state  of {STATE}, {COUNTRY}, and you consent to exclusive  jurisdiction and venue in such courts. Arbitration under this agreement  shall be conducted under the rules then prevailing of the American  Arbitration Association. The arbitrators award shall be binding and may  be entered as a judgment in any court of competent jurisdiction. To the  fullest extent permitted by applicable law, no arbitration under this  Agreement shall be joined to an arbitration involving any other party  subject to this Agreement, whether through class arbitration proceedings  or otherwise. <br /><br />
<h2>SITE POLICIES, MODIFICATION, AND SEVERABILITY</h2>
<p> </p>
Please review our other policies, such as our Shipping and Returns  policy, posted on this site. These policies also govern your visit to  {WEB_TITLE}. We reserve the right to make changes to our site, policies,  and these Conditions of Use at any time. If any of these conditions  shall be deemed invalid, void, or for any reason unenforceable, that  condition shall be deemed severable and shall not affect the validity  and enforceability of any remaining condition. <br /><br />
<h2>QUESTIONS:</h2>
<p> </p>
Questions regarding our Conditions of Usage, Privacy Policy, or other  policy related material can be directed to our support staff by clicking  on the "Contact Us" link. Or you can email us at:  {SITE_EMAIL}</div>
', 'plugin-tac', 'STRING');
      } catch (Exception $e) {
        $conn->rollback();
         echo $e->getMessage();
      }

    $conn->osc_dbExec("INSERT INTO %st_pages (s_internal_name, b_indelible, dt_pub_date) VALUES ('terms_conditions', 0, NOW() )", DB_TABLE_PREFIX);
    $conn->osc_dbExec("INSERT INTO %st_pages_description (fk_i_pages_id, fk_c_locale_code, s_title, s_text) VALUES (%d, '%s', 'Terms and Conditions of Use', '')", DB_TABLE_PREFIX, $conn->get_last_id(), osc_language());

    $conn->autocommit(true);
}

function tac_uninstall() {

	$conn = getConnection() ;

   $page_id = $conn->osc_dbFetchResult("SELECT * FROM %st_pages WHERE s_internal_name = 'terms_conditions'", DB_TABLE_PREFIX);
   $conn->osc_dbExec("DELETE FROM %st_pages_description WHERE fk_i_pages_id = %d", DB_TABLE_PREFIX, $page_id['pk_i_id']);
   $conn->osc_dbExec("DELETE FROM %st_pages WHERE s_internal_name = 'terms_conditions'", DB_TABLE_PREFIX);


   $conn = getConnection();
	$conn->autocommit(false);
			try {
				osc_delete_preference('tac_state', 'plugin-tac');
				osc_delete_preference('tac_country', 'plugin-tac');
				osc_delete_preference('tac_terms', 'plugin-tac');
			}   catch (Exception $e) {
				$conn->rollback();
				echo $e->getMessage();
			}
			$conn->autocommit(true);

}

	// HELPER
function osc_state() {
	return(osc_get_preference('tac_state', 'plugin-tac')) ;
}
function osc_country() {
	return(osc_get_preference('tac_country', 'plugin-tac')) ;
}
function osc_terms() {
	return(osc_get_preference('tac_terms', 'plugin-tac'));
}

function tac_config() {

	osc_plugin_configure_view(osc_plugin_path(__FILE__));

}

function tac_admin_menu() {

	echo '<h3><a href="#">OSC Terms</a></h3><ul>';
   echo '<li class="" ><a href="' . osc_admin_render_plugin_url('osc_terms/admin.php') . '" > &raquo; '. __('Configure', 'osc_terms') . '</a></li>' .
        '<li class="" ><a href="' . osc_admin_render_plugin_url('osc_terms/help.php') . '" >&raquo; ' . __('F.A.Q. / Help', 'osc_terms') . '</a></li>';
   echo '</ul>';

}

function tac_form($catId = '') {

    // We received the categoryID
	//if($catId!="") {
		// We check if the category is the same as our plugin
		//if(osc_is_this_category('TaC', $catId)) {
			$conn = getConnection() ;
			$page_id = $conn->osc_dbFetchResult("SELECT * FROM %st_pages WHERE s_internal_name = 'terms_conditions'", DB_TABLE_PREFIX);
			require_once('form.php');
		//}
	//}
}

function tac_metadata_js() {
	if (osc_current_web_theme() == 'twitter_bootstrap'){
    ?>
    <script type="text/javascript" src="<?php echo osc_base_url() . 'oc-content/plugins/osc_terms/jquery.validate.min.js' ; ?>"></script>
    <?php } ?>
    <script type="text/javascript" src="<?php echo osc_base_url() . 'oc-content/plugins/osc_terms/jquery.metadata.js' ; ?>"></script>
    <?php
}

function tac_js() {
	?>
    <!-- osc_terms -->
    <script type="text/javascript">
        $(document).ready(function() {
	        if( $("form[name=register]").length > 0 ) {

           }
        }) ;
    </script>
    <!-- osc_terms end -->
	<?php
}

    // This is needed in order to be able to activate the plugin
    osc_register_plugin(osc_plugin_path(__FILE__), 'tac_install') ;
    // This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)
    osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'tac_uninstall') ;
	 // This is a hack to show a Configure link at plugins table (you could also use some other hook to show a custom option panel)
    osc_add_hook(osc_plugin_path(__FILE__) . '_configure', 'tac_config') ;

    // Add link in admin menu page
    osc_add_hook('admin_menu', 'tac_admin_menu') ;

    // When publishing an item we show an extra form with more attributes
    osc_add_hook('user_register_form', 'tac_form');

    osc_add_hook('header', 'tac_metadata_js');

    osc_add_hook('header', 'tac_js');


?>
