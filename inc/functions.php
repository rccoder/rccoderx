<?php
/*导入主题后台设置*/
include_once 'option/setThemes.php';
/*导入短代码*/
include_once 'inc/shortcode.php';
/*导入小工具*/
include_once 'inc/widget.php';
/*导入碎碎语*/
include_once('post_type.php');
function dopt($e){
    return stripslashes(get_option($e));
}
/*文章自动定时*/
function my_script(){
	if(is_admin()){
		wp_enqueue_script( 'setTime', get_bloginfo('template_url').'/js/setTime.js', array(), 'lastest', false );
	}
}
add_action('init', 'my_script');

/*小工具*/
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => '侧边',
		'before_widget' => '<div class="widget"><div class="widget-con">', // widget 的开始标签
		'after_widget' => '</div></div>', // widget 的结束标签
		'before_title' => '<h3 class="widget-title">', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
	));
	register_sidebar(array(
		'name' => '内页侧边',
		'before_widget' => '<div class="widget"><div class="widget-con">', // widget 的开始标签
		'after_widget' => '</div></div>', // widget 的结束标签
		'before_title' => '<h3 class="widget-title">', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
	));
	register_sidebar(array(
		'name' => '友情链接',
		'before_widget' => '<div class="widget blogroll"><div class="widget-con">', // widget 的开始标签
		'after_widget' => '</div></div>', // widget 的结束标签
		'before_title' => '<h3 class="widget-title">', // 标题的开始标签
		'after_title' => '</h3>' // 标题的结束标签
	));
}

/*自定义菜单*/
register_nav_menus(
	array(
	'top_left' => __( '顶部左菜单' ),
	'nav_left' => __( '导航栏-左' ),
	'nav_right' => __( '导航栏-右' ),
	'nav_footer' => __( '底部菜单' )
	)
);

/*-----------------------------------------*\
    获取第一张图片地址
\*-----------------------------------------*/
function get_the_img() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  return $first_img;
}
/*-----------------------------------------*\
    输出第一张图片
\*-----------------------------------------*/
function the_img(){
  $imgurl = get_the_img();
  if(empty($imgurl)){
    echo '<img src="'.get_bloginfo('template_url').'/images/default.png" alt="" />';
  }else{
    echo '<img src="'.$imgurl.'" alt="" />';  
  }
}

/*缩略图功能*/
function post_thumbnail( $width = 100,$height = 80 ){
    global $post;
    if( has_post_thumbnail() ){    //如果有缩略图，则显示缩略图
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        $post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$timthumb_src[0].'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" />';
        echo $post_timthumb;
    } else {
        $post_timthumb = '';
        ob_start();
        ob_end_clean();
        $output = preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $index_matches);    //获取日志中第一张图片
        $first_img_src = $index_matches [1];    //获取该图片 src
        if( !empty($first_img_src) ){    //如果日志中有图片
            $path_parts = pathinfo($first_img_src);    //获取图片 src 信息
            $first_img_name = $path_parts["basename"];    //获取图片名
            $first_img_pic = get_bloginfo('wpurl'). '/cache/'.$first_img_name;    //文件所在地址
            $first_img_file = ABSPATH. 'cache/'.$first_img_name;    //保存地址
            $expired = 604800;    //过期时间
            if ( !is_file($first_img_file) || (time() - filemtime($first_img_file)) > $expired ){
                copy($first_img_src, $first_img_file);    //远程获取图片保存于本地
                $post_timthumb = '<img src="'.$first_img_src.'" alt="'.$post->post_title.'" class="thumb" />';    //保存时用原图显示
            }
            $post_timthumb = '<img src="'.get_bloginfo("template_url").'/timthumb.php?src='.$first_img_pic.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="'.$post->post_title.'" class="thumb" />';
        } else {    //如果日志中没有图片，则显示默认
            $post_timthumb = '<img src="'.get_bloginfo("template_url").'/images/default.png" alt="'.$post->post_title.'" class="thumb" />';
        }
        echo $post_timthumb;
    }
}
 
// 文章形式
add_theme_support( 'post-formats', array('status','image','quote','video','audio') );
// 链接自动识别播放
function auto_player_urls($c) {
    $s = array('/^(http:\/\/.*\.mp3)$/m' => '<embed class="mp3_player" src="'.get_bloginfo("template_url").'/mp3_player.swf?audio_file=$1&amp;color=ffffff" width="207" height="30" type="application/x-shockwave-flash"></embed></p>',
    '/^(http:\/\/www.xiami.com.*\.swf)$/m' => '<p><embed class="swf_player" src="$1" width="258" height="33" type="application/x-shockwave-flash" wmode="transparent"></embed></p>',
	'/^(http:\/\/box.baidu.com.*)$/m' => '<p><embed class="swf_player" src="$1" width="500" height="80" type="application/x-shockwave-flash" wmode="transparent"></embed></p>',
	'/^(http:\/\/.*\.swf)$/m' => '<p><embed class="swf_player" src="$1" width="640" height="480" type="application/x-shockwave-flash" wmode="transparent"></embed></p>');
    foreach($s as $p => $r){
        $c = preg_replace($p,$r,$c);
    }
    return $c;
}
add_filter( 'the_content', 'auto_player_urls' );


//自定义评论结构
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;
   if(!$commentcount) {
	   $page = ( !empty($in_comment_loop) ) ? get_query_var('cpage')-1 : get_page_of_comment( $comment->comment_ID, $args )-1;
	   $cpp=get_option('comments_per_page');
	   $commentcount = $cpp * $page;
	}
?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="comment-author"><?php echo get_avatar( $comment, $size = '36'); ?></div>
			<div class="comment-head">
				<span class="name"><?php printf(__('%s'), get_comment_author_link()) ?></span>
				<span class="date"><?php if(!$parent_id = $comment->comment_parent) {printf(__('%1$s %2$s'), get_comment_date('Y-n-j'),  get_comment_time('H:i'));} ?> <?php if(!$parent_id = $comment->comment_parent) {printf('#%1$s', ++$commentcount);} ?></span>
				<span class="comment-entry"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复TA')))) ?></span>
			</div>
			<div class="comment-text"><?php comment_text() ?></div>
     </div>
<?php
}
//面包屑
function the_breadcrumb() { 
  $delimiter = '&raquo;';
  $name = '首页'; //text for the 'Home' link
  $currentBefore = '<span>';
  $currentAfter = '</span>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div class="breadcrumb">';
 
    global $post;
    $home = get_bloginfo('url');
    echo '' . $name . ' ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore;
      single_cat_title();
      echo $currentAfter;
 
    } elseif ( is_day() ) {
      echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
      echo '' . get_the_time('F') . ' ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
 
    } elseif ( is_month() ) {
      echo '' . get_the_time('Y') . ' ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
 
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '' . get_the_title($page->ID) . '';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
 
    } elseif ( is_search() ) {
      echo $currentBefore . '搜索：“' . get_search_query() . '”' . $currentAfter.'的结果';
 
    } elseif ( is_tag() ) {
      echo $currentBefore . '标签：“';
      single_tag_title();
      echo '”' . $currentAfter.'中的文章';
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
 
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}

//分页导航
function wp_pagenavi( $before = '', $after = '', $p = 2 ) {
if ( is_singular() ) return;
global $wp_query, $paged;
$max_page = $wp_query->max_num_pages;
if ( $max_page == 1 ) return;
if ( empty( $paged ) ) $paged = 1;
echo $before.'<div id="wp_pagenavi">';
echo '<span class="pagescout">第 ' . $paged . ' 页,共 ' . $max_page . ' 页 </span>';
if ( $paged > 1 ) p_link( $paged - 1, '上一页', '«' );
if ( $paged > $p + 1 ) p_link( 1, '最前一页' );
if ( $paged > $p + 2 ) echo '... ';
for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span>" : p_link( $i );
}
if ( $paged < $max_page - $p - 1 ) echo '... ';
if ( $paged < $max_page - $p ) p_link( $max_page, '最后一页' );
if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '»' );
echo '</div>'.$after;
}
function p_link( $i, $title = '', $linktype = '' ) {
if ( $title == '' ) $title = "Page {$i}";
if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a>";
}

// 浏览量统计
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
       $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function the_view(){
	echo getPostViews(get_the_ID());
	if(is_single()){	
		setPostViews(get_the_ID());
	}
}
// 文章存档函数
 function Rcloud_archives_list() {
     if( !$output = get_option('Rcloud_archives_list') ){
         $output = '<div id="archives"><p>[<a id="al_expand_collapse" href="#">全部展开/收缩</a>] <em>(注: 点击月份可以展开)</em></p>';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a class="archivesPostList" href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('Rcloud_archives_list', $output);
     }
     echo $output;
 }
 function clear_zal_cache() {
     update_option('Rcloud_archives_list', ''); // 清空 存档
 }
 add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时
//欢迎界面
function show_refer_in(){
$refer_info=$_SERVER['HTTP_REFERER'];
$ban_list=array($_SERVER["HTTP_HOST"]);
for($ii=0;$ii<count($ban_list);$ii++){
if(strpos($refer_info,$ban_list[$ii])){
return;
}
}
if($refer_info){
preg_match("/^(http:\/\/)?([^\/]+)/i",
$refer_info, $matches);
$host = $matches[2];
echo "<div id=\"hellobaby\">欢迎来自 ".$host." 的朋友！<br /></div>";
}
}
//文章字数统计   
//function count_words ($text) {
//global $post;
//if ( " == $text ) {
  // $text = $post->post_content;
   //if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '字数统计：' . mb_strlen(preg_replace('/\s/',",html_entity_decode(strip_tags($post->post_content))),'UTF-8') . '字';
   //return $output;
//}
//}
//禁用标点转化
remove_filter('the_content', 'wptexturize');
/*
Plugin Name: Baidu-Accept
Plugin URI: http://www.d4v.com.cn
Description: 判断当前文章是否被百度收录，若没有被收录则可点击提交至百度，加速收录！(此插件在文章页面仅管理员可见) 
Version: 1.0
Author: Jovae
Author URI: http://www.d4v.com.cn
License: GPL
*/
function d4v($url){
  $url='http://www.baidu.com/s?wd='.$url;
  $curl=curl_init();
  curl_setopt($curl,CURLOPT_URL,$url);
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
  $rs=curl_exec($curl);
  curl_close($curl);
  if(!strpos($rs,'没有找到')){
    return 1;
  }else{
    return 0;
  }
}
add_filter( 'the_content',  'baidu_submit' );
function baidu_submit( $content ) {
  if( is_single() && current_user_can( 'manage_options') )
    if(d4v(get_permalink()) == 1) 
      $content="<p align=right>百度已收录(仅管理员可见)</p>".$content; 
    else 
      $content="<p align=right><b><a style=color:red target=_blank href=http://zhanzhang.baidu.com/sitesubmit/index?sitename=".get_permalink().">百度未收录!点击此处提交</a></b>(仅管理员可见)</p>".$content;  
    return $content;
  }
//美化搜索url
function redirect_search() {
    if (is_search() && !empty($_GET['s'])) {
        wp_redirect(home_url("/search/").urlencode(get_query_var('s')));
        exit();
    }
}
add_action('template_redirect', 'redirect_search');
//页面内写目录
function article_index($content) {
  $matches = array();
  $ul_li = '';
  $r = "/<h4>([^<]+)<\/h4>/im";
  if(preg_match_all($r, $content, $matches)) {
       foreach($matches[1] as $num => $title) {
          $content = str_replace($matches[0][$num], '<strong id="title-'.$num.'">'.$title.'</strong>', $content);
           $ul_li .= '|.<a href="#title-'.$num.'" title="'.$title.'">'.$title."</a><br />\n";
      }
      $content = "\n<div id=\"article-index\">
              <strong>文章目录</strong>
              <ul id=\"index-ul\">\n" . $ul_li . "</ul>
          </div>\n" . $content;
  }
  return $content;
}
add_filter( 'the_content', 'article_index' );
//pinginbaidu
function bdping($post_id) {
    $baiduXML = 'weblogUpdates.extendedPing' . get_option('blogname') . ' ' . home_url() . ' ' . get_permalink($post_id) . ' ' . get_feed_link() . ' ';
    $wp_http_obj = new WP_Http();
    $return = $wp_http_obj->post('http://ping.baidu.com/ping/RPC2', array('body' => $baiduXML, 'headers' => array('Content-Type' => 'text/xml')));
    if(isset($return['body'])){
        if(strstr($return['body'], '0')){
            $noff_log='succeeded!';
        }
        else{
            $noff_log='failed!';
        }
    }else{
        $noff_log='failed!';
    }
}
add_action('publish_post', 'bdping');
// 快速输入表格
// add_shortcode( 'table', 'wpjam_table_shortcode_handler' );
// function wpjam_table_shortcode_handler( $atts, $content='' ) {
//    extract( shortcode_atts( array(
//        'border'        => '1',
//        'cellpading'    => '0',
//        'cellspacing'   => '0',
//        'width'         => ''
//    ), $atts ) );

//    $output = '';

//    $trs = explode("\r\n\r\n", $content);

//     foreach($trs as $tr){
//         $tr = trim($tr);

//         if($tr){
//             $tds = explode("\r\n", $tr);
//             $output .= '<tr>';
//             foreach($tds as $td){
//                 $td = trim($td);
//                 if($td){
//                     $output .= '<td>'.$td.'</td>';
//                 }
//             }
//             $output .= '</tr>';
//         }
//     }

//     if($class){
//         $class = ' class="'.$class.'"';
//     }

//     if($width){
//         $width = ' width="'.$width.'"';
//     }

//     $output = '<table border="'.$border.'" cellpading="'.$cellpading.'" cellspacing="'.$cellspacing.'" '.$width.' '.$class.' >'.$output.'</table>';

//     return $output;
// }
//该首页摘要字数
function new_excerpt_length($length)
{
  return 200;
}
add_filter('excerpt_length', 'new_excerpt_length');
//增强搜索相关性
add_filter('posts_orderby_request', 'wpjam_search_orderby_filter');
function wpjam_search_orderby_filter($orderby = ''){
  if(is_search()){
    global $wpdb;
    $keyword = $wpdb->prepare($_REQUEST['s'],'');
    return "((CASE WHEN {$wpdb->posts}.post_title LIKE '%{$keyword}%' THEN 2 ELSE 0 END) + (CASE WHEN {$wpdb->posts}.post_content LIKE '%{$keyword}%' THEN 1 ELSE 0 END)) DESC, {$wpdb->posts}.post_modified DESC, {$wpdb->posts}.ID ASC";
  }else{
    return $orderby;
  }
}
//文章页面添加摘要
add_action( 'admin_menu', 'my_page_excerpt_meta_box' );
 
function my_page_excerpt_meta_box() {
    add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
}
//查询数据库次数
//add_action( 'wp_footer', 'wpjam_page_speed' );
//function wpjam_page_speed() {
//  date_default_timezone_set( get_option( 'timezone_string' ) );
//  $content  = '[ ' . date( 'Y-m-d H:i:s T' ) . ' ] ';
//  $content .= '页面生成时间 ';
//  $content .= timer_stop( $display = 0, $precision = 2 );
//  $content .= ' 查询 ';
//  $content .= get_num_queries();
//  $content .= ' 次';
//  if( ! current_user_can( 'administrator' ) ) $content = "<!-- $content -->";
//  echo $content;
//}
//去谷歌字体
function remove_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );
/*移除版本*/
function remove_wordpress_version() {
 return ''; 
 } 
 add_filter('the_generator', 'remove_wordpress_version');
//添加版权
//function feed_copyright($content) {
//if(is_single() or is_feed()) {
//$content.= "<blockquote>";
//$content.= '<div>转载请注明：<a href="http://www.rccoder.net/sitemap">www.rccoder.net|若兮为尘</a><br />
//如果你喜欢本文，或者感觉本文对你有帮助，就点击下面的分享按钮，把这篇文章分享出去吧~</div>';
//$content.= '<div> 　» 转载请注明：<a title="楚狂人博客" href="http://www.chukuangren.com">楚狂人博客</a> » <a rel="bookmark" title="'.get_the_title().'" href="'.get_permalink().'">《'.get_the_title().'》</a></div>';
//$content.= '<div>　» 本文链接地址：<a rel="bookmark" title="'.get_the_title().'" href="'.get_permalink().'">'.get_permalink().'</a></div>';
//$content.= "</blockquote>";
//}
//return $content;
//}
//add_filter ('the_content', 'feed_copyright');
//lianjie
add_filter( 'pre_option_link_manager_enabled', '__return_true' ); 
/*搜索关键字高亮*/
function wps_highlight_results($text){
if(is_search()){
$sr = get_query_var('s');
$keys = explode(" ",$sr);
$text = preg_replace('/('.implode('|', $keys) .')/iu', '<stronglight>'.$sr.'</stronglight>', $text);//设置突出关键字样式
}
return $text;
}
add_filter('the_excerpt', 'wps_highlight_results');
add_filter('the_title', 'wps_highlight_results');
/*增强后台编辑*/
function add_more_buttons($buttons) {
$buttons[] = 'fontsizeselect';
$buttons[] = 'styleselect';
$buttons[] = 'fontselect';
$buttons[] = 'hr';
$buttons[] = 'sub';
$buttons[] = 'sup';
$buttons[] = 'cleanup';
$buttons[] = 'image';
$buttons[] = 'code';
$buttons[] = 'media';
$buttons[] = 'backcolor';
$buttons[] = 'visualaid';
return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");
//随机显示后台配色
function Rccoder_random_admin_color(){
  static $color;
  if( isset( $color ) ) return $color;
  $color = array_keys( $GLOBALS['_wp_admin_css_colors'] );
  $color = $color[array_rand( $color )];
  return $color;
}
add_filter( 'get_user_option_admin_color', 'Rccoder_random_admin_color' );
//防止垃圾评论，设定评论最短字符
//function Rccoder_minimal_comment_length( $commentdata ){
//  $minlength = 20;//评论最少字数
//  preg_match_all( '/./u', trim( $commentdata['comment_content'] ), $maxlength );
//  $maxlength = count( $maxlength[0] );
//  if( $maxlength < $minlength ) wp_die( '亲！评论最少需要 ' . $minlength . ' 字~' );
//  return $commentdata;
//}
//add_filter( 'preprocess_comment', 'Rccoder_minimal_comment_length', 8 );
// 更改后台字体为微软雅黑
function Rccoder_admin_lettering(){
    echo'<style type="text/css">
        * { font-family: "Microsoft YaHei" !important; }
        i, .ab-icon, .mce-close, i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page, .qt-fullscreen, .star-rating .star { font-family: dashicons !important; }
        .mce-ico { font-family: tinymce, Arial !important; }
        .fa { font-family: FontAwesome !important; }
        .genericon { font-family: "Genericons" !important; }
        .appearance_page_scte-theme-editor #wpbody *, .ace_editor * { font-family: Monaco, Menlo, "Ubuntu Mono", Consolas, source-code-pro, monospace !important; }
        .post-type-post #advanced-sortables, .post-type-post #autopaging .description { display: none !important; }
        .form-field input, .form-field textarea { width: inherit; border-width: 0; }
        </style>';
}
add_action('admin_head', 'Rccoder_admin_lettering');
//不加载js,还有东西



function E_is_mobile() {



    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {



    return true;



    } elseif ( ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') === false) // many mobile devices (all iPh, etc.)



    || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false



    || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false



    || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false



    || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false



    || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false



    || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {



    return false;



    } else {



    return true;



    }



    }



/** 自动加标签函数 **/



$match_num_from = 1;  // 一个标签在文章中出现少于多少次不添加链接



$match_num_to = 1; // 一篇文章中同一个标签添加几次链接



add_filter('the_content','tag_link',1);



//按长度排序



function tag_sort($a, $b){



	if ( $a->name == $b->name ) return 0;



	return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;



}



//为符合条件的标签添加链接



function tag_link($content){



	global $match_num_from,$match_num_to;



	$posttags = get_the_tags();



	if ($posttags) {



		usort($posttags, "tag_sort");



		foreach($posttags as $tag) {



			$link = get_tag_link($tag->term_id);



			$keyword = $tag->name;



			//链接的代码



			$cleankeyword = stripslashes($keyword);



			$url = "<a href=\"http://zhannei.baidu.com/cse/search?s=10629308063034411426&entry=1&q=$keyword\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('Search %s'))."\"";



			$url .= ' target="_blank"';



			$url .= ">".addcslashes($cleankeyword, '$')."</a>";



			$limit = rand($match_num_from,$match_num_to);



			//不链接的代码



			$content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);



			$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);



			$cleankeyword = preg_quote($cleankeyword,'\'');



			$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;



			$content = preg_replace($regEx,$url,$content,$limit);



			$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);



		}



	}



	return $content;



}
?>