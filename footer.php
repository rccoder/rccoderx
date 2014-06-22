<?php show_refer_in();?>
<div id="footer"><div class="wrap">
	<!-- 底部菜单 -->
	<?php 
		$args = array(
			"container_id" => "nav_footer",
			"theme_location" => "nav_footer",
			"depth" => "1"
		);
		wp_nav_menu($args); 
	?>
	<!-- 版权声明 -->
	<div class="copyright">
		C@2014 <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
		<script type="text/javascript" src="http://tajs.qq.com/stats?sId=34262718" charset="UTF-8"></script>
        <?php if(dopt('Rcloud_beian')){ echo dopt('Rcloud_beianhao'); }; ?>
		<?php if(dopt('Rcloud_track_b')){ echo dopt('Rcloud_track'); }; ?>
		<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1000351279'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1000351279' type='text/javascript'%3E%3C/script%3E"));</script>
		<a href="http://ysbinang.sinaapp.com/sitemap">站点地图</a>
        <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fab5a361214b37aa2036d70362afbe7a2' type='text/javascript'%3E%3C/script%3E"));
</script>
        All Rights Reserved.
        自豪地使用WordPress
	</div>
</div></div>
</div>
<!-- 滚动组件 -->
<ul id="roll">
	<li class="rollTop" title="回到顶部"></li>
	<li class="rollBottom" title="滚到底部"></li>
</ul>
<div id="rollFooter"></div>
<script type="text/javascript" src="http://libs.baidu.com/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/slimbox2.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/prettify.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/core.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/comments-ajax.js"></script>
</body>
</html>