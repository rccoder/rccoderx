<!DOCTYPE html>
<!--[if IE 6]>ie6
<html lang="en-us" class="ie6">
<![endif]--><!--[if IE 7]>
<html lang="en-us" class="ie7">
<![endif]--><!--[if IE 8]>
<html lang="en-us" class="ie8">
<![endif]-->
	<head>
	<?php wp_head();?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo( 'template_url' ); ?>/images/favicon.ico" />
	<!--KEY-->
	<?php include_once 'inc/key.php'; ?>
	<!--调用STYLE样式表-->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/slimbox2.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/prettify.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
    <div id="circle-box">
    <div id="circle"></div>
    <div id="circle1"></div>
</div>
<script type="text/javascript">
    $(window).load(function() {    
        $("#circle").fadeOut(500);
        $("#circle1").fadeOut(700);
        $("#circle-box").fadeOut(700);
    });
</script><div id="page">
<!-- 顶部 -->
<div id="top">
	<div class="wrap">
		<!-- 顶部左导航 -->
		<?php 
			$args = array(
				"container_id" => "top_left_menu",
				"theme_location" => "top_left",
			);
			wp_nav_menu($args); 
		?>
		<!-- sns -->
		<div class="sns">
			<?php if(dopt('Rcloud_feed_c')){; ?><a target="_blank" rel="nofollow" class="sns_feed" href="<?php echo dopt('Rcloud_feed'); ?>" title="订阅我吧"></a><?php }; ?>
			<?php if(dopt('Rcloud_weibo_c')){; ?><a target="_blank" rel="nofollow" class="sns_weibo" href="<?php echo dopt('Rcloud_weibo'); ?>" title="新浪微博"></a><?php }; ?>
			<?php if(dopt('Rcloud_qweibo_c')){; ?><a target="_blank" rel="nofollow" class="sns_qweibo" href="<?php echo dopt('Rcloud_qweibo'); ?>" title="腾讯微博"></a><?php }; ?>
			<?php if(dopt('Rcloud_douban_c')){; ?><a target="_blank" rel="nofollow" class="sns_douban" href="<?php echo dopt('Rcloud_douban'); ?>" title="我的豆瓣"></a><?php }; ?>
			<?php if(dopt('Rcloud_qq_c')){; ?><a target="_blank" rel="nofollow" class="sns_qq" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo dopt('Rcloud_qq'); ?>&site=qq&menu=yes" title="联系QQ"></a><?php }; ?>
		</div>
		<div class="cc"></div>
	</div>
</div>
<!-- 头部 -->
<div id="header"><div class="wrap">
	<!-- logo -->
	<div class="logo">
		<a class="logolink" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a>
		<span class="notice"><?php echo dopt('Rcloud_notice'); ?></span>
	</div>
	<!-- 搜索 -->
	<div class="fr">
		<?php get_search_form(); ?>
	</div>
	<div class="cc"></div>
</div></div>
<div id="nav"><div class="wrap">
	<!-- 导航左 -->
	<?php 
		$args = array(
			"container_id" => "nav_left_menu",
			"theme_location" => "nav_left"
		);
		wp_nav_menu($args); 
	?>
	<!-- 导航右 -->
	<?php 
		$args = array(
			"container_id" => "nav_right_menu",
			"theme_location" => "nav_right"
		);
		wp_nav_menu($args); 
	?>
	<div class="cc"></div>
</div></div>
<!-- 关于博主 -->
<div class="qaq">
	<a class="cd">关于博主</a>
  	<div class="icon-direction-outline">
	</div>
	<div class="dropdown">
	 宅</br>
	 HIT</br>
	 准大二</br>
	 喜欢WEB</br>
	 自命清高</br>
	 单身直男</br>
	 计算机科学与技术</br>
	    www.rccoder.net
	 </div>
</div>
<div id="modienav">
	<?php if(is_single()): ?>
		<?php the_title(); ?>
	<?php ;else: ?>
		<div id="modie-list" class="modie-list">首页</div>
		<div id="toptobot"></div>
		<div id="modie-menu"><ul>
			
		</ul></div>
	<?php endif; ?>
</div>
<?php 
	echo '<div class="wrap">';
		the_breadcrumb();
	echo '</div>';
?>
