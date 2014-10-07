<?php
//短代码页面
/*摘要*/
function part($atts,$content=null){
	extract(shortcode_atts(array(
		"title" => "",
		"on" => "",
	), $atts));
	$return = '<div class="shortpart">
		<h3 class="shortpart-title '.$on.'">'.$title.'</h3>
		<div class="shortpart-con '.$on.'">'.$content.'</div>
	</div>';
	return $return;
}
add_shortcode('part','part');

/*链接*/
function weblink($atts,$content=null){
	extract(shortcode_atts(array(
		"url" => "",
	), $atts));
	$return = '<a class="weblink" href="'.$url.'" target="_blank">'.$content.'</a>';
	return $return;
}
add_shortcode('weblink','weblink');

//doubanplayer
function doubanplayer($atts, $content=null){
  extract(shortcode_att(array("auto" => '0'),$atts));
  return '<embed src=" '.get_bloginfo( "template_url").' /Rcloud/player.swf?
  url=' .$content.' &amp;autoplay='.$auto.'"
  type= "application/x-shockwave-flash" wmode= "transparent"
  allowscriptaccess= "always" width= "400" height= "30">';
}
add_shortcode( 'music' ,' doubanplayer');

?>