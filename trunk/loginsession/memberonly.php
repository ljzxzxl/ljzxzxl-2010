<?php
	session_start();
    if(isset($_SESSION['valid_user']))
        {echo "<h3>ปถำญฃก</h3><br>";
         echo $_SESSION['valid_user']."าัตวยผ";}
    else
    	{echo "ทรฮสสงฐÜฃฌฤใฮดตวยผฃกว๋ทตปุตวยผกฃ<br>";
    	 echo "<a href=\"login.php\">ทตปุตวยผ</a>";}
?>
