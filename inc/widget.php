<?php
$theme_name='Rcloud';
/***********************
 * 小工具页面
************************/
 /*热门标签*/
class hotTag extends WP_Widget {
    /** 构造函数 */
    function hotTag() {
    	global $theme_name;
        parent::WP_Widget(false, $name = '热门标签('.$theme_name.')');	
    }

    /*输出工具内容*/
    function widget($args, $instance) {		
        extract( $args );
        ?>
              <?php echo $before_widget; ?>
				<h3 class="widget-title"><?php echo  $instance['title']; ?></h3>
                <div class="widget-line"></div>
                <div class="hotTag"><?php wp_tag_cloud('smallest=12&largest=12&unit=px&number='.$instance['Num'].'&orderby=count&order=DESC'); ?></div>
              <?php echo $after_widget; ?>
        <?php
    }

    /** 选项保存过程 */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** 在管理界面输出选项表单 */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$Num = esc_attr($instance['Num']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('Num'); ?>">数量：</label><input class="widefat" id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" /></p>
			<?php 
    }

} 
add_action('widgets_init', create_function('', 'return register_widget("hotTag");'));



/***********************
 * 随机文章
 ***********************/
class randPost extends WP_Widget {
    /** 构造函数 */
    function randPost() {
    	global $theme_name;
        parent::WP_Widget(false, $name = '随机文章('.$theme_name.')');	
    }

    /*输出工具内容*/
    function widget($args, $instance) {		
        extract( $args );
        ?>
<?php echo $before_widget; ?>
<h3 class="widget-title"><?php echo  $instance['title']; ?></h3>
<div class="widget-line"></div>
<ul class="randPost">
<?php
$args = array('orderby' => 'rand', 'post__not_in' => array($post->ID), 'showposts' => $instance['Num'],'caller_get_posts'=>1);
$query_posts = new WP_Query();
$query_posts->query($args);
?>
<?php while ($query_posts->have_posts()) : $query_posts->the_post(); ?>
<li><a href=" <?php the_permalink(); ?> " title=" <?php the_title(); ?> "> <?php the_title(); ?> </a></li>
<?php endwhile; ?>
</ul>
					  
              <?php echo $after_widget; ?>
        <?php
    }

    /** 选项保存过程 */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** 在管理界面输出选项表单 */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$Num = esc_attr($instance['Num']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('Num'); ?>">数量：</label><input class="widefat" id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" /></p>
			<?php 
    }

} 
add_action('widgets_init', create_function('', 'return register_widget("randPost");'));


/*****************************
 * 指定分类调用文章
 ******************************/
class thisCategory extends WP_Widget {
    /** 构造函数 */
    function thisCategory() {
    	global $theme_name;
        parent::WP_Widget(false, $name = '指定分类('.$theme_name.')');	
    }

    /*输出工具内容*/
    function widget($args, $instance) {		
        extract( $args );
        ?>
<?php echo $before_widget; ?>
<h3 class="widget-title"><?php echo  $instance['title']; ?></h3>
<div class="widget-line"></div>
<ul class="catPost">
<?php
$query_posts = new WP_Query('caller_get_posts=1&showposts='.$instance['Num'].'&cat='.$instance['cat']);
?>
<?php while ($query_posts->have_posts()) : $query_posts->the_post(); ?>
<?php if($instance['style'] == "img"){ ?>
<li class="imglist"><a href=" <?php the_permalink(); ?> " title=" <?php the_title(); ?> "><?php post_thumbnail(145,90); ?><?php the_title(); ?> </a></li>
<?php }elseif($instance['style'] == "text"){ ?>
<li class="textlist"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php  }; endwhile; ?>
</ul>
					  
              <?php echo $after_widget; ?>
        <?php
    }

    /** 选项保存过程 */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** 在管理界面输出选项表单 */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$Num = esc_attr($instance['Num']);
		$style = esc_attr($instance['style']);
		$cat = esc_attr($instance['cat']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('Num'); ?>">数量：</label><input id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('cat'); ?>">分类ID：</label><input id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text"  value="<?php echo $cat; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('Num'); ?>">样式：</label>
			<select for="<?php echo $this->get_field_id('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" >
				<option value="img" <?php if($style == "img"){ echo("selected='selected'"); } ?>>图片</option>
				<option value="text" <?php if($style == "text"){ echo("selected='selected'"); } ?>>文字</option>
			</select>
			</p>
			<?php 
    }

} 
add_action('widgets_init', create_function('', 'return register_widget("thisCategory");'));


/********************************
 * 相关文章
 ********************************/
class relevance extends WP_Widget {
    /** 构造函数 */
    function relevance() {
    	global $theme_name;
        parent::WP_Widget(false, $name = '相关文章('.$theme_name.')');	
    }

    /*输出工具内容*/
    function widget($args, $instance) {		
        extract( $args );
        ?>
<?php echo $before_widget; ?>
<h3 class="widget-title"><?php echo  $instance['title']; ?></h3>
<div class="widget-line"></div>
<ul class="catPost">
<?php
$post_tags = wp_get_post_tags($post->ID);
if ($post_tags) {
foreach ($post_tags as $tag){
    // 获取标签列表
    $tag_list[] .= $tag->term_id;
}
}
$post_tag = $tag_list[ rand(0, count($tag_list) - 1) ];
$query_posts = new WP_Query('orderby=rand&caller_get_posts=1&showposts='.$instance['Num'].'&tag_in='.$post_tag);
?>
<?php while ($query_posts->have_posts()) : $query_posts->the_post(); ?>
<?php if($instance['style'] == "img"){ ?>
<li class="imglist"><a href=" <?php the_permalink(); ?> " title=" <?php the_title(); ?> ">
    <?php
        if(dopt('Rcloud_timthumb_b')){
             post_thumbnail(145,90);
        }else{
            the_img();
        }

    ?>
<?php the_title(); ?> </a></li>
<?php }elseif($instance['style'] == "text"){ ?>
<li class="textlist"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
<?php  }; endwhile; ?>
</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    /** 选项保存过程 */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** 在管理界面输出选项表单 */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$Num = esc_attr($instance['Num']);
		$style = esc_attr($instance['style']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">标题：<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('Num'); ?>">数量：</label><input class="widefat" id="<?php echo $this->get_field_id('Num'); ?>" name="<?php echo $this->get_field_name('Num'); ?>" type="text"  value="<?php echo $Num; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('Num'); ?>">样式：</label>
			<select for="<?php echo $this->get_field_id('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" >
				<option value="img" <?php if($style == "img"){ echo("selected='selected'"); } ?>>图片</option>
				<option value="text" <?php if($style == "text"){ echo("selected='selected'"); } ?>>文字</option>
			</select>
			</p>
			<?php 
    }

} 
add_action('widgets_init', create_function('', 'return register_widget("relevance");'));

/***************************
 * 广告
 ****************************/
class AD extends WP_Widget {
    /** 构造函数 */
    function AD() {
    	global $theme_name;
        parent::WP_Widget(false, $name = '边栏广告('.$theme_name.')');	
    }

    /*输出工具内容*/
    function widget($args, $instance) {		
        extract( $args );
        ?>
              <?php echo $before_widget; ?>
                  
<div class="ad">
	<h3 class="widget-title">赞助</h3>
	<div class="p10"><center><?php echo $instance['html']; ?></center></div>
</div>
              <?php echo $after_widget; ?>
        <?php
    }

    /** 选项保存过程 */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** 在管理界面输出选项表单 */
    function form($instance) {				
		$Num = esc_attr($instance['html']);
        ?>
      
			<p><textarea style="width: 100%;" id="<?php echo $this->get_field_id('html'); ?>" name="<?php echo $this->get_field_name('html'); ?>" ><?php echo $Num; ?></textarea></p>
			<?php 
    }

} 
add_action('widgets_init', create_function('', 'return register_widget("AD");'));

/***************************
 * 最新评论
 **************************/
class widget_newcomments extends WP_Widget {
	function widget_newcomments() {
		$option = array('classname' => 'widget_newcomments', 'description' => '显示网友最新评论（头像+名称+评论）' );
		$this->WP_Widget(false, '最新评论（Rcloud） ', $option);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '最新评论' : apply_filters('widget_title', $instance['title']);
		$count = empty($instance['count']) ? '5' : apply_filters('widget_count', $instance['count']);

		echo $before_title . $title . $after_title;
		echo '<ul class="newcomments">';
		echo mod_newcomments( $count );
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		$title = strip_tags($instance['title']);
		$count = strip_tags($instance['count']);

		echo '<p><label>标题：<input id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" size="24" /></label></p>';
		echo '<p><label>数目：<input id="'.$this->get_field_id('count').'" name="'.$this->get_field_name('count').'" type="text" value="'.attribute_escape($count).'" size="3" /></label></p>';
	}
}

function mod_newcomments( $limit ){
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, 
	SUBSTRING(comment_content,1,24) AS com_excerpt
	FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1'
	AND comment_type = ''
	AND post_password = ''
    AND user_id = '0'
	ORDER BY comment_date_gmt DESC LIMIT $limit ";
	$comments = $wpdb->get_results($sql);
	foreach ( $comments as $comment ) {
		$output .= "<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"" . $comment->post_title . "上的评论\">". get_avatar( $comment->comment_author_email, $size = '40') . "<strong>". strip_tags($comment->comment_author) ."：</strong><span>". strip_tags($comment->com_excerpt) ."</span></a></li>";
	}
	echo $output;
};
add_action('widgets_init', create_function('', 'return register_widget("widget_newcomments");'));

/***************************
 * 网站统计
 **************************/
class widget_tongji extends WP_Widget {
	function widget_tongji() {
		$option = array('classname' => 'widget_tongji', 'description' => '网站统计（Rcloud）' );
		$this->WP_Widget(false, '网站统计（Rcloud） ', $option);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '最新评论' : apply_filters('widget_title', $instance['title']);
		$time = empty($instance['time']) ? '建站日期' : apply_filters('widget_count', $instance['time']);

		echo $before_title . $title . $after_title;
        echo '<div class="widget-line"></div>';
		echo '<ul class="tongji">';?>
			<li>文章总数：<?php $count_posts = wp_count_posts();echo $published_posts = $count_posts->publish;?>篇</li>
            <li>评论总数：<?php $count_comments = get_comment_count();echo $count_comments['approved'];?>条</li>
            <li>页面总数：<?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?> 个</li>
            <li>分类总数：<?php echo $count_categories = wp_count_terms('category'); ?>个</li>
            <li>标签总数：<?php echo $count_tags = wp_count_terms('post_tag'); ?>个</li>
            <li>运行天数：<?php echo floor((time()-strtotime($time))/86400); ?> 天</li>
		<?php 
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['time'] = strip_tags($new_instance['time']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		$title = strip_tags($instance['title']);
		$time = strip_tags($instance['time']);

		echo '<p><label>标题：<input id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" size="24" /></label></p>';
		echo '<p><label>建站日期：<input id="'.$this->get_field_id('time').'" name="'.$this->get_field_name('time').'" type="text" value="'.attribute_escape($time).'" size="24" /></label></p>';
	}
}
add_action('widgets_init', create_function('', 'return register_widget("widget_tongji");'));
?>