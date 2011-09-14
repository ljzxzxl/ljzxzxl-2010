<?php
if(@$_GET[id]){
	 sleep(1);
	 $conn=mysql_connect('localhost','root','inet360');
	 mysql_select_db('test',$conn) or die('数据库连接失败');

	 $sql="select sname from student where sname='$_GET[id]'";
	 $q=mysql_query($sql) or die(' 查询失败');

	 if(is_array(mysql_fetch_row($q))){
		echo "<font color=red>用户名已经存在</font>";
	 }else
	 {
	   echo "<font color=green>可以使用</font>";
	 }
}
?>