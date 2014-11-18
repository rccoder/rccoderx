<?php get_header(); ?>
<div id="content"><div class="wrap">

<div id="post-list">

<?php include_once 'template/post_list.php'; ?>

<!--?php

if(function_exists('wp_pagenavi')){

wp_pagenavi();

}else{

echo '<div class="wp_page">';

posts_nav_link(' ', $prelabel, $nextlabel);

echo '</div>';

}

?-->

<div class="wp-pagenavi"><?php wp_pagenavi(); ?></div>



</div>

<?php get_sidebar(); ?>

<div class="cc"></div>

</div></div>

<?php get_footer(); ?>