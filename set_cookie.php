<?php

// 输出个别的 cookie
echo $_COOKIE["pro_cookie"];
echo "<br />";
echo $HTTP_COOKIE_VARS["pro_cookie"];
echo "<br />";

// 输出所有 cookie
print_r($_COOKIE);
?>