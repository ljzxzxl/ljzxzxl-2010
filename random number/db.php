<?php
include ('mysql.class.php');

$db =  new mysql('localhost','root','','test',"utf8");

$db->fun_insert('student','sno,sname,ssex,sage,sdept',"'10','老七','男','22','英语系'");

?>