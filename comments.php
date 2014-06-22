<?php if ( post_password_required() ) : ?>
<?php _e( 'Enter your password to view comments.' ); ?>
<?php return; endif; ?>
<div id="comments">
<div class="comt">
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">	
    	    	<?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
    		</div>
		<?php endif; ?>
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p><?php _e( 'Comments are closed.' ); ?></p>
	<?php endif; ?>
	<?php
$adsub;
$args =  array(
'comment_field'=> '<p class="comment-form-comment">
<div class="adcomsub">'.$adsub.'</div>
<div class="comment_textarea"><textarea id="comment" name="comment" cols="45" rows="8"></textarea></div></p>',
'label_submit'=> '确 认 提 交',
);
comment_form($args);
?>
</div>
</div>