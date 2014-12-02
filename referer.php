<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>go………………</title>
<style>
html,body{
    font-size:12px;
    overflow:hidden
}
body{
    padding:0 0 0 0;
    font-size:12px;
    margin:0;
    height:100%;
}
#barframe{
    width:100%;
    height:100%;
    z-index:3;
    position:absolute
}
</style>
</head>
<body>
<?php
if( isset($_GET['go']) || isset($_GET['referer']) ) {
echo "<iframe noresize=\"noresize\" frameborder=\"0\" src=".strip_tags($_GET['go'])." id=\"barframe\"></iframe>";
}else echo '错误的参数';
?>
<div style="display:none">
统计代码
</div>
</body>
</html>