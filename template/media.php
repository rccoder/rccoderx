<?php if(has_post_format('audio')): // 引语 ?>
		<?php
			$music_url = get_post_meta($post->ID,'play_url',true);
			$music_box = auto_player_urls($music_url);
			echo '<div class="single-media">'.$music_box.'</div>';
		?>
<?php elseif(has_post_format('video')): //视频 ?>
		<?php
			$play_url = get_post_meta($post->ID,'play_url',true);
			echo '<div class="single-media"><embed class="swf_player" src="'.$play_url.'" width="600" height="400" style="margin:0 auto;" type="application/x-shockwave-flash" wmode="transparent"></embed></div>';
		?>	
<?php endif; ?>	