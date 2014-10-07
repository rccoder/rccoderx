<?php
/* $name	 = 基本设置
 * $id		 = 唯一的ID-将写入数据库
 * $type	 = 设置项的类型 【text:文本框】【textarea：多行输入框】【select：选择;val: 数组】【checkbox：开关】
 * $std		 = 设置描述
 * $type	 = 自定义【z_c:开关;z_text:输入框;z_textarea:多行输入框；z_select:选择;z_info:描述信息】
 */
$themeSet_tagname = '<a class="d_tab_on">基本设置</a><a>SNS</a><a>广告系统</a>';
$options = array (
//基本设置
array( "name" => "基本设置","type" => "section","desc" => "主题的基本设置"),

	array( "name" => "公告","type" => "tit"),
	array( "id" => "Rcloud_notice","type" => "textarea","std" => "输入你的网站公告，将显示在公告位置"),

	array( "name" => "缩略图","type" => "tit"),
	array( "id" => "Rcloud_timthumb_b","type" => "checkbox" ),
	array( "id" => "Rcloud_timthumb","type" => "z_info","std" => "是否开启缩略图功能，支持站外外链图片。开启后图片会被缓存到服务器，会占用服务器资源，请慎重考虑。"),
	
	array( "name" => "网站描述","type" => "tit"),
	array( "id" => "Rcloud_description","type" => "text","std" => "输入你的网站描述，一般不超过200个字符"),
	
	array( "name" => "网站关键字","type" => "tit"),
	array( "id" => "Rcloud_keywords","type" => "text","std" => "输入你的网站关键字"),
	
	array( "name" => "流量统计代码","type" => "tit"),
	array( "id" => "Rcloud_track_b","type" => "checkbox" ),
	array( "id" => "Rcloud_track","type" => "textarea","std" => "直接将统计代码放置在此，点保存后生效"),
	
	array( "name" => "备案信息","type" => "tit"),
	array( "id" => "Rcloud_beian","type" => "checkbox" ),
	array( "id" => "Rcloud_beianhao","type" => "textarea","std" => "这里填写你的备案号码"),

array( "type" => "endtag"),

//sns
array( "name" => "sns","type" => "section","desc" => "SNS社区设置"),

	array("name"=>"订阅地址","type"=>"tit"),
	array( "id" => "Rcloud_feed_c","type" => "checkbox"),
	array( "id" => "Rcloud_feed","type" => "text"),
	
	array("name"=>"新浪微博","type"=>"tit"),
	array( "id" => "Rcloud_weibo_c","type" => "checkbox"),
	array( "id" => "Rcloud_weibo","type" => "text"),
		
	array("name"=>"腾讯微博","type"=>"tit"),
	array( "id" => "Rcloud_qweibo_c","type" => "checkbox"),
	array( "id" => "Rcloud_qweibo","type" => "text"),
	
	array("name"=>"豆瓣","type"=>"tit"),
	array( "id" => "Rcloud_douban_c","type" => "checkbox"),
	array( "id" => "Rcloud_douban","type" => "text"),
	
	array("name"=>"QQ","type"=>"tit"),
	array( "id" => "Rcloud_qq_c","type" => "checkbox"),
	array( "id" => "Rcloud_qq","type" => "text"),

array( "type" => "endtag"),

//广告
array( "name" => "sns","type" => "section","desc" => "广告系统"),

	array( "name" => "文章列表广告","type" => "tit"),
	array( "id" => "Rcloud_list_ad_c","type" => "checkbox" ),
	array( "id" => "Rcloud_list_ad","type" => "textarea","std" => "文章列表广告，显示在列表的第一篇文章后面"),
	
	array( "name" => "文章头部广告","type" => "tit"),
	array( "id" => "Rcloud_signleTop_ad_c","type" => "checkbox" ),
	array( "id" => "Rcloud_signleTop_ad","type" => "textarea","std" => "文章头部广告，显示在文章信息栏下方"),
	
	array( "name" => "文章底部广告","type" => "tit"),
	array( "id" => "Rcloud_signleBot_ad_c","type" => "checkbox" ),
	array( "id" => "Rcloud_signleBot_ad","type" => "textarea","std" => "文章底部广告，显示在版权声明上方"),

array( "type" => "endtag")

);
?>