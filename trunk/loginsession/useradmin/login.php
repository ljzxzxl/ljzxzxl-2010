<?php
@mysql_connect("localhost", "root","")//选择数据库之前需要先连接数据库服务器
or die("数据库服务器连接失败");
@mysql_select_db("boss")//选择数据库mydb
or die("数据库不存在或不可用");
//获取用户输入
$username = $_POST['username'];
$password = $_POST['password'];
echo $username;
echo "<br/>";
echo $password;
echo "<br/>";
//执行SQL语句获得Session的值
$query = @mysql_query("select username, userflag,password from users where username = '$username' and password = '$password'")
or die("SQL语句执行失败！");
//判断用户是否存在，密码是否正确
if($row = mysql_fetch_array($query))
{
session_start();//标志Session的开始
//判断用户的权限信息是否有效，如果为1或0则说明有效
if($row['userflag'] == 1 or $row['userflag'] == 0)
{
$_SESSION['username'] = $row['username'];
$_SESSION['userflag'] = $row['userflag'];
echo "<a href='main.php' mce_href='main.php'>欢迎登录，点击此处进入欢迎界面</a>";
}
else //如果权限信息无效输出错误信息
{
echo "用户权限信息不正确";
}
}
else //如果用户名和密码不正确，则输出错误
{
echo "用户名或密码错误";
}
?>
