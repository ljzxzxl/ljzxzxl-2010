<?php
//在10个自然数中取随机数
$list = 10;
//取几个
$nu = 6;
for($s; $s < $list; $s++) {
$a[] = $s;
}
for($i; $i < $nu; $i = $key) {
for($n = rand(0,($list - 1)); $a[$n] == $n; $a[$n] = $list)
{
$key++;
$num[] = $n;
}
}
print_r($num);
echo implode($num);
?>