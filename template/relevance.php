<!-- 相关推荐 -->
<div class="single-relevance part">
	<h3 class="title">
		<div class="fl">相关推荐</div>
		<div class="fr"><?php include_once 'fenxiang.php'; ?></div>
		<div class="cc"></div>
	</h3>
	<div class="single-relevance-list">
		<?php
			$post_tags = wp_get_post_tags($post->ID);
			if ($post_tags) {
				foreach ($post_tags as $tag){
				    // 获取标签列表
				    $tag_list[] .= $tag->term_id;
				}
			}
			$post_tag = $tag_list[ rand(0, count($tag_list) - 1) ];
			$query_posts = new WP_Query('orderby=rand&caller_get_posts=1&showposts=4&tag_in='.$post_tag);
		?>
		<?php if($query_posts->have_posts()):while($query_posts->have_posts()):$query_posts->the_post(); ?>
		<dl>
			<dt><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></dt>
			<dd>Posted on <?php the_time('m月d日'); ?></dd>
		</dl>
		<?php endwhile; endif; ?>
	</div>
</div>
<?php wp_reset_query(); ?>