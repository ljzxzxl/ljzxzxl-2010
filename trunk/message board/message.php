<?php
	session_start();
	date_default_timezone_set("PRC");
	$time=date("Y-m-d H:i");
	require_once(dirname(__FILE__)."/config.php");
	require_once(dirname(__FILE__)."/mysql.class.php");
	$mysql="select * from message order by id desc limit 5";
	$dsql->Execute('a_list',$mysql);
	@$myaction = $_REQUEST['action'];
	@$acontent="";
	@$ausername="";

	if($myaction=="edit")
	{
			$mysql = "select * from message where id=".$_REQUEST['id']."";
			$a_info = $dsql->GetOne($mysql);
			$acontent = $a_info['content'];
			$ausername = $a_info['username'];
			$atime = $a_info['time'];
	}
	if($myaction=="delete")
	{
			$mysql = "delete from message where id=".$_REQUEST['id']."";
			if($dsql->ExecuteNoneQuery($mysql))
			{
			echo "<script>";
			echo "alert('删除成功！');location.href='message.php'";
			echo "</script>";
			}
	}
	if(isset($_POST['savemessage']))
	{
		$mysql = "update message set content='".$_REQUEST['content']."' where id=".$_REQUEST['id']."";
		if($dsql->ExecuteNoneQuery($mysql))
		{
			 echo "<script>";
			 echo "alert('留言更新成功！');location.href='message.php'";
			 echo "</script>";
		 }else
		 {
			 echo "<script>";
			 echo "alert('留言更新失败！');location.href='message.php'";
			 echo "</script>";
		 
		 }
	}
	if(isset($_POST['submit']))
	{
		$mysql = "insert into message(username,content,time,permission) values('".$_SESSION['valid_user']."','".$_REQUEST['content']."','".$time."','".$_REQUEST['permission']."')";
		if($_REQUEST['content'])
		{	
			if($dsql->ExecuteNoneQuery($mysql))
			{
			 echo "<script>";
			 echo "alert('留言成功！');location.href='message.php'";
			 echo "</script>";
			}
		 }else
		 {
			 echo "<script>";
			 echo "alert('留言有误，请检查！');location.href='message.php'";
			 echo "</script>";
		 
		 }
	}
	
	if(isset($_POST['findmessage']))
	{
		if($link=$_REQUEST['searchid'])
		{
			echo "<script>";
			echo "location.href='message.php?id=".$link."&action=edit'";
			echo "</script>";
		}
		else
		{
			echo "<script>";
			echo "alert('请输入留言id！');";
			echo "</script>";
		}
	}

	if(isset($_POST['logout']))
	{
			unset($_SESSION[ 'valid_user']);
			echo "<script>";
			echo "alert('注销成功！');location.href='message.php'";
			echo "</script>";
	}

	if(isset($_POST['replymessage']))
	{
		$mysql = "insert into reply(rid,rcontent,rusername,rtime) values('".$_REQUEST['id']."','".$_REQUEST['rcontent']."','".$_SESSION['valid_user']."','".$time."')";
		if($dsql->ExecuteNoneQuery($mysql)&&$_REQUEST['rcontent'])
		{
			echo "<script>";
			echo "alert('回复留言成功！');location.href='message.php'";
			echo "</script>";
		}
		else{	echo "<script>";
			echo "alert('回复有误，请检查！');";
			echo "</script>";}
	}


	if(isset($_SESSION['valid_user']))
	{		echo "欢迎，";
			echo $_SESSION['valid_user']."已登录";
	}
	else{echo "未登录,您将无法发表和回复留言";}

?>


         <meta http-equiv="Content-Type" content="text/html; charset=utf8">
         <title>留言板</title>
         <table width="100%" border="0" cellspacing="1" bgcolor="#CCCCCC">
         <caption align="center"><h3>最新留言</h3></caption>
			<tr><td width="5%" height="25" bgcolor="#FFFFFF">&nbsp;id</td>
            <td height="25" bgcolor="#FFFFFF">&nbsp;留言详情</td>
            <td width="5%" height="25" bgcolor="#FFFFFF">&nbsp;留言者</td>
            <td width="15%" height="25" bgcolor="#FFFFFF">&nbsp;留言时间</td>
            <td width="5%" height="25" bgcolor="#FFFFFF">&nbsp;操作</td>
            </tr>
            <?php
			$a=1;
			while($row=$dsql->GetObject('a_list'))
            {
				$bgc="white";
				if($a%2==0)
				{$bgc="white";}
            ?>
                <tr bgcolor=<?php echo $bgc;?>>
                <td width="5%" height="25">&nbsp;<?php echo $row->id;?></td>
                <td height="25">
				&nbsp;<a href="message.php?id=<?php echo $row->id;?>&action=edit" target="_self"><?php echo $row->content;?></a>
				</td>
                <td width="5%" height="25">&nbsp;<?php echo $row->username;?></td>
                <td width="15%" height="25">&nbsp;<?php echo $row->time;?></td>
                <td width="5%" height="25">&nbsp;<a href="message.php?id=<?php echo $row->id;?>&action=delete" target="_self" onclick="return confirm('确定将此记录删除?')">删除</a></td>
				</tr>
            <?php
				$a++;
            }
            ?>
        </table> 
    
		<table align="center" width="850" border="0">
		<div align="center">发表留言及回复</div>
			<form action="message.php" method="post">
			<input name="id" type="hidden" value="<?php echo $_REQUEST['id'];?>"/>
				<tr>
					<td colspan="2" align="left">
					<?php
					if($acontent)
						{
							echo "留言详情：<br/>";
							echo $acontent."&nbsp;&nbsp;&nbsp;".$ausername."&nbsp;&nbsp;&nbsp;".$atime;
							echo "<br/>";
							echo "留言回复：<br/>";
							$mysql2 = "select * from reply where rid=".$_REQUEST['id']." order by rmid desc";
							$dsql->Execute('a_list',$mysql2);
							while($row2=$dsql->GetObject('a_list'))
							{
								echo $row2->rcontent;
								echo "&nbsp;&nbsp;&nbsp;by:";
								echo $row2->rusername;
								echo "&nbsp;";
								echo $row2->rtime;
								echo "<br/>";
							}
						}
					?>
					</td>
			   </tr>
               <tr>
		 	   <td width="10%" height="25" bgcolor="#FFFFFF">输入id：</td>
			   <td height="25" bgcolor="#FFFFFF"><input type="text" name="searchid"/>&nbsp;<input type="submit" name="findmessage" value="查找留言"/></td>
	  		   </tr>
				<?php
					if(isset($_SESSION['valid_user'])&&$acontent)
					{
						echo "<tr><td valign='top'>回复留言：</td><td><textarea name='rcontent' rows='3' cols='50' size='3000'></textarea></td></tr>";
						echo "<tr><td></td><td><input type='submit' name='replymessage' value='确认回复'></td>";
					}
				?>
				<tr>
					<td valign="top">留言内容：</td>
					<td><textarea name="content" rows="5" cols="80" size="3000"></textarea></td>
				</tr>
                <!--
				<tr>
                	<td colspan="2">
                    权限设置：
					-->
                    <input type="hidden" name="permission" value="公开" checked/>
                    <input type="hidden" name="permission" value="私密"/>
                    <!--
					</td>
                </tr>
				-->

				<tr>
					<td colspan="2" align="center">
                    <?php
						if(isset($_SESSION['valid_user']))
						{
							echo "<input type='submit' name='submit' value='发表留言'>";
							echo "&nbsp;";
							echo "<input type='submit' name='savemessage' value='修改留言'>";
						}
					?>
						<input type="reset"  name="reset" value="重置内容">
                        <input type="submit" name="logout" value="注销登录">
                     <?php
					 	if(!isset($_SESSION['valid_user']))
							{
								echo "<a href='login.php'>点此登录</a>";
							}
					 ?>
					</td>
				</tr>
			</form>
		</table>