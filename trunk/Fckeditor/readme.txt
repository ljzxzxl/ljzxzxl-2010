相对虚拟站点http://localhost/ictech/
一、精简说明:
删除所有"_"开头的文件和文件夹
删除语言包中除中文和英文以外的语言
删除skin目录下除默认皮肤以外的文件夹
filemanager/browser/default/connectors/目录下除php以外的文件
filemanager/upload/目录下除php以外的文件


二、配置说明:
将Fckeditor 里的保留文件拷贝到网站根目录文件夹里，即/ictech/下
/fcktemplates.xml
/fckstyles.xml
/fckeditor_php5.php
/fckeditor_php4.php
/fckeditor.php
/fckeditor.js
/fckconfig.js
/editor/
fckeditor.php :
BasePath为默认Fckeditor的目录,也可以在调用的时候指定.

三、\fckconfig.js 语言识别设置：

FCKConfig.AutoDetectLanguage	= false ; //61行 关闭自动语言识别
FCKConfig.DefaultLanguage		= 'zh-cn' ; //62行 选择 zh-cn

四、上传设置：
\editor\filemanager\browser\default\connectors\php\config.php:

$Config['Enabled'] = true ;// 30行 是否允许上传

$Config['UserFilesPath'] = '/ictech/userfiles/' ; //33行 默认上传路径，可以更改但必须在相应的目录下建这个名称的目录。




四、上传文件随机重命名为 201447202465.jpg 
修改fckeditor/editor/filemanager/connectors/php/commands.php
   1.第一段添加函数 [24行]
function GetRandID($prefix) {
    //第一步:初始化种子
      //microtime(); 是个数组
     $seedstr =split(" ",microtime(),5);
     $seed =$seedstr[0]*10000;
   //第二步:使用种子初始化随机数发生器
     srand($seed);
   //第三步:生成指定范围内的随机数
     $random =rand(1,10000);

     $filename = date("dHis", time()).$random.'.'.$prefix;

     return $filename;
}

2.[204行]应用函数
    在函数function FileUpload( $resourceType, $currentFolder, $sCommand ) 中的if ( isset( $Config['SecureImageUploads'] ) )[行204]上面一行添加
     $sOriginalFileName = $sFileName = GetRandID($sExtension);

设置完成
    
五、php文件应用 事例
http://localhost/ictech/fadd.php   
<?php
include("fckeditor.php");
$sBasePath="/ictech/";//编辑器所在目录
$oFCKeditor=new FCKeditor('fileinfo'); // 创建一个fckeditor对象
$oFCKeditor->BasePath=$BasePath;
$oFCKeditor->Value=$fileinfo; // 设置表单初始值
$oFCKeditor->Create(); // 调用类中方法，必须
?>