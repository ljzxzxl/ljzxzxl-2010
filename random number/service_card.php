<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table align="center" width="600" border="1">
  <tr>
    <td>编号</td>
	<td>用户名</td>
    <td>密码</td>
	<td>MD5密码</td>
  </tr>
<?php
include ('mysql.class.php');
$db =  new mysql('localhost','root','inet360','lanzone',"utf8");

function pwd_random(){
	//在10个自然数中取随机数
	$list = 10;
	//取几个不重复的数
	$nu = 6;
	for($s; $s < $list; $s++) {
	$a[] = $s;
	}
	for($i; $i < $nu; $i = $key) {
	for($n = rand(0,($list - 1)); $a[$n] == $n; $a[$n] = $list)
	{
	$key++;
	$num[] = $n;
	}
	}
	$pwd = implode($num);
	return $pwd;
}
for($i=1;$i<=5000;$i++){
?>
  <tr>
    <td><?php echo $a=$i+3000;?></td>
	<td><?php echo $id = "1102".sprintf('%06s', $i);?></td>
    <td><?php echo $pwd = pwd_random();?></td>
	<td><?php echo $pwd_md5 =  md5($pwd);?></td>
  </tr>
<?php
//$db->fun_insert('ecs_user_card','user_name,password,balance,use_start_date,use_end_date,card_end_date',"'$id','$pwd_md5','20.00',1301558400,1335772800,1322553600");
}
?>
</table>