<?
require_once ('email.class.php');
//##########################################
$smtpserver = "smtp.126.com";//SMTP������
$smtpserverport =25;//SMTP�������˿�
$smtpusermail = "ljzxzxl2@126.com";//SMTP���������û�����
$smtpemailto = "ljzxzxl@gmail.com";//���͸�˭
$smtpuser = "ljzxzxl2";//SMTP���������û��ʺ�
$smtppass = "^&vzxl17@?";//SMTP���������û�����
$mailsubject = "PHP100�����ʼ�ϵͳ";//�ʼ�����
$mailbody = "<h1> ����һ�����Գ��� PHP100.com </h1>";//�ʼ�����
$mailtype = "HTML";//�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�
##########################################
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
$smtp->debug = true;//�Ƿ���ʾ���͵ĵ�����Ϣ
$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
?>