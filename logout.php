<meta charset="utf-8">
<?php
session_start();

session_destroy();

header("Location: login.php");
die();

 ?>
