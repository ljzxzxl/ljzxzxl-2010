<?php
$dbms='mysql'; //数据库类型 Oracle 用ODI，方便使用不同的数据库
$host='localhost'; //数据库主机名
$dbname='test'; //使用的数据库
$user='root'; //数据库连接用户名
$pass=''; //对应的密码
$dsn="$dbms:host=$host;dbname=$dbname";
$con=array(PDO::ATTR_PERSISTENT => true);//如果需要数据库长连接，可加上此参数


class db extends PDO {
    public function __construct(){
        try {
            parent::__construct("$GLOBALS[dsn]", $GLOBALS['user'], $GLOBALS['pass'], $GLOBALS['con']);
         } catch (PDOException $e) {
         die("Error: " . $e->__toString() . "<br/>");
        }
    }
    public final function query($sql){
        try {
            return parent::query($this->setString($sql));
        }catch (PDOException $e){
            die("Error: " . $e->__toString() . "<br/>");
        }
    }
    private final function setString($sql){
		echo "执行：".$sql."<br/>";
        return $sql;
    }
}

//********************************************************************
//实例化对象并执行SQL语句
$db=new db();
$db->exec("set names utf8;");
$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);

$query=$db->query('SELECT * from blog');
$query->setFetchMode(PDO::FETCH_ASSOC);
while($result_arr=$query->fetch())
{
	print_r ($result_arr);
	echo "<br/>";
	echo $result_arr['id'].$result_arr['title'].$result_arr['author'].$result_arr['time'].$result_arr['content'].$result_arr['permission'];
	echo "<br/>";
}

//$db->exec('DELETE FROM  blog where id=1');

?>