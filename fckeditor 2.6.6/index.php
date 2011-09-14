<?php
include ('fckeditor.php');

echo $sBasePatch = $_SERVER['PHP_SELF'];
echo "<br/>";
echo $sBasePatch = dirname($sBasePatch).'/';		//路径配置

$ed= new FCKeditor('con');
$ed->BasePath=$sBasePatch;
//$ed->ToolbarSet='Basic';
$ed->ToolbarSet='Default';
if(@$_POST[sub]){
		echo "标题".$_POST['title'];
		echo "FCK内容".$_POST['con'];
	 }
?>

<form action="" method="post">

<input type="text" name="title" value="">
<?php

$ed->Value='<b>初始值</b>';
$ed->Create();

?>
<input type="submit" name="sub" value="添加新闻">

</form>