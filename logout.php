<?php
session_start();
unset($_SESSION['adsme']);
header('Location:login.php');
exit();
?>
