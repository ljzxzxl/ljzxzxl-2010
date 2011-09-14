<?php
/*
 * Notes: MySQL Class
 * Author: Xeylon Zhou
 * Contact: blog.ljzxzxl.com
 * E-mail: ljzxzxl@gmail.com
 * Date: 2010/12/03
 */
class mysql{

     private $host;
     private $name;
     private $pass;
     private $db;
     private $charset;

     function __construct($host,$name,$pass,$db,$charset)
	{
     	$this->host=$host;
     	$this->name=$name;
     	$this->pass=$pass;
     	$this->db=$db;
     	$this->charset=$charset;
     	$this->connect();
     }

     function connect()
	{
      $link=mysql_connect($this->host,$this->name,$this->pass) or die ($this->error());
      mysql_select_db($this->db,$link) or die("没该数据库：".$this->db);
      mysql_query("SET NAMES '$this->charset'");     //设置数据库连接编码模式
     }

	function query($sql, $type = '')
	{
	    if(!($query = mysql_query($sql))) $this->show('Say:', $sql);
	    return $query;
	}

    function show($message = '', $sql = '')
	{
		if(!$sql) echo $message;
		else echo $message.'<br>'.$sql;
	}

    function affected_rows()
	{
		return mysql_affected_rows();
	}

	function result($query, $row)
	{
		return mysql_result($query, $row);
	}

	function num_rows($query)
	{
		return @mysql_num_rows($query);
	}

	function num_fields($query)
	{
		return mysql_num_fields($query);
	}

	function free_result($query)
	{
		return mysql_free_result($query);
	}

	function insert_id()
	{
		return mysql_insert_id();
	}

	function fetch_row($query)
	{
		return mysql_fetch_row($query);
	}

	function version()
	{
		return mysql_get_server_info();
	}

	function close()
	{
		return mysql_close();
	}

    function fun_insert($db,$name,$value){
    	$this->query("insert into $db ($name) value ($value)");
    }
}
?>