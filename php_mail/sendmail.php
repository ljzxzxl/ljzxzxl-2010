<?
require_once ('email.class.php');
//##########################################
$smtpserver = "smtp.126.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "ljzxzxl2@126.com";//SMTP服务器的用户邮箱
$smtpemailto = "ljzxzxl@gmail.com";//发送给谁
$smtpuser = "ljzxzxl2";//SMTP服务器的用户帐号
$smtppass = "^&vzxl17@?";//SMTP服务器的用户密码
$mailsubject = "PHP100测试邮件系统";//邮件主题
$mailbody = "<h1> 这是一个测试程序 PHP100.com </h1>";//邮件内容
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
##########################################
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = true;//是否显示发送的调试信息
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
?>