<?php
	session_start();
	require_once(dirname(__FILE__)."/config.php");
	require_once(dirname(__FILE__)."/mysql.class.php");
	if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
	{
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		
		$mysql = "select * from user where username='".$username."'";
		if($a_info = $dsql->GetOne($mysql))
			{
				$realpassword = $a_info['password'];
				if($realpassword==$password)
					{
					 $_SESSION['valid_user'] = $username;
					 echo "<script>";
					 echo "location.href='message.php'";
					 echo "</script>";					
					}
				else echo "抱歉，密码错误！";
			}
		else echo "抱歉，此用户名不存在！";
	}
	
	else if(isset($_SESSION['valid_user']))
		{echo "<script>";
		 echo "location.href='message.php'";
		 echo "</script>";}
	else{echo "本机不存在session信息,未自动登录";}
?>


<meta http-equiv="Content-Type" content="text/html;charset=utf8">
<title>用户登录</title>

<center>
<h1>用户登录</h1>
<form method="post" action="login.php">
<table border=0>
	<tr>
		<td>用户名：</td>
		<td><input type="text" name="username"/></td>
	</tr>
    <tr>
		<td>密码：</td>
		<td><input type="password" name="password"/></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td colspan="2"><input type="submit" value="登录" /><a href="register.php">点击注册</a></td>
	</tr>
</form>
</center>