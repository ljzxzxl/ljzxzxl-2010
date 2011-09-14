<?php
$user=$_POST[user];
$pwd=md5(trim($_POST[pwd]));

if($_POST[submit]) {

     if(($user=='123')&&($pwd='123123')) {

   setcookie('id',$user);
   setcookie('pwd',$pwd);
  

   echo "<script language='javascript'>location.href='list9.php'</script>";
      } else{
   echo "登陆失败";
      }
}

if($_GET[out]==out) {
   setcookie('id',"");
   setcookie('pwd',"");
   }
?>

<script language='javascript'>
function checkbox() {
   if(myform.user.value=='') {
    alert('你的用户名不能为空');
    myform.user.focus();
    return false;
   }
         if(myform.pwd.value.length<3) {
    alert('你的密码不能少于3位');
    myform.pwd.focus();
    return false;
   }
}
</script>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<form action='' method='post' name='myform' onsubmit='return checkbox();'>
用户：<input type='text' name='user'><br>
密码：<input type='password' name='pwd'><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit name=submit value='登陆'>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=reset name=reset value='重置'>
</from>