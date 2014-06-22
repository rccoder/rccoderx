<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>
<style>
	.widget.blogroll ul{ overflow: hidden; zoom:1; padding: 10px; }
	.widget.blogroll li{ width: 130px; padding-right:20px; float: left; }
	.R-blogroll .widget{ padding: 0; border:1px solid #eee; }
	.R-blogroll .widget-con .blogroll{ width: 100%; }
	.R-blogroll .widget.blogroll li{ width: 33%; margin: 0; padding: 0; margin-bottom: 10px; }
	#single-con .R-blogroll .widget.blogroll li a{ margin: 0; }
</style>
<div id="content"><div class="wrap">
	<div id="single">
		<div class="part">
		<?php if(have_posts()):while(have_posts()):the_post(); ?>
			<h1 class="single-title"><?php the_title(); ?></h1>
			<!-- 文章信息 -->
			<div class="single-info">
				<span>作者：<?php the_author() ?></span>
				<span>时间：<?php the_time('Y-m-d') ?></span>
				<span>评论：<?php comments_popup_link('0条', '1 条', '% 条', '', '评论已关闭'); ?></span>
			</div>
			<!-- 内容 -->
			<div class="blogroll">
				<?php the_content(); ?>
				<div class="R-blogroll"><?php dynamic_sidebar('友情链接'); ?></div>
			</div>
		<?php endwhile; endif; ?>
			<div class="single-copyright">
				<div class="fl">本站遵循CC协议（<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh" rel="external nofollow" target="_blank">署名-非商业性使用-相同方式共享 </a>）</div>
				<div class="fr">转载请注明来自：<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
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