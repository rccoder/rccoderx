jQuery(function(){
	var weburl = 'http://eryumusic.com';
	jQuery.get(weburl+'/wp-admin/edit.php?post_status=future&post_type=post','html',function(data){
		var lastTime = jQuery(data).find('#the-list .date abbr:first').text();
		if(lastTime){
			jQuery('#timestampdiv').append('<p>上一篇定时文章的日期是<b style="color:#f00;margin-left:10px;">'+lastTime+'</b></p>');
		}else{
			jQuery('#timestampdiv').append('<p>当前没有定时的文章</p>');
		}
	});
});
