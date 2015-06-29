<div id="Layer1" style=" border:#FF0000; left: 2px; top: 2px; width: 310px; height: 60px; z-index: 1; ">
<h3><?php _e('Terms and Conditions','osc_terms') ; ?></h3>
<label><input type="checkbox" class="{required:true, messages:{required:'<?php _e('You have to agree to our terms and conditions before you can post an ad.','osc_terms'); ?>'}}" name="termsCon" id="termsCon" value="1" />
	 <a href="<?php echo osc_base_url(true) . '?page=page&id=' . $page_id['pk_i_id']; ?>" target="_blank"><?php _e('I Agree to the Terms and Conditions','osc_terms'); ?></a></label><br /><br />
	 <span for="termsCon" class="error" generated="true"> </span>
</div>

<script type="text/javascript">
    tabberAutomatic();
</script>
