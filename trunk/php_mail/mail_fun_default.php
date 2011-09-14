<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
if(@mail("ljzxzxl@gmail.com","邮件标题","邮件内容")){
	echo "支持mail()，邮件发送成功！";
}else{
	echo "不支持mail()，邮件发送失败！";
}
?>