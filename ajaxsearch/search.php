<?php
if($_GET["action"]!=''){
   $keyword=$_GET["keyword"];
   $keyword=str_replace("[","[[]",$keyword);
   $keyword=str_replace("&","[&]",$keyword);
   $keyword=str_replace("%","[%]",$keyword);
   $keyword=str_replace("^","[^]",$keyword);
   $conn=mysql_connect("localhost","root","inet360");
   @mysql_select_db("test") or die('sorry');
   mysql_query('set names utf-8');
   $sql="select title,hits from suggest where title like '%".$keyword."%' order by hits desc limit 10";
   $result=mysql_query($sql);
   if($result){
	  $i=1;$title='';$hits='';
	  while($row=mysql_fetch_array($result,MYSQL_BOTH))
	  {
     $title=$title.$row['title'];
		 $hits=$hits.$row['hits'];
	  if($i<mysql_num_rows($result))
		{
		 $title=$title."|";
		 $hits=$hits."|";
		}
		$i++;
    }
   }
   mysql_close();
}
?>
<?php echo $title.'$'.$hits;?>
