<div id="sidebar">
<div id="sidebarFX">
	<?php
		if(is_single() || is_page()){
			dynamic_sidebar('内页侧边'); 
		}else{
			dynamic_sidebar('侧边');
		}
	?>
</div></div>