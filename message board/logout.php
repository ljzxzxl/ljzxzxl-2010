<?php
session_start();
unset($_SESSION[ 'valid_user']);
echo "<script>";
echo "alert('ע���ɹ���');location.href='message.php'";
echo "</script>";
?>
