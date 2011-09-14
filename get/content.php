<?php

$url = "http://tq121.weather.com.cn/icbc/detail1.php?city=$_GET[city]"; //目标站
$fp = @fopen($url, "r") or die("超时");
$fcontents = file_get_contents($url);

//eregi("<img src=\"images/20080821.gif\" width=\"480\" height=\"55\" border=\"0\"></a></td>(.*)<td width=\"21\" valign=\"top\">&nbsp;</td>", $fcontents, $regs); //eregi(正则表达式, 内容, 返回的数组); 

eregi("<body LeftMargin=0 TopMargin=0>(.*)</body>", $fcontents, $regs); //eregi(正则表达式, 内容, 返回的数组); 



//print_r ($regs);

$regs[1]=str_replace("src=\"../images/","src=\"http://tq121.weather.com.cn/images/",$regs[1]);//完善图片地址

echo  $regs[1];


?>