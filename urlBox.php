<?php
/*
Template Name: 网址收纳箱
*/
?>
<?php get_header(); ?>
<style>
	#footer{ position: fixed; bottom: 0; }
</style>
<style>
	.page-url{ padding: 50px 0; }
	.urlCon{ width: 300px; background: #fff; float: right; border:1px solid #ccc; padding: 15px; border-radius: 5px; }
	.urlBox{ margin-right: 360px; background: #fff; border:1px solid #ccc; border-radius: 5px; }
	.webUrlBox{ width: 100px; background: #eee; padding: 10px 0; position: relative; }
	.webUrlBox .blogroll{ display: none; position: absolute; left: 130px; top: 10px; width: 490px; }
	.webUrlBox .blogroll li{ float: left; line-height: 40px; margin-right: 20px; font-size: 16px; white-space: nowrap; }
	.webUrlBox .linkcat h2{ line-height: 40px; text-align: center; font-size: 16px; cursor: pointer; color: #999; }
	.webUrlBox .linkcat h2:hover{ background: #f8f8f8; }
	.webUrlBox .linkcat h2.now{ background: #fff; color: #333; }
</style>
<div id="content"><div class="wrap"><div class="page-url">
	<div class="urlCon" >
		<?php while(have_posts()):the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
	<div class="urlBox">
		<ul class="webUrlBox" id="webUrlBox">
			<?php wp_list_bookmarks(); ?>
		</ul>
		<div class="cc"></div>
	</div>
	<div class="cc"></div>
</div></div></div>
<?php get_footer(); ?>
<script>
	$(function(){
		var $tag = $("#webUrlBox .linkcat h2");
		var $tab = $("#webUrlBox .linkcat .blogroll");
		$tag.eq(0).addClass('now');
		$tab.eq(0).show();
		$tag.on('click',function(){
			$tag.removeClass('now');
			$tab.hide();
			$(this).addClass('now').next('.blogroll').show();
		});
	});
</script>