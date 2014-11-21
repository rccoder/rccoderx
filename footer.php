<?php show_refer_in();?>
<div id="footer"><div class="wrap">
	<!-- 底部菜单 -->
	<div class="footmenu">
	本站导航:
	</div>
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
		CopyRight@2014 <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
		<script type="text/javascript" src="http://tajs.qq.com/stats?sId=34262718" charset="UTF-8"></script>
        <?php if(dopt('Rcloud_beian')){ echo dopt('Rcloud_beianhao'); }; ?>
		<?php if(dopt('Rcloud_track_b')){ echo dopt('Rcloud_track'); }; ?>
		<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");

document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F09e5d137cb48c128491f1000bf62a401' type='text/javascript'%3E%3C/script%3E"));

</script>


<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/local.js"></script>




		<a href="http://www.rccoder.net/sitemap">站点地图</a>



		



本站由<a href="http://my.33c.cc/aff.php?aff=023" rel="nofollow">极速动力主机</a>和<a href="http://www.qiniu.com" rel="nofollow">七牛云储存</a>赞助



本站永久链接<a href="http://www.rccoder.net" rel="nofollow">www.rccoder.net</a>



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



  <?php if (E_is_mobile() ): ?>



		<script type="text/javascript" src="http://libs.baidu.com/jquery/1.8.0/jquery.min.js"></script>



		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/core.js"></script>



		<?php endif ;?>







<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/slimbox2.js"></script>







<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/prettify.js"></script>







 <script src="http://www.rccoder.net/wp-content/themes/rccoder/js/useragent.js"></script>







<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/comments-ajax.js"></script>



</body>







</html>