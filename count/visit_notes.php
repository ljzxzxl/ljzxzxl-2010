<?php
/**
*记录访问者IP信息
*统计从智联招聘和51job的访问信息
*author:Xeylon Zhou
*/

//IP地理地址查询类库
define('__QQWRY__' , dirname(__FILE__)."/QQWry.Dat");
class QQWry{
    var $StartIP=0;
    var $EndIP=0;
    var $Country='';
    var $Local='';
    var $CountryFlag=0;
    var $fp;
    var $FirstStartIp=0;
    var $LastStartIp=0;
    var $EndIpOff=0 ;
    function getStartIp($RecNo){
     $offset=$this->FirstStartIp+$RecNo * 7 ;
     @fseek($this->fp,$offset,SEEK_SET) ;
     $buf=fread($this->fp ,7) ;
     $this->EndIpOff=ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])* 256*256);
     $this->StartIp=ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
     return $this->StartIp;
    }
    function getEndIp(){
     @fseek ( $this->fp , $this->EndIpOff , SEEK_SET ) ;
     $buf=fread ( $this->fp , 5 ) ;
     $this->EndIp=ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
     $this->CountryFlag=ord ( $buf[4] ) ;
     return $this->EndIp ;
    }
    function getCountry(){
     switch ( $this->CountryFlag ) {
        case 1:
        case 2:
         $this->Country=$this->getFlagStr ( $this->EndIpOff+4) ;
         //echo sprintf('EndIpOffset=(%x)',$this->EndIpOff );
         $this->Local=( 1 == $this->CountryFlag )? '' : $this->getFlagStr ( $this->EndIpOff+8);
         break ;
        default :
         $this->Country=$this->getFlagStr ($this->EndIpOff+4) ;
         $this->Local=$this->getFlagStr ( ftell ( $this->fp )) ;
     }
    }
    function getFlagStr ($offset){
     $flag=0 ;
     while(1){
        @fseek($this->fp ,$offset,SEEK_SET) ;
        $flag=ord(fgetc($this->fp ) ) ;
        if ( $flag == 1 || $flag == 2 ) {
         $buf=fread ($this->fp , 3 ) ;
         if ($flag==2){
            $this->CountryFlag=2;
            $this->EndIpOff=$offset - 4 ;
         }
         $offset=ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])* 256*256);
        }
        else{
         break ;
        }
     }
     if($offset<12)
        return '';
     @fseek($this->fp , $offset , SEEK_SET ) ;

     return $this->getStr();
    }
    function getStr ( )
    {
     $str='' ;
     while ( 1 ) {
        $c=fgetc ( $this->fp ) ;
        if(ord($c[0])== 0 )
         break ;
        $str.= $c ;
     }
     return $str ;
    }
    function qqwry ($dotip='') {
        if( !is_string($dotip) || $dotip==''){return;}
                if(preg_match("/^127/",$dotip)){$this->Country="本地网络";return ;}
        elseif(preg_match("/^192/",$dotip)) {$this->Country="局域网";return ;}

     $nRet;
     $ip=$this->IpToInt ( $dotip );
     $this->fp= fopen(__QQWRY__, "rb");
     if ($this->fp == NULL) {
         $szLocal= "OpenFileError";
        return 1;
     }
     @fseek ( $this->fp , 0 , SEEK_SET ) ;
     $buf=fread ( $this->fp , 8 ) ;
     $this->FirstStartIp=ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
     $this->LastStartIp=ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])*256*256) + (ord($buf[7])*256*256*256);
     $RecordCount= floor( ( $this->LastStartIp - $this->FirstStartIp ) / 7);
     if ($RecordCount <= 1){
        $this->Country="FileDataError";
        fclose($this->fp) ;
        return 2 ;
     }
     $RangB= 0;
     $RangE= $RecordCount;
     while ($RangB < $RangE-1)
     {
     $RecNo= floor(($RangB + $RangE) / 2);
     $this->getStartIp ( $RecNo ) ;

        if ( $ip == $this->StartIp )
        {
         $RangB=$RecNo ;
         break ;
        }
     if ($ip>$this->StartIp)
        $RangB= $RecNo;
     else
        $RangE= $RecNo;
     }
     $this->getStartIp ( $RangB ) ;
     $this->getEndIp ( ) ;

     if ( ( $this->StartIp <= $ip ) && ( $this->EndIp >= $ip ) ){
        $nRet=0 ;
        $this->getCountry ( ) ;
        $this->Local=str_replace("（我们一定要解放台湾！！！）", "", $this->Local);
     }
     else{
        $nRet=3 ;
        $this->Country='未知' ;
        $this->Local='' ;
     }
     fclose ( $this->fp );
$this->Country=preg_replace("/(CZ88.NET)|(纯真网络)/","局域网/未知",$this->Country);
$this->Local=preg_replace("/(CZ88.NET)|(纯真网络)/","局域网/未知",$this->Local);
        return $nRet ;
    }
    function IpToInt($Ip) {
     $array=explode('.',$Ip);
     $Int=($array[0] * 256*256*256) + ($array[1]*256*256) + ($array[2]*256) + $array[3];
     return $Int;
    }
}


//初始化
date_default_timezone_set("PRC");   /*把时间调到北京时间,php5默认为格林威治标准时间*/

//获得访问者IP信息并记录
$ip = GetIP();
$time = date("Y-m-d H:i:s", time());
$from = '';
if(isset($_SERVER['HTTP_REFERER']))
{
   $from = $_SERVER['HTTP_REFERER'];
}
//IP位置查询
$QQWry=new QQWry;
$ifErr=$QQWry->QQWry($ip);
$address=iconv("GB2312", "UTF-8//IGNORE","$QQWry->Country$QQWry->Local");
//写入文件
$myfile = 'visit_notes.txt';
$str = "Date='".$time."' IP='".$ip."' From='".$from."' Address='".$address."'";
if(isset($_GET['from']))
{
	$come = $_GET['from'];
	$str .= " Resume Download From '".$come."'\r\n";
}
else
{
	$str .= "\r\n";
}
if($ip ==GetIP())
	{
		$file_pointer = fopen($myfile,"a");
		fwrite($file_pointer,$str);
		fclose($file_pointer);
	}

//取得访问者IP信息函数
function GetIP(){
if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
$ip = getenv("HTTP_CLIENT_IP");
else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
$ip = getenv("REMOTE_ADDR");
else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
$ip = $_SERVER['REMOTE_ADDR'];
else
$ip = "unknown";
return($ip);
}

?>