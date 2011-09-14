<?php
echo time();

echo "<br/>";

$i   =   105; 
echo $num = sprintf("%07d ",$i);
echo "<br/>";
echo substr("Hello world!",6,5);
echo "<br/>";
echo del0($num);

//去掉数字段前面的0
function del0($num)
{
    $flag = 0;
    $str = '';
    for($i=0; $i<strlen($num); $i++)
    {
        if($num{$i} == '0' && $flag == 0)
            continue;
        elseif($num{$i} != '0')
        {
            $str = $str.$num{$i};
            $flag = 1;
        }else{
            $str = $str.$num{$i};
        }
    }
    return $str;
}


echo   "<script language = 'javascript'> 
            alert('是推广用户！');
            </script>";

$ucsalt = "128924";
$ucfounderpw = "08290317";
echo $ucfounderpw = md5(md5($ucfounderpw).$ucsalt);

echo "<hr>";
$url = "http://sp.inet360.cn:32181/affiche.php?ad_id=44^from=1033^no_postage=1^uri=http://sp.inet360.cn:32181/category-8-b0.html";
echo str_replace('^','&',$url);

echo "---------------------<br/>";
//echo urlencode($_SERVER["HTTP_HOST"]);
echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
echo $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

echo "---------------------<br/>";
echo urlencode('http://www.inet360.cn/affiche.php?ad_id=37&from={$user_id}&no_postage=1&uri=www.inet360.cn');
echo "---------------------<br/>";
echo urlencode('http://www.inet360.cn/tg.php?act=promotion_bless&id={$user_id}&f_id={$f_user_id}');

?>