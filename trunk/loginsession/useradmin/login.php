<?php
@mysql_connect("localhost", "root","")//ѡ�����ݿ�֮ǰ��Ҫ���������ݿ������
or die("���ݿ����������ʧ��");
@mysql_select_db("boss")//ѡ�����ݿ�mydb
or die("���ݿⲻ���ڻ򲻿���");
//��ȡ�û�����
$username = $_POST['username'];
$password = $_POST['password'];
echo $username;
echo "<br/>";
echo $password;
echo "<br/>";
//ִ��SQL�����Session��ֵ
$query = @mysql_query("select username, userflag,password from users where username = '$username' and password = '$password'")
or die("SQL���ִ��ʧ�ܣ�");
//�ж��û��Ƿ���ڣ������Ƿ���ȷ
if($row = mysql_fetch_array($query))
{
session_start();//��־Session�Ŀ�ʼ
//�ж��û���Ȩ����Ϣ�Ƿ���Ч�����Ϊ1��0��˵����Ч
if($row['userflag'] == 1 or $row['userflag'] == 0)
{
$_SESSION['username'] = $row['username'];
$_SESSION['userflag'] = $row['userflag'];
echo "<a href='main.php' mce_href='main.php'>��ӭ��¼������˴����뻶ӭ����</a>";
}
else //���Ȩ����Ϣ��Ч���������Ϣ
{
echo "�û�Ȩ����Ϣ����ȷ";
}
}
else //����û��������벻��ȷ�����������
{
echo "�û������������";
}
?>
