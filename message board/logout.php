<?php
session_start();
unset($_SESSION[ 'valid_user']);
echo "<script>";
echo "alert('×¢Ïú³É¹¦£¡');location.href='message.php'";
echo "</script>";
?>
