<?php get_header(); ?>
<?php wp_head();?>
<div id="content"><div class="wrap">
	<div id="single">
		<div class="part">
		<?php if(have_posts()):while(have_posts()):the_post(); ?>
			<h1 class="single-title"><?php the_title(); ?></h1>
			<!-- 文章信息 -->
			<div class="single-info">
				<span>作者：<?php the_author() ?></span>
				<span>时间：<?php the_time('Y-m-d') ?></span>
				<span>分类：<?php the_category(' '); ?></span>
				<span>评论：<?php comments_popup_link('0条', '1 条', '% 条', '', '评论已关闭'); ?></span>
				<span>浏览：<?php the_view(); ?></span>
				<?php if( current_user_can( 'manage_options' ) ) { ?>
				<a href="<?php echo get_edit_post_link(); ?>" target="_blank">编辑文章</a>
				<?php } ?>
			</div>
			<!-- 内容 -->
			<div id="single-con">
				<?php
					//广告
					if(dopt('Rcloud_signleTop_ad_c')){
						echo '<div class="Rcloud_signleTop_ad"><center>'.dopt('Rcloud_signleTop_ad').'</center></div>';
					}
				?>
				<?php include_once 'template/media.php'; ?>
				<?php the_content(); ?>
			</div>
			<div class="single-tags">标签：<?php the_tags('',' '); ?></div>
		<?php endwhile; endif; ?>
			<?php
				//广告
				if(dopt('Rcloud_signleBot_ad_c')){
					echo '<div class="Rcloud_signleBot_ad"><center>'.dopt('Rcloud_signleTop_ad').'</center></div>';
				}
			?>
			<div class="single-copyright">
				<div class="fl">本站遵循CC协议<a href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh" rel="external nofollow" target="_blank">署名-非商业性使用-相同方式共享 </a></div>
				<div class="fr">转载请注明来自：<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
				<div class="cc"></div>
			</div>
		</div>
		<div class="part">
			<ul class="otherPost">
				<li><?php next_post_link('下一篇： %link','%title',false); ?></li>
				<li><?php previous_post_link('上一篇： %link','%title',false); ?></li>
			</ul>
		</div>
		<?php include_once 'template/relevance.php'; ?>
		<!-- 评论 -->
		<div class="part"><?php comments_template(); ?></div>
	</div>
	<?php get_sidebar(); ?>
	<div class="cc"></div>
</div></div>
<div class="emoji">
<a class="btn-select" id="btn_select">
<span class="cur-select">点击添加金灿灿的萌萌哒</span>
<select name="emotion" id="emotion">
<option value="" selected="selected">萌萌哒</option>
<option value="|∀ﾟ">|∀ﾟ</option>
<option value="(´ﾟДﾟ`)">(´ﾟДﾟ`)</option>
<option value="(;´Д`)">(;´Д`)</option>
<option value="(｀･ω･)">(｀･ω･)</option>
<option value="(=ﾟωﾟ)=">(=ﾟωﾟ)=</option>
<option value="| ω・´)">| ω・´)</option>
<option value="|-` )">|-` )</option>
<option value="|д` )">|д` )</option>
<option value="|ー` )">|ー` )</option>
<option value="|∀` )">|∀` )</option>
<option value="(つд⊂)">(つд⊂)</option>
<option value="(ﾟДﾟ≡ﾟДﾟ)">(ﾟДﾟ≡ﾟДﾟ)</option>
<option value="(＾o＾)ﾉ">(＾o＾)ﾉ</option>
<option value="(|||ﾟДﾟ)">(|||ﾟДﾟ)</option>
<option value="( ﾟ∀ﾟ)">( ﾟ∀ﾟ)</option>
<option value="( ´∀`)">( ´∀`)</option>
<option value="(*´∀`)">(*´∀`)</option>
<option value="(*ﾟ∇ﾟ)">(*ﾟ∇ﾟ)</option>
<option value="(*ﾟーﾟ)">(*ﾟーﾟ)</option>
<option value="(　ﾟ 3ﾟ)">(　ﾟ 3ﾟ)</option>
<option value="( ´ー`)">( ´ー`)</option>
<option value="( ・_ゝ・)">( ・_ゝ・)</option>
<option value="( ´_ゝ`)">( ´_ゝ`)</option>
<option value="(*´д`)">(*´д`)</option>
<option value="(・ー・)">(・ー・)</option>
<option value="(・∀・)">(・∀・)</option>
<option value="(ゝ∀･)">(ゝ∀･)</option>
<option value="(〃∀〃)">(〃∀〃)</option>
<option value="(*ﾟ∀ﾟ*)">(*ﾟ∀ﾟ*)</option>
<option value="( ﾟ∀。)">( ﾟ∀。)</option>
<option value="( `д´)">( `д´)</option>
<option value="(`ε´ )">(`ε´ )</option>
<option value="(`ヮ´ )">(`ヮ´ )</option>
<option value="σ`∀´)">σ`∀´)</option>
<option value=" ﾟ∀ﾟ)σ"> ﾟ∀ﾟ)σ</option>
<option value="ﾟ ∀ﾟ)ノ">ﾟ ∀ﾟ)ノ</option>
<option value="(╬ﾟдﾟ)">(╬ﾟдﾟ)</option>
<option value="(|||ﾟдﾟ)">(|||ﾟдﾟ)</option>
<option value="( ﾟдﾟ)">( ﾟдﾟ)</option>
<option value="Σ( ﾟдﾟ)">Σ( ﾟдﾟ)</option>
<option value="( ;ﾟдﾟ)">( ;ﾟдﾟ)</option>
<option value="( ;´д`)">( ;´д`)</option>
<option value="(　д ) ﾟ ﾟ">(　д ) ﾟ ﾟ</option>
<option value="( ☉д⊙)">( ☉д⊙)</option>
<option value="(((　ﾟдﾟ)))">(((　ﾟдﾟ)))</option>
<option value="( ` ・´)">( ` ・´)</option>
<option value="( ´д`)">( ´д`)</option>
<option value="( -д-)">( -д-)</option>
<option value="(&gt;д&lt;)">(&gt;д&lt;)</option>
<option value="･ﾟ( ﾉд`ﾟ)">･ﾟ( ﾉд`ﾟ)</option>
<option value="( TдT)">( TдT)</option>
<option value="(￣∇￣)">(￣∇￣)</option>
<option value="(￣3￣)">(￣3￣)</option>
<option value="(￣ｰ￣)">(￣ｰ￣)</option>
<option value="(￣ . ￣)">(￣ . ￣)</option>
<option value="(￣皿￣)">(￣皿￣)</option>
<option value="(￣艸￣)">(￣艸￣)</option>
<option value="(￣︿￣)">(￣︿￣)</option>
<option value="(￣︶￣)">(￣︶￣)</option>
<option value="ヾ(´ωﾟ｀)">ヾ(´ωﾟ｀)</option>
<option value="(*´ω`*)">(*´ω`*)</option>
<option value="(・ω・)">(・ω・)</option>
<option value="( ´・ω)">( ´・ω)</option>
<option value="(｀・ω)">(｀・ω)</option>
<option value="(´・ω・`)">(´・ω・`)</option>
<option value="(`・ω・´)">(`・ω・´)</option>
<option value="( `_っ´)">( `_っ´)</option>
<option value="( `ー´)">( `ー´)</option>
<option value="( ´_っ`)">( ´_っ`)</option>
<option value="( ´ρ`)">( ´ρ`)</option>
<option value="( ﾟωﾟ)">( ﾟωﾟ)</option>
<option value="(oﾟωﾟo)">(oﾟωﾟo)</option>
<option value="(　^ω^)">(　^ω^)</option>
<option value="(｡◕∀◕｡)">(｡◕∀◕｡)</option>
<option value="/( ◕‿‿◕ )\">/( ◕‿‿◕ )\</option>
<option value="ヾ(´ε`ヾ)">ヾ(´ε`ヾ)</option>
<option value="(ノﾟ∀ﾟ)ノ">(ノﾟ∀ﾟ)ノ</option>
<option value="(σﾟдﾟ)σ">(σﾟдﾟ)σ</option>
<option value="(σﾟ∀ﾟ)σ">(σﾟ∀ﾟ)σ</option>
<option value="|дﾟ )">|дﾟ )</option>
<option value="┃電柱┃">┃電柱┃</option>
<option value="ﾟ(つд`ﾟ)">ﾟ(つд`ﾟ)</option>
<option value="ﾟÅﾟ )　">ﾟÅﾟ )　</option>
<option value="⊂彡☆))д`)">⊂彡☆))д`)</option>
<option value="⊂彡☆))д´)">⊂彡☆))д´)</option>
<option value="⊂彡☆))∀`)">⊂彡☆))∀`)</option>
<option value="(´∀((☆ミつ">(´∀((☆ミつ</option>
</select>
</a>
</div>
<?php get_footer(); ?>