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
        {echo "<h3>��ӭ��</h3><br>";
         echo $_SESSION['valid_user']."�ѵ�¼";}
    else
    	{echo "�û���������������ʧ�ܣ���δ��¼���뷵�ص�¼��<br>";
    	 echo "<a href=\"login.php\">���ص�¼</a>";}
}

else if(isset($_SESSION['valid_user']))
    {echo "<h3>��ӭ��</h3><br>";
     echo $_SESSION['valid_user']."�ѵ�¼";}

else{echo "����������session��Ϣ";}
?>
<html>
<head></head>
<form method="post" action="login.php">
     �û�����
     <input type="text" name="name"/><br>
     ���룺
     <input type="password" name="passwd"/><br>
     <input type="submit" value="��¼" />
</form>
</html>
