<?php
include ('mysql.class.php');

$db =  new mysql('localhost','root','inet360','test',"utf8");

$db->fun_insert('student','sid,sname,ssex',"'10','老七','男'");

?>