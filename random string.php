<?php
function genRandomString($len)
{
    $chars = array(
        "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z"
    );
	$charsLen = count($chars) - 1;
    shuffle($chars);    // 将数组打乱
    $output = "";
    for ($i=0; $i<1; $i++)
    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }

	$chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);    // 将数组打乱
    for ($i=0; $i<($len-1); $i++)
    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output; 
}

function genRandomString2($len)
{
    $chars = array(
        "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);    // 将数组打乱
    $output = "";
    for ($i=0; $i<$len; $i++)
    {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output; 
}

$str = genRandomString(5);
$str .= "<br />";
$str .= genRandomString(4);
$str .= "<br />";
$str .= genRandomString(3);

echo $str;
echo "<br/>";
echo genRandomString2(1);
?>