<script>
function Check4(rn)
    {
        document.all.fldRow.value = rn ;
        
        for(i=0;i<document.all.fldRow.value;i++){
            if(document.getElementsByName("a2")[i].selectedIndex==1||document.getElementsByName("a2")[i].selectedIndex==3){
                document.getElementsByName("a3")[i].className='normalfld';
                document.getElementsByName("a3")[i].readOnly=true;
                document.getElementById('fly').style.display='block';
                document.getElementById('OK').style.display='none';
                document.getElementById('OK1').style.display='block';
            }            
            else{
                document.getElementsByName("a3")[i].className='needfld';
                document.getElementsByName("a3")[i].readOnly=false;
                document.getElementById('fuwushangdiv2').style.display='none';
            }
        }
        //alert(document.all.fldRow.value);            
    }
    
function getvalue4(rn)
    {
        rn = document.all.fldRow.value;
        var i=rn-1;
        //alert(rn);
        if(document.all.fldComputer[0].checked==true){
            document.getElementsByName("a3")[i].value="普通配置";
            document.all.fldComputer[0].checked=false;
        }
        else if(document.all.fldComputer[1].checked==true){
            document.getElementsByName("a3")[i].value="技术配置";
            document.all.fldComputer[1].checked=false;
        }
        else{
            document.getElementsByName("a3")[i].value="";
        }

    }
</script>
<div id='fly' style='display:none' class="white_content">
<table width="646">
<tr>
<td colspan="3" class="tdLabel" style="size:2;text-align:center">电脑主机配置信息</td>
</tr>
  <tr>
        <td style="text-align:center" colspan="3">
        <input type="button" name="OK" id="OK" onclick="document.getElementById('fuwushangdiv2').style.display='none';getvalue3();" value="确定">
        <input type="button" name="OK1" id="OK1" onclick="document.getElementById('fuwushangdiv2').style.display='none';getvalue4();" value="确定">
    </td>
  </tr>
  <tr>
    <td width="77"> </td>
    <td><span style="text-align:left">公司配置</span></td>
    <td><span style="text-align:left">技术配置</span></td>
  </tr>
  <tr>
    <td>CPU 型号</td>
    <td width="272">Pentium(R) Dual-Core CPU    E5200@2.50GHz</td>
    <td width="275">Pentium(R) Dual-Core CPU    E5300@2.60GHz </td>
  </tr>
  <tr>
    <td>标称频率</td>
    <td>2660MHz</td>
    <td>2500MHz</td>
  </tr>
  <tr>
    <td>内存大小</td>
    <td>2GB</td>
    <td>2GB</td>
  </tr>
  <tr>
    <td>硬盘容量</td>
    <td>250GB</td>
    <td>250GB</td>
  </tr>
  <tr>
    <td>硬盘描述</td>
    <td>SATA</td>
    <td>SATA</td>
  </tr>
  <tr>
    <td>显示器大小</td>
    <td>19寸宽屏</td>
    <td>19寸宽屏</td>
  </tr>
  <tr>
    <td>显示器描述</td>
    <td>LCD</td>
    <td>LCD</td>
  </tr>
  <tr>
    <td>显卡芯片</td>
    <td>主板集成G31</td>
    <td>nVIDIA    GeForce 9500GT</td>
  </tr>
    <tr>
    <td>显存容量</td>
    <td> </td>
    <td>128MB</td>
  </tr>
</table>
</div>