<br>
<h2><?php _e('Youtube video', 'youtube'); ?></h2>
<div class="box">
    <div class="row">
        <?php printf( __( 'Youtubeのurlを入力してください。<br> 例: <em>%s</em> または <br> <em>%s</em>', 'youtube' ), 'http://www.youtube.com/watch?v=ojqWclLQOxk', 'http://www.youtube.com/v/ojqWclLQOxk') ; ?>
    </div>
<!--
    <div class="row" style="width: 500px; text-align:center">
-->
    <div class="row" style="text-align:center">
        <input type="text" name="s_youtube" value="<?php echo $detail['s_youtube'] ; ?>" />
    </div>
</div>
<br>
