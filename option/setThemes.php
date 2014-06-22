<?php
$themename = $danme.'主题';
include_once 'theme_con.php';
function mytheme_add_admin() {
	global $themename, $options;
	if ( $_GET['page'] == basename(__FILE__) ) {
		if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
			}
			header("Location: admin.php?page=setThemes.php&saved=true");
			die;
		}
		else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {delete_option( $value['id'] ); }
			header("Location: admin.php?page=setThemes.php&reset=true");
			die;
		}
	}
	add_theme_page($themename."设置", $themename."设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
	global $themename, $options, $themeSet_tagname;
	$i=0;
	if ( $_REQUEST['saved'] ) echo '<div class="d_message">'.$themename.'修改已保存</div>';
	if ( $_REQUEST['reset'] ) echo '<div class="d_message">'.$themename.'已恢复设置</div>';
?>

<div class="wrap d_wrap">
	<link rel="stylesheet" href="<?php bloginfo('template_url') ?>/option/theme.css"/>
	<h2><?php echo $themename; ?>设置
		<span class="d_themedesc">当前版本：Rcloud &nbsp;&nbsp; 主题作者：<a href="http://rxshc.com/" title="生要能尽欢，死要能无憾" target="_blank">热血洒红尘</a>&nbsp;&nbsp; 主题演示站：<a href="http://rcloud.rxshc.com/" title="Rcloud主题演示站点，主题使用教程" target="_blank">Rcloud</a></span>
	</h2>
	
	<form method="post">
		<div class="d_tab"><?php echo "$themeSet_tagname"; ?></div>
		<?php foreach ($options as $value) { switch ( $value['type'] ) { case "": ?>
			<?php break; case "tit": ?>
			
			</li><li class="d_li">
			<h4><?php echo $value['name']; ?>：</h4>
			
			<?php break; case 'text': ?>
			<?php if ( $value['desc'] != "") { ?><label class="d_the_desc"><?php echo $value['desc']; ?></label><?php } ?><input class="d_inp <?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
			
			<?php break; case 'textarea': ?>
			<textarea class="d_tarea" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
			
			<?php break; case 'select': ?>
			<?php if ( $value['desc'] != "") { ?><span class="d_the_desc" id="<?php echo $value['id']; ?>_desc"><?php echo $value['desc']; ?></span><?php } ?><select class="d_sel" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
				<?php foreach ($value['options'] as $option) { ?>
				<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected" class="d_sel_opt"'; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
			
			<?php break; case "checkbox": ?>
			<?php if(get_settings($value['id']) != ""){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
			<label class="d_check"><input type="checkbox" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" <?php echo $checked; ?> />开启</label>
			
			<!-- 新增 -->
			<?php break; case "z_c": ?>
			<?php if(get_settings($value['id']) != ""){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
			<label class="d_check z_c"><input type="checkbox" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" <?php echo $checked; ?> />开启</label>
			
			<?php break; case 'z_text': ?>
			<?php if ( $value['desc'] != "") { ?><label class="d_the_desc"><?php echo $value['desc']; ?></label><?php } ?><input class="d_inp <?php echo $value['class']; ?> z_text" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
			
			<?php break; case 'z_textarea': ?>
			<?php if ( $value['desc'] != "") { ?><label class="d_the_desc"><?php echo $value['desc']; ?></label><?php } ?><input class="d_inp <?php echo $value['class']; ?> z_textarea" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
			
			<?php break; case 'z_info': ?>
			<?php if ( $value['desc'] != "") { ?><label class="d_the_desc"><?php echo $value['desc']; ?></label><?php } ?><div class="d_inp <?php echo $value['class']; ?> z_info" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?></div>
			
			
			<?php break; case "section": $i++; ?>
			<div class="d_mainbox" id="d_mainbox_<?php echo $i; ?>">
				<div class="d_desc"><input class="button-primary" name="save<?php echo $i; ?>" type="submit" value="保存设置" /><?php echo $value['desc']; ?></div>
				<ul class="d_inner">
					<li class="d_li">
				
			<?php break; case "endtag": ?>
			</li></ul>
			<div class="d_desc d_desc_b"><input class="button-primary" name="save<?php echo $i; ?>" type="submit" value="保存设置" /></div>
			</div>
			
		<?php break; }} ?>
				
		<input type="hidden" name="action" value="save" />
		
		<div class="d_popup d_export">
			<h3><input class="button-primary" type="button" value="关闭" /><?php echo $themename; ?>设置-导出：</h3>
			<h4>妥善保管好您导出的数据，否则您就要一条条的添加！</h4>
			<p><textarea onmouseover="this.focus();this.select();" disabled="true" name="" id="" cols="30" rows="10"></textarea></p>
		</div>
		<div class="d_popup d_import">
			<h3><input class="button-primary" type="button" value="立即导入" /><?php echo $themename; ?>设置-导入：</h3>
			<h4>贴入您之前保存的导出数据，点击“立即导入”，确定导入成功后再保存！</h4>
			<p><textarea onmouseover="this.focus();this.select();" name="" id="" cols="30" rows="10"></textarea></p>
		</div>
	</form>
<script src="<?php bloginfo('template_url') ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url') ?>/option/theme.js"></script>
</div>
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');?>