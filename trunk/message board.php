<?php
//最基本表单提交的数据，能按原来的格式显示
function htmltocode($content) {
   $content = str_replace("\n", "<br>", str_replace(" ", "&nbsp;", $content));
   return $content;
}


?>