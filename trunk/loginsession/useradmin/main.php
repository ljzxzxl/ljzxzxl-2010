<?php
session_start();
echo $_SESSION['username'];
if(isset($_SESSION['username']))
{
	@mysql_connect("localhost", "root","")//ѡ�����ݿ�֮ǰ��Ҫ���������ݿ������
	or die("���ݿ����������ʧ��");
	@mysql_select_db("boss")//ѡ�����ݿ�mydb
	or die("���ݿⲻ���ڻ򲻿���");
	//��ȡSession
	$username = $_SESSION['username'];
	//ִ��SQL�����userflag��ֵ
	$query = @mysql_query("select userflag from users where username = '$username'")
	or die("SQL���ִ��ʧ��");
	$row = mysql_fetch_array($query);
	//�жϵ�ǰ���ݿ��е�Ȩ����Ϣ��Session�е���Ϣ�Ƚϣ������ͬ�����Session����Ϣ
	if($row['userflag'] != $_SESSION['userflag'])
	{$_SESSION['userflag'] = $row['userflag'];}
	//����Session��ֵ�����ͬ�Ļ�ӭ��Ϣ
	if($_SESSION['userflag'] == 1)
	{echo "��ӭ����Ա".$_SESSION['username']."��¼ϵͳ";}
	if($_SESSION['userflag'] == 0)
	{echo "��ӭ�û�".$_SESSION['username']."��¼ϵͳ";}
	echo "<a href='logout.php' mce_href='logout.php'>ע��</a>";
}
else{echo "��û��Ȩ�޷��ʱ�ҳ��";}
?>
