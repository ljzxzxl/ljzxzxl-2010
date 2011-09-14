<?php
session_start();
echo $_SESSION['username'];
if(isset($_SESSION['username']))
{
	@mysql_connect("localhost", "root","")//选择数据库之前需要先连接数据库服务器
	or die("数据库服务器连接失败");
	@mysql_select_db("boss")//选择数据库mydb
	or die("数据库不存在或不可用");
	//获取Session
	$username = $_SESSION['username'];
	//执行SQL语句获得userflag的值
	$query = @mysql_query("select userflag from users where username = '$username'")
	or die("SQL语句执行失败");
	$row = mysql_fetch_array($query);
	//判断当前数据库中的权限信息与Session中的信息比较，如果不同则更新Session的信息
	if($row['userflag'] != $_SESSION['userflag'])
	{$_SESSION['userflag'] = $row['userflag'];}
	//根据Session的值输出不同的欢迎信息
	if($_SESSION['userflag'] == 1)
	{echo "欢迎管理员".$_SESSION['username']."登录系统";}
	if($_SESSION['userflag'] == 0)
	{echo "欢迎用户".$_SESSION['username']."登录系统";}
	echo "<a href='logout.php' mce_href='logout.php'>注销</a>";
}
else{echo "您没有权限访问本页面";}
?>
