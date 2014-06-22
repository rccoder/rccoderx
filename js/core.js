$(function(){
	//菜单切换效果
	$("#nav .sub-menu,#top_left_menu .sub-menu").hide();
	$("#nav li,#top_left_menu li").hover(function() {
		$(this).children('.sub-menu').stop(false,true).slideDown(200);
	}, function() {
		$(this).children('.sub-menu').stop(false,true).slideUp(200);
	});

	//标题动画效果
	$('.widget-con li:not(.catPost .imglist,.blogroll li),.post-list-title a').hover(function(){
		$(this).css('position','relative').animate({'left':'10px'},200);
	},function(){
		$(this).animate({'left':'0px'},200);
	});

	/*将顶部链接都作为新窗口打开*/
	$('#top a').attr('target','_blank');
	
	/* 滚动组件 */
	$('#roll > .rollTop').click(function(){
		$('body,html').animate({scrollTop:0},800);
	});
	$('#roll > .rollBottom').click(function(){
		$('body,html').animate({scrollTop:$('#rollFooter').offset().top},800);
	});
	
	/*短代码*/
	$(".shortpart-title").click(function(){
		$(this).next('.shortpart-con').slideToggle(200);
	});
	
	/*点击加载*/
	$('.post-list-title a').click(function(){
		$(this).text('正在加载中。。。');
	});
	
	// 导航固定
	$(window).scroll(function(){
		var $top = $(window).scrollTop();
		if($top >= 111){
			$('#nav').css({'position':'fixed','top':'0'});
		}else{
			$('#nav').css({'position':'relative','top':'0'});
		}
	});
	// 代码高亮
	prettyPrint();
	// 内容页链接如无子元素则添加class
	$('#single-con a:not(:has(img))').each(function(index, el) {
		$(this).addClass("link");
	});
	// 文章内所有连接新窗口打开
	$('#single-con a').each(function(index, el) {
		$(this).attr("target",'_blank');
	});
	//slimbox , a标签中以图片格式结尾的都启用slimbox
	$('#single-con a[href$=".jpg"],#single-con a[href$=".png"],#single-con a[href$=".gif"]').slimbox();
});

// 侧边固定
$(function(){
	var $h = $('#sidebarFX').height();
	$(window).scroll(function(){
		var $top = $(window).scrollTop();
		if($top >= $h ){
			if($('#sidebarFX.fd').size() != 1){
				$('#sidebarFX').css({'position':'fixed','top':84}).addClass("fd").hide().fadeIn("400");
				$('#sidebarFX .widget').hide().slice(0,2).show();
			}
		}else{
			$('#sidebarFX').removeClass("fd").css({'position':'relative','top':0});
			$('#sidebarFX .widget').show();
		}
	});
});
	
$(function(){
	// modie
	$('#nav_left_menu>.menu>li>a').each(function(index, el) {
		$('#modie-menu ul').append('<li><a href="'+$(this).attr('href')+'">'+$(this).text()+'</a></li>')
	});

	$('#modie-list').toggle(function(){
		$(this).animate({'background-position-x':-15}, 200).text('菜单');
		$('#modie-menu').animate({'left':'0%'}, 200);
	},function(){
		$(this).animate({'background-position-x':0}, 200).text('首页');
		$('#modie-menu').animate({'left':'-100%'}, 200);
	});

	$('#modie-menu').click(function(){
		$('#modie-list').animate({'background-position-x':0}, 200).text('首页');
		$('#modie-menu').animate({'left':'-100%'}, 200);
	});
	$('#toptobot').click(function(){
		if($(this).hasClass('now')){
			$(this).removeClass('now');
			$('body,html').animate({scrollTop:0},800);
		}else{
			$(this).addClass('now');
			$('body,html').animate({scrollTop:$('#rollFooter').offset().top},800);
		}
	});

});

jQuery.fn.extend({
    /**
     * ctrl+enter提交表单
     * @param {Function} fn 操作后执行的函数
     * @param {Object} thisObj 指针作用域
     */
    ctrlSubmit:function(fn,thisObj){
        var obj = thisObj || this;
        var stat = false;
        return this.each(function(){
            $(this).keyup(function(event){
                //只按下ctrl情况，等待enter键的按下
                if(event.keyCode == 17){
                    stat = true;
                    //取消等待
                    setTimeout(function(){
                        stat = false;
                    },300);
                }  
                if(event.keyCode == 13 && (stat || event.ctrlKey)){
                    fn.call(obj,event);
                }  
            });
        });
    }  
});