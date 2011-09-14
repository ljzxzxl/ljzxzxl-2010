<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
$a="1000";
$b=base64_encode($a);
$c=base64_decode($b);
echo "加密前：\$a=",$a,"<br />";
echo "加密后：\$b=",$b,"<br />";
echo "解密后：\$c=",$c,"<br />";
echo base64_decode('MTEwMTAwMDAwOA==');
echo base64_decode('NDM4MDEy');
?>