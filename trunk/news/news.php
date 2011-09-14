<?php
	if(isset($_POST["submit"]))
	{
		echo "$_REQUEST[title]";
		echo "<br/>";
		echo "$_REQUEST[author]";
		echo "<br/>";
		date_default_timezone_set("PRC");
		echo $time=date("Y-m-d H:i");
		echo "<br/>";
		echo "$_REQUEST[content]";
		echo "<br/>";
	}
	date_default_timezone_set("PRC");
	$time=date("Y-m-d H:i");
	require_once(dirname(__FILE__)."/config.php");
	require_once(dirname(__FILE__)."/mysql.class.php");
	$mysql="select * from news order by id desc limit 5";
	$dsql->Execute('a_list',$mysql);
	@$myaction = $_REQUEST['action'];
	@$atitle="";
	@$aauthor="";
	@$abrief="";
	@$acontent="";
		
	if($myaction=="edit")
	{
			$mysql = "select A.id,A.title,A.author,A.time,B.brief,B.content from news A left join content B on A.id=B.cid where A.id=".$_REQUEST['id']."";
			$a_info = $dsql->GetOne($mysql);
			$atitle = $a_info['title'];
			$aauthor = $a_info['author'];
			$abrief = $a_info['brief'];
			$acontent = $a_info['content'];
			$atime = $a_info['time'];
		}
		 
	if($myaction=="delete")
	{
			$mysql = "delete from news where id=".$_REQUEST['id']."";
			$dsql->ExecuteNoneQuery($mysql);
			$mysql = "delete from content where cid=".$_REQUEST['id']."";
			$dsql->ExecuteNoneQuery($mysql);
			 
			echo "<script>";
			echo "alert('删除成功！');location.href='news.php'";
			echo "</script>";
	}
	if(isset($_POST['savenews']))
	{
		$mysql = "update news set title='".$_REQUEST['title']."',author='".$_REQUEST['author']."' where id=".$_REQUEST['cid']."";
		echo $mysql;
		$dsql->ExecuteNoneQuery($mysql);
		$mysql = "update content set brief='".$_REQUEST['brief']."',content='".$_REQUEST['content']."' where cid=".$_REQUEST['cid']."";
		echo $mysql;
		if($dsql->ExecuteNoneQuery($mysql))
		{
			 echo "<script>";
			 echo "alert('更新成功！');location.href='news.php'";
			 echo "</script>";
		 }else
		 {
			 echo "<script>";
			 echo "alert('更新失败！');location.href='news.php'";
			 echo "</script>";
		 
		 }
	}
	if(isset($_POST['submit']))
	{
		$mysql = "insert into news(title,author,time) values('".$_REQUEST['title']."','".$_REQUEST['author']."','".$time."')";
		$dsql->ExecuteNoneQuery($mysql);
		//-------------Get max id from xh_archives
		$mysql = "select max(id) as myid from news";
		$max_id = $dsql->GetOne($mysql);
		$mysql = "insert into content(cid,brief,content) values(".$max_id['myid'].",'".$_REQUEST['brief']."','".$_REQUEST['content']."')";
		if($dsql->ExecuteNoneQuery($mysql))
		{
			 echo "<script>";
			 echo "alert('新增成功！');location.href='news.php'";
			 echo "</script>";
		 }else
		 {
			 echo "<script>";
			 echo "alert('新增失败！');location.href='news.php'";
			 echo "</script>";
		 
		 }
	}
	
	if(isset($_POST['findnews']))
	{
			$link=$_REQUEST['searchid'];
			echo "<script>";
			echo "location.href='news.php?id=".$link."&action=edit'";
			echo "</script>";
	}

?>


         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <title>新闻发表</title>
         <table width="100%" border="0" cellspacing="1" bgcolor="#CCCCCC">
         <caption align="center">最新5条新闻</caption>
			<tr><td width="10%" height="25" bgcolor="#FFFFFF">&nbsp;新闻id</td>
            <td height="25" bgcolor="#FFFFFF">&nbsp;新闻标题</td>
            <td height="25" bgcolor="#FFFFFF">&nbsp;发布人</td>
            <td height="25" bgcolor="#FFFFFF">&nbsp;发布时间</td>
            <td width="10%" height="25" bgcolor="#FFFFFF">&nbsp;操作</td>
            </tr>
            <?php
			while($row=$dsql->GetObject('a_list'))
            {
            ?>
                <tr>
                <td width="10%" height="25" bgcolor="#FFFFFF">&nbsp;<?php echo $row->id;?></td>
                <td height="25" bgcolor="#FFFFFF">&nbsp;<a href="news.php?id=<?php echo $row->id;?>&action=edit" target="_self"><?php echo $row->title;?></a></td>
                <td width="10%" height="25" bgcolor="#FFFFFF">&nbsp;<?php echo $row->author;?></td>
                <td width="15%" height="25" bgcolor="#FFFFFF">&nbsp;<?php echo $row->time;?></td>
                <td width="10%" height="25" bgcolor="#FFFFFF">&nbsp;<a href="news.php?id=<?php echo $row->id;?>&action=delete" target="_self" onclick="return confirm('确定将此记录删除?')">删除</a></td>
                </tr>
            <?php
            }
            ?>
			
        </table> 
    
		<table align="center" width="700" border="0">
			<caption align="center"><h3>新闻编辑</h3></caption>
			<form action="news.php" method="post">
            <input name="cid" id="cid" type="hidden" value="<?php echo $_REQUEST['id'];?>"/>
				<tr>
					<td>标题：</td>
					<td><input type="text" name="title" size="80" value="<?php echo $atitle;?>"/></td>
				</tr>
				<tr>
					<td>作者：</td>
					<td><input type="text" name="author" size="80" value="<?php echo $aauthor;?>"/></td>
				</tr>
                <tr>
					<td>简介：</td>
					<td><input type="text" name="brief" size="80" value="<?php echo $abrief;?>"/></td>
				</tr>
				<tr>
					<td valign="top">内容：</td>
					<td><textarea name="content" rows="10" cols="67" size="3000"><?php echo $acontent;?></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="submit" value="增加新闻">
						<input type="reset"  name="reset" value="重置内容">
                        <input type="submit" name="savenews" value="保存修改">
					</td>
				</tr>
               <tr>
		 	   <td width="10%" height="25" bgcolor="#FFFFFF">输入id：</td>
			   <td height="25" bgcolor="#FFFFFF"><input type="text" name="searchid"/><input type="submit" name="findnews" value="查找新闻"></td>
	  		   </tr>		
			</form>
		</table>