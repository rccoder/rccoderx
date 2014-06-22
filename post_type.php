<?php   
add_action('init', 'my_custom_init');   
function my_custom_init()    
{   
  $labels = array(   
    'name' => '碎语',   
    'singular_name' => 'singularname',   
    'add_new' => '发表新碎语',   
    'add_new_item' => '发表新碎语',   
    'edit_item' => '编辑碎语',   
    'new_item' => '新碎语',   
    'view_item' => '查 看碎语',   
    'search_items' => '搜索碎语',   
    'not_found' =>  '暂无碎语',   
    'not_found_in_trash' => '没有已遗弃的碎语',    
    'parent_item_colon' => '',   
    'menu_name' => '碎语'   

  );   
  $args = array(   
    'labels' => $labels,   
    'public' => true,   
    'publicly_queryable' => true,   
    'show_ui' => true,    
    'show_in_menu' => true,    
    'query_var' => true,   
    'rewrite' => true,   
    'capability_type' => 'post',   
    'has_archive' => true,    
    'hierarchical' => false,   
    'menu_position' => null,   
    'supports' => array('title','editor','author')   
  );    
  register_post_type('talk',$args);   
}   
?>