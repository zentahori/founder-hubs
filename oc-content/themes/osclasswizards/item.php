<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2014 OSCLASS
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

    // meta tag robots
    if( osc_item_is_spam() || osc_premium_is_spam() ) {
        osc_add_hook('header','osclasswizards_nofollow_construct');
    } else {
        osc_add_hook('header','osclasswizards_follow_construct');
    }

    osc_enqueue_script('fancybox');
    osc_enqueue_style('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.css'));
    osc_enqueue_script('jquery-validate');

    osclasswizards_add_body_class('item');
	
	
    //osc_add_hook('after-main','sidebar');
	
	if(osclasswizards_show_as() == 'gallery'){
        $loop_template	=	'loop-search-grid.php';
		$buttonClass = 'active';
    }else{
		$loop_template	=	'loop-search-list.php';
		$buttonClass = '';
	}
	
    function sidebar(){
        osc_current_web_theme_path('item-sidebar.php');
    }

    $location = array();
    if( osc_item_city_area() !== '' ) {
        $location[] = osc_item_city_area();
    }
    if( osc_item_city() !== '' ) {
        $location[] = osc_item_city();
    }
    if( osc_item_region() !== '' ) {
        $location[] = osc_item_region();
    }
    if( osc_item_country() !== '' ) {
        $location[] = osc_item_country();
    }
	

    osc_current_web_theme_path('header.php');
	
	?>

<div class="row">
  <div class="col-sm-7 col-md-8">
    <div id="item-content">
      <?php if(osc_is_web_user_logged_in() && osc_logged_user_id()==osc_item_user_id()) { ?>
      <p id="edit_item_view"> <strong> <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow">
        <?php _e('Edit item', OSCLASSWIZARDS_THEME_FOLDER); ?>
        </a> </strong> </p>
      <?php } ?>

      <h1 class="title title_code"> <strong><?php echo osc_item_title(); ?></strong> </h1>
      <ul class="item-header">
        <!-- Added category -->
        <table>
        <tr>
        <li>
          <?php if ( osc_item_category() !== '' ) { ?>
          <td>
            <strong><?php _e('Category', 'osclasswizards');?>:</strong>
            <?php osc_item_category(); ?>
          </td>
          <?php } ?>
        </li>
        </tr>
        <tr>
        <li>
          <?php if( osc_price_enabled_at_items() ) { ?>
          <td>
            <strong><?php _e('Price', 'osclasswizards');?>:</strong>
            <?php echo osc_item_formated_price(); ?>
          </td>
<!--          <i class="fa fa-money"></i><?php echo osc_item_formated_price(); ?>  -->
          <?php } ?>
        </li>
        </tr>
        <tr>
        <li>
          <td>
            <?php if ( osc_item_pub_date() !== '' ) { printf( __('<strong>Published date</strong>: %1$s', 'osclasswizards'), osc_format_date( osc_item_pub_date() ) ); } ?>
          </td>
<!--          <?php if ( osc_item_pub_date() !== '' ) { printf( __('<i class="fa fa-calendar-o"></i> Published date: %2$s', 'osclasswizards'), osc_format_date( osc_item_pub_date() ) ); } ?>  -->
        </li>
        </tr>
        <tr>
        <li>
          <td>
            <?php if ( osc_item_mod_date() !== '' ) { printf( __('<strong class="update">Modified date:</strong> %1$s', 'osclasswizards'), osc_format_date( osc_item_mod_date() ) ); } ?>
<!--          <?php if ( osc_item_mod_date() !== '' ) { printf( __('<span class="update"><i class="fa fa-calendar"></i> Modified date:</span> %2$s', OSCLASSWIZARDS_THEME_FOLDER), osc_format_date( osc_item_mod_date() ) ); } ?> -->
          </td>
        </li>
        </tr>
        <?php if (count($location)>0) { ?>
        <tr>
        <li>
          <td>
          <ul id="item_location">
            <li>
              <strong><?php _e("Location", "osclasswizards"); ?>:
              </strong> <?php echo implode(', ', $location); ?>
            </li>
<!--            <li><i class="fa fa-map-marker"></i> <?php echo implode(', ', $location); ?></li>  -->
          <?php }; ?>
          </ul>
          </td>
        </li>
        </tr>
        <tr>
        <li>
          <td>
            <strong><?php _e("Contacts", OSCLASSWIZARDS_THEME_FOLDER);?>:</strong>
              <?php echo cc_contacts_by_listing( osc_item_id() ); ?>
          </td>
        </li>
        </tr>
        <tr>
        <li>
          <td>
          <?php if (cc_contacts_by_listing(osc_item_id()) > 0) { ?>
            <strong><?php _e('Status', 'osclasswizards');?>:</strong> 
              <?php _e('In progress', 'osclasswizards');?>
          <?php } else { ?>
            <strong><?php _e('Status', 'osclasswizards');?>:</strong> 
              <font color=red><?php _e('Waiting', 'osclasswizards');?></font>
          <?php } ?>
          </td>
        </li>
        </tr>
        </table>
        <!-- Items End -->
      </ul>
	    <?php if( osc_images_enabled_at_items() ) { ?>
		<div class="item-photos">
		<div class="row">
        <?php
        if( osc_count_item_resources() > 0 ) {
            $i = 0;
        ?>
          <div class="col-md-10"> <a href="<?php echo osc_resource_url(); ?>" class="main-photo" title="<?php _e('Image', OSCLASSWIZARDS_THEME_FOLDER); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>"> <img class="img-responsive" src="<?php echo osc_resource_url(); ?>" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" /> </a></div>
<!-- //Thumb nails are off
          <div class="col-md-2">
            <div class="thumbs">
              <?php for ( $i = 0; osc_has_item_resources(); $i++ ) { ?>
              <a href="<?php echo osc_resource_url(); ?>" class="fancybox" data-fancybox-group="group" title="<?php _e('Image', OSCLASSWIZARDS_THEME_FOLDER); ?> <?php echo $i+1;?> / <?php echo osc_count_item_resources();?>"> <img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" class="img-responsive"/> </a>
              <?php } ?>
            </div>
          </div>
-->
		<?php } else{?>
          <div class="col-md-10"> <a href="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" class="main-photo" title="<?php _e('Image', OSCLASSWIZARDS_THEME_FOLDER); ?> 1 / 1"> <img class="img-responsive" src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" /> </a></div>
<!-- //Thumb nails are off
	  <div class="col-md-2">
            <div class="thumbs">
              <a href="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" class="fancybox" data-fancybox-group="group" title="<?php _e('Image', OSCLASSWIZARDS_THEME_FOLDER); ?> 1 / 1"> <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" width="75" alt="<?php echo osc_item_title(); ?>" title="<?php echo osc_item_title(); ?>" class="img-responsive"/> </a>
	    </div>
          </div>
-->
		<?php } ?>
	  </div>
      </div>
      <?php } ?>
      <ul>
        <li>
          <strong>
            <?php _e("Description", "osclasswizards"); ?>:
          </strong>
        </li>
      </ul>
      <div id="description">
        <p style="background-color: #ffffff"><?php echo osc_item_description(); ?></p>
<!--        <p><?php echo osc_item_description(); ?></p>  -->
        <div id="custom_fields">
          <?php if( osc_count_item_meta() >= 1 ) { ?>
          <br />
          <div class="meta_list">
            <?php while ( osc_has_item_meta() ) { ?>
            <?php if(osc_item_meta_value()!='') { ?>
            <div class="meta"> <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?> </div>
            <?php } ?>
            <?php } ?>
          </div>
          <?php } ?>
        </div>
        
        <?php osc_run_hook('item_detail', osc_item() ); ?>
        <ul class="contact_button">
          <li>
            <?php if( !osc_item_is_expired () ) { ?>
            <?php if( !( ( osc_logged_user_id() == osc_item_user_id() ) && osc_logged_user_id() != 0 ) ) { ?>
            <?php     if(osc_reg_user_can_contact() && osc_is_web_user_logged_in() || !osc_reg_user_can_contact() ) { ?>
            <a href="#contact">
            <?php _e('Contact seller', OSCLASSWIZARDS_THEME_FOLDER); ?>
            </a>
            <?php     } ?>
            <?php     } ?>
            <?php } ?>
          </li>
          <li><a href="<?php echo osc_item_send_friend_url(); ?>" rel="nofollow">
            <?php _e('Share', OSCLASSWIZARDS_THEME_FOLDER); ?>
            </a></li>
          <?php if(function_exists('watchlist')) {?>
          <li>
            <?php watchlist(); ?>
          </li>
          <?php } ?>
        </ul>
        <?php osc_run_hook('location'); ?>
      </div>
    </div>
    <?php if( osc_comments_enabled() ) { ?>
    <?php if( osc_reg_user_post_comments () && osc_is_web_user_logged_in() || !osc_reg_user_post_comments() ) { ?>
    <div id="comments">
      <?php if( osc_count_item_comments() >= 1 ) { ?>
      <h2 class="title">
        <?php _e('Comments', OSCLASSWIZARDS_THEME_FOLDER); ?>
      </h2>
      <?php }
	  
	  ?>
      <ul id="comment_error_list">
      </ul>
      <?php CommentForm::js_validation(); ?>
      <?php if( osc_count_item_comments() >= 1 ) { ?>
      <div class="comments_list">
        <?php while ( osc_has_item_comments() ) { ?>
        <div class="comment">
          <h4><?php echo osc_comment_title(); ?> <em>
            <?php _e("by", OSCLASSWIZARDS_THEME_FOLDER); ?>
            <?php echo osc_comment_author_name(); ?>:</em></h4>
          <p><?php echo nl2br( osc_comment_body() ); ?> </p>
          <?php if ( osc_comment_user_id() && (osc_comment_user_id() == osc_logged_user_id()) ) { ?>
          <p> <a rel="nofollow" href="<?php echo osc_delete_comment_url(); ?>" title="<?php _e('Delete your comment', OSCLASSWIZARDS_THEME_FOLDER); ?>">
            <?php _e('Delete', OSCLASSWIZARDS_THEME_FOLDER); ?>
            </a> </p>
          <?php } ?>
        </div>
        <?php } ?>
        <div class="pagination"> <?php echo osc_comments_pagination(); ?> </div>
      </div>
      <?php } ?>
      <div class="comment_form">
        <div class="title">
          <h1>
            <?php _e('Leave your comment (spam and offensive messages will be removed)', OSCLASSWIZARDS_THEME_FOLDER); ?>
          </h1>
        </div>
        <div class="resp-wrapper">
          <form action="<?php echo osc_base_url(true); ?>" method="post" name="comment_form" id="comment_form">
            <fieldset>
              <input type="hidden" name="action" value="add_comment" />
              <input type="hidden" name="page" value="item" />
              <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
              <?php if(osc_is_web_user_logged_in()) { ?>
              <input type="hidden" name="authorName" value="<?php echo osc_esc_html( osc_logged_user_name() ); ?>" />
              <input type="hidden" name="authorEmail" value="<?php echo osc_logged_user_email();?>" />
              <?php } else { ?>
              <div class="form-group">
                <label class="control-label" for="authorName">
                  <?php _e('Your name', OSCLASSWIZARDS_THEME_FOLDER); ?>
                </label>
                <div class="controls">
                  <?php CommentForm::author_input_text(); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="authorEmail">
                  <?php _e('Your e-mail', OSCLASSWIZARDS_THEME_FOLDER); ?>
                </label>
                <div class="controls">
                  <?php CommentForm::email_input_text(); ?>
                </div>
              </div>
              <?php }; ?>
              <div class="form-group">
                <label class="control-label" for="title">
                  <?php _e('Title', OSCLASSWIZARDS_THEME_FOLDER); ?>
                </label>
                <div class="controls">
                  <?php CommentForm::title_input_text(); ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="body">
                  <?php _e('Comment', OSCLASSWIZARDS_THEME_FOLDER); ?>
                </label>
                <div class="controls textarea">
                  <?php CommentForm::body_input_textarea(); ?>
                </div>
              </div>
              <div class="actions">
                <button type="submit" class="btn btn-success">
                <?php _e('Send', OSCLASSWIZARDS_THEME_FOLDER); ?>
                </button>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
  <div class="col-sm-5 col-md-4">
    <?php
			if(function_exists('show_qrcode')){
				echo '<div class="block_list block_listed">';
				show_qrcode();
				
								echo ' </div>';
 
			}
		?>
    <div class="alert_block">
      <?php if(!osc_is_web_user_logged_in() || osc_logged_user_id()!=osc_item_user_id()) { ?>
      <form action="<?php echo osc_base_url(true); ?>" method="post" name="mask_as_form" id="mask_as_form">
        <input type="hidden" name="id" value="<?php echo osc_item_id(); ?>" />
        <input type="hidden" name="as" value="spam" />
        <input type="hidden" name="action" value="mark" />
        <input type="hidden" name="page" value="item" />
        <select name="as" id="as" class="mark_as">
          <option>
          <?php _e("Mark as...", OSCLASSWIZARDS_THEME_FOLDER); ?>
          </option>
          <option value="spam">
          <?php _e("Mark as spam", OSCLASSWIZARDS_THEME_FOLDER); ?>
          </option>
          <option value="badcat">
          <?php _e("Mark as misclassified", OSCLASSWIZARDS_THEME_FOLDER); ?>
          </option>
          <option value="repeated">
          <?php _e("Mark as duplicated", OSCLASSWIZARDS_THEME_FOLDER); ?>
          </option>
          <option value="expired">
          <?php _e("Mark as expired", OSCLASSWIZARDS_THEME_FOLDER); ?>
          </option>
          <option value="offensive">
          <?php _e("Mark as offensive", OSCLASSWIZARDS_THEME_FOLDER); ?>
          </option>
        </select>
      </form>
      <?php } ?>
    </div>
    <?php osc_current_web_theme_path('item-sidebar.php'); ?>
    <div class="block_list">
      <div id="useful_info">
        <h1 class="title">
          <?php _e('Useful information', OSCLASSWIZARDS_THEME_FOLDER); ?>
        </h1>
        <ul>
          <li>
            <?php _e('Avoid scams by acting locally or paying with PayPal', OSCLASSWIZARDS_THEME_FOLDER); ?>
          </li>
          <li>
            <?php _e('Never pay with Western Union, Moneygram or other anonymous payment services', OSCLASSWIZARDS_THEME_FOLDER); ?>
          </li>
          <li>
            <?php _e('Don\'t buy or sell outside of your country. Don\'t accept cashier cheques from outside your country', OSCLASSWIZARDS_THEME_FOLDER); ?>
          </li>
          <li>
            <?php _e('This site is never involved in any transaction, and does not handle payments, shipping, guarantee transactions, provide escrow services, or offer "buyer protection" or "seller certification"', OSCLASSWIZARDS_THEME_FOLDER); ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php related_listings(); ?>
<?php if( osc_count_items() > 0 ) { ?>
<div class="similar_ads">
  <h2 class="title">
    <?php _e('Related listings', OSCLASSWIZARDS_THEME_FOLDER); ?>
  </h2>
  <?php
		View::newInstance()->_exportVariableToView("listType", 'items');
		osc_current_web_theme_path($loop_template);
    ?>
</div>
<?php } ?>
<?php osc_current_web_theme_path('footer.php') ; ?>
