<?php
require_once (__DIR__ . '/../src/RADUFU/Autoloader.php');

session_start();
session_destroy();

header("Location: login.php");
exit();

?>