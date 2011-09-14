<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<?php

if(isset($_COOKIE[id]) && isset($_COOKIE[pwd])) {
          echo "欢迎你，".$_COOKIE[id]."登陆成功! &nbsp&nbsp&nbsp&nbsp<a href=login.php?out=out>退出</a>";

} else {
           echo "您还未登陆，请<a href='login.php'>登陆</a>!";
}
?>