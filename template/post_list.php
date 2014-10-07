<?php
	$postnun = 1;	
	if(have_posts()):while(have_posts()):the_post();
?>
<?php
	//广告
	if($postnun == 2 && dopt('Rcloud_list_ad_c')){
		echo '<div class="post-list ad"><center>'.dopt('Rcloud_list_ad').'</center></div>';
	}
?>
<?php if(has_post_format('quote')): // 引语 ?>
<div class="post-list">
	<h2 class="post-list-title">
        <a class="fl" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><em><?php $t1=$post->post_date; $t2=date("Y-m-d H:i:s"); $diff=(strtotime($t2)-strtotime($t1))/3600; if($diff<72){echo "【 New!】";}?><?php if ( is_sticky() ) {echo "【置顶】";}?></em><?php the_title(); ?></a>
		<span class="fr"><?php the_time('m月d日'); ?></span>
		<div class="cc"></div>
	</h2>
	<div class="post-list-style"></div>
	<div class="post-list-text"><?php the_excerpt(); ?></div>
	<ul class="post-list-info">
		<li>分类：<?php the_category(' '); ?></li>
		<li>标签：<?php the_tags(' '); ?></li>
		<li>评论：<?php comments_popup_link('0条', '1 条', '% 条', '', '评论已关闭'); ?></li>
		<li>浏览：<?php the_view(); ?></li>
		<li class="more"><a href="<?php the_permalink(); ?>">阅读全文</a></li>
	</ul>
</div>

<?php elseif(has_post_format('status')): //状态 ?>
<div class="post-list status">
	<div class="avatar"><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo get_avatar(get_the_author_meta('user_email'),'40'); ?></a></div>
	<ul class="post-list-info">
		<li>评论：<?php comments_popup_link('0条', '1 条', '% 条', '', '评论已关闭'); ?></li>
	</ul>
	<div class="post-list-text"><?php the_content(); ?></div>
</div>

<?php elseif(has_post_format('audio')): //音乐 ?>
<div class="post-list audio">
	<h2 class="post-list-title">
		<a class="fl" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		<span class="fr"><?php the_time('m月d日'); ?></span>
		<div class="cc"></div>
	</h2>
	<div class="post-list-audio">
		<?php
			$music_url = get_post_meta($post->ID,'play_url',true);
			$music_box = auto_player_urls($music_url);
			echo $music_box;
		?>
	</div>
	<div class="post-list-text"><?php the_excerpt(); ?></div>
</div>

<?php elseif(has_post_format('video')): //视频 ?>
<div class="post-list video">
	<div class="post-list-video">
		<?php
			$play_url = get_post_meta($post->ID,'play_url',true);
			echo '<embed class="swf_player" src="'.$play_url.'" width="648" height="400" type="application/x-shockwave-flash" wmode="transparent"></embed>';
		?>
	</div>
	<h2 class="post-list-title">
		<a class="fl" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		<span class="fr"><?php the_time('m月d日'); ?></span>
		<div class="cc"></div>
	</h2>
	<div class="post-list-text"><?php the_excerpt(); ?></div>
</div>

<?php else: //默认 ?>
<div class="post-list">
	<h2 class="post-list-title">
        <a class="fl" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><em><?php $t1=$post->post_date; $t2=date("Y-m-d H:i:s"); $diff=(strtotime($t2)-strtotime($t1))/3600; if($diff<72){echo "【 New!】";}?><?php if ( is_sticky() ) {echo "【置顶】";}?></em><?php the_title(); ?></a>
		<span class="fr"><?php the_time('m月d日'); ?></span>
		<div class="cc"></div>
		<div class="line"></div>
	</h2>
	<?php if(get_the_img()){
		echo '<div class="post-list-img"><a href="'.get_permalink().'" title="'.get_the_title().'">';
		the_img();
		echo '</a></div>';
	} ?>
	<div class="post-list-text"><?php the_excerpt(); ?></div>
	<ul class="post-list-info">
		<li class="cat">分类：<?php the_category(' '); ?></li>
		<li class="tag">标签：<?php the_tags(' '); ?></li>
		<li>评论：<?php comments_popup_link('0条', '1 条', '% 条', '', '评论已关闭'); ?></li>
		<li>浏览：<?php the_view(); ?></li>
		<li class="more"><a href="<?php the_permalink(); ?>">阅读全文</a></li>
	</ul>
</div>	
<?php endif; ?>	
<?php $postnun++; endwhile; else: ?>
	<h1 style="border:1px solid #ccc; border-radius: 3px; padding: 50px; font-size: 20px; color: #f00; text-align: center; background: #fff;">客官太深了~~~ 已经没有更多的文章可以显示了</h1>
<?php endif; ?>