<?php
/*
Template Name: 留言板
*/
?>
<?php get_header(); ?>
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
			<div class="guestbook">
				<?php the_content(); ?>
				<!-- start 读者墙  Edited By iSayme-->
				<?php
					$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != '".dopt('Rcloud_Email')."' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 12";//大家把管理员的邮箱改成你的,目的是从读者墙里面排除博客作者，最后的数字39是读者的个数，可以按照自己的情况修改！
					$wall = $wpdb->get_results($query);
					$maxNum = $wall[0]->cnt;
					foreach ($wall as $comment){
				 		if( $comment->comment_author_url )
				 			$url = $comment->comment_author_url;
				 		else $url="#";
				 			$avatar = get_avatar( $comment->comment_author_email, $size = '36', $default=   get_bloginfo('wpurl').'/avatar/default.jpg' );
				 			$tmp = "<li><a target=\"_blank\" rel=\"nofollow\" href=\"".$comment->comment_author_url."\">".$avatar."<em>".$comment->comment_author."</em> <strong>+".$comment->cnt."</strong></br><span>".$comment->comment_author_url."</span></a></li>";
				 			$output .= $tmp;
					}
					 $output = "<div class=\"guestbookbox\"><ul id=\"guestbookList\" class=\"readers-list\">".$output."</ul></div>";
				 	echo $output ;
				?>
				<!-- end 读者墙 -->
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
<script>
	$(function(){
         $("#guestbookList li").hover(function(){
         		$(this).find('img').stop(false,false).animate({left:"-50"},400);
         		$(this).find('em').stop(false,false).animate({top:"-30"},400);
         		$(this).find('strong').stop(false,false).animate({right:"-30"},400);
         		$(this).find('span').stop(false,false).animate({bottom:"35"},400);
         },function(){
         		$(this).find('img').stop(false,false).animate({left:"0"},400);
         		$(this).find('em').stop(false,false).animate({top:"0"},400);
         		$(this).find('strong').stop(false,false).animate({right:"10"},400);
         		$(this).find('span').stop(false,false).animate({bottom:"0"},400);
         });
 	});
</script>