<?php
$dbms='mysql'; //数据库类型 Oracle 用ODI，方便使用不同的数据库
$host='localhost'; //数据库主机名
$dbname='test'; //使用的数据库
$user='root'; //数据库连接用户名
$pass=''; //对应的密码
$dsn="$dbms:host=$host;dbname=$dbname";
$con=array(PDO::ATTR_PERSISTENT => true);//如果需要数据库长连接，可加上此参数

try {
	$pdo = new PDO($dsn, $user, $pass,$con);
	//$pdo->query("set names utf8;");
	$pdo->exec("set names utf8;");
	echo "数据库连接成功！<br/>";
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}



//********************************************************************
//实例化对象并执行SQL语句

//exec()主要是针对没有记录结果返回的操作（增，删，改）
$pdo->exec("insert into blog (title,author,time,content,permission) value ('标题','作者','时间','内容','公开')");
//echo $pdo->lastinsertid();

//query()主要用于有记录结果返回的操作（查）

$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
/*设置属性
PDO::CASE_LOWER--强制列名是小写
PDO::CASE_NATURAL--列名按照原始的方式
PDO::CASE_UPPER--强制列名为大写
*/


$mysql="select * from blog";
$query = $pdo->query($mysql);


$query->setFetchMode(PDO::FETCH_ASSOC);
/*
PDO::FETCH_ASSOC--关联数组形式
PDO::FETCH_NUM--数字索引数组形式
PDO::FETCH_BOTH--两者数组形式都有，这是缺省的
PDO::FETCH_OBJ--按照对象的形式，类似于以前的mysql_fetch_object()
*/

//$result_arr = $query->fetchAll();
//print_r($result_arr);

//echo $col= $query->fetchColumn();

while($result_arr=$query->fetch())
{
	print_r ($result_arr);
	echo "<br/>";
	echo $result_arr['id'].$result_arr['title'].$result_arr['author'].$result_arr['time'].$result_arr['content'].$result_arr['permission'];
	echo "<br/>";
}

?>