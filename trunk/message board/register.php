<?php
	session_start();
	require_once(dirname(__FILE__)."/config.php");
	require_once(dirname(__FILE__)."/mysql.class.php");
	if(isset($_POST['submit']))
	{
		$mysql = "insert into user(username,password,sex,info) values('".$_REQUEST['username']."','".$_REQUEST['password']."','".$_REQUEST['sex']."','".$_REQUEST['info']."')";
		if($dsql->ExecuteNoneQuery($mysql))
		{
			 $_SESSION['valid_user'] = $_REQUEST['username'];
			 echo "<script>";
			 echo "alert('注册成功！');location.href='message.php'";
			 echo "</script>";
		 }else
		 {
			 echo "<script>";
			 echo "alert('注册失败，用户名已存在！');location.href='register.php'";
			 echo "</script>";
		 
		 }
	}
?>

	<meta http-equiv="Content-Type" content="text/html;charset=utf8">
	<title>用户注册</title>
    <div align="center">
	<h1>用户注册</h1>
	<form action="register.php" method="post">
        <table border="0" width="300">
            <tr>
            <td>用户名：</td>
            <td><input type="text" name="username"/></td>
            </tr>
            <tr>
            <td>密码：</td>
            <td><input type="password" name="password"/></td>
            </tr>
            <tr>
            <td>性别：</td>
            <td>
            <input type="radio" name="sex" value="男"/>男
            <input type="radio" name="sex" value="女"/>女
            <input type="radio" name="sex" value="保密" checked/>保密
            </td>
            </tr>
            <tr>
            <td valign=top>个人介绍：</td>
            <td><textarea name="info" cols="20" rows="5"></textarea>
            </td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td>
            <input type="submit" name="submit" value="注册"/>
            <input type="reset" name="reset" value="重置"/>
            <a href="login.php">直接登录</a></td>
            </tr>
        </table>
    </div>
