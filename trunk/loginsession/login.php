<?php
session_start();
if(isset($_POST['name']) && isset($_POST['passwd']))
{
    $username = $_POST['name'];
    $password = $_POST['passwd'];

    if($username == '123' && $password == '123')
      {$_SESSION['valid_user'] = $username;}
    //require("memberonly.php");
    if(isset($_SESSION['valid_user']))
        {echo "<h3>欢迎！</h3><br>";
         echo $_SESSION['valid_user']."已登录";}
    else
    	{echo "用户名或密码错误访问失败，你未登录！请返回登录。<br>";
    	 echo "<a href=\"login.php\">返回登录</a>";}
}

else if(isset($_SESSION['valid_user']))
    {echo "<h3>欢迎！</h3><br>";
     echo $_SESSION['valid_user']."已登录";}

else{echo "本机不存在session信息";}
?>
<html>
<head></head>
<form method="post" action="login.php">
     用户名：
     <input type="text" name="name"/><br>
     密码：
     <input type="password" name="passwd"/><br>
     <input type="submit" value="登录" />
</form>
</html>
