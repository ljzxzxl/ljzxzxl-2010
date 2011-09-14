<?php
//ecshop includes/lib_time.php Line 131
function local_strtotime($str)
{
$timezone = isset($_SESSION['timezone']) ? $_SESSION['timezone'] : $GLOBALS['_CFG']['timezone'];
/**
* $time = mktime($hour, $minute, $second, $month, $day, $year) – date(‘Z’) + (date(‘Z’) – $timezone * 3600)
* 先用mktime生成时间戳，再减去date(‘Z’)转换为GMT时间，然后修正为用户自定义时间。以下是化简后结果
**/
$time = strtotime($str) - $timezone * 3600;
return $time;
}
function local_date($format, $time = NULL)
{
$timezone = isset($_SESSION['timezone']) ? $_SESSION['timezone'] : $GLOBALS['_CFG']['timezone'];
if ($time === NULL)
{
$time = gmtime();
}
elseif ($time <= 0)
{
return ”;
}
$time += ($timezone * 3600);
return date($format, $time);
}

$GLOBALS['_CFG']['timezone'] = 16;
echo local_strtotime('2011-11-27');
echo "<br/>";
echo local_strtotime('2011-04-01');
echo "<br/>";
echo local_strtotime('2012-05-01');
echo "<br/>";
echo local_date('Y-m-d', '1301558400');
echo "<br/>";
echo "1325318400";
echo "<br/>";
echo date("Y-m-d H:i:s",time());
echo "<br/>";
echo $today = date("Y-m-d");
echo "<br/>";
echo local_strtotime($today);
echo "<br/>";

echo $nextyear = (date('Y') + 1)."-".date('m')."-".date('d');
echo "<br/>";


//ecshop过期判断
$day = getdate();
echo "<hr/>";
$cur_date = local_mktime(23, 59, 59, $day['mon'], $day['mday'], $day['year']);
echo $cur_date;
echo "123";


?>