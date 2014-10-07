<?php
/*
 Template Name: 碎语
*/
?>
<?php get_header(); ?>
<div id="content"><div class="wrap">
	<div id="single">
		<div class="part1">
		<?php query_posts("post_type=talk&post_status=publish&posts_per_page=-1");if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="talklist">
	  			<span class="talkcontent">
  			<?php the_content(); ?>
  			</span><span>
  			<p class="talktime">
  			<?php the_time('Y年n月j日G:H'); ?>
  			</p>
  			</span>
  		</div>
		<?php endwhile;endif; ?>
  		<?php wp_reset_query(); ?>
			<div class="single-copyright">
				<div class="cc"></div>
			</div>
		</div>
		<!-- 评论 -->
		<div class="part"><?php comments_template(); ?></div>
	</div>
	<?php get_sidebar(); ?>
	<div class="cc"></div>
</div></div>
<?php get_footer(); ?>