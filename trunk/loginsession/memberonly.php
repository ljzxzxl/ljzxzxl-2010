<?php
	session_start();
    if(isset($_SESSION['valid_user']))
        {echo "<h3>��ӭ��</h3><br>";
         echo $_SESSION['valid_user']."�ѵ�¼";}
    else
    	{echo "����ʧ�ܣ���δ��¼���뷵�ص�¼��<br>";
    	 echo "<a href=\"login.php\">���ص�¼</a>";}
?>
