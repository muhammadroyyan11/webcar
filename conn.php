<?php

include('mysql-shim.php');

$connection = mysql_connect("localhost", "root", "") or die(mysql_errno() . ": " . mysql_error() . "<br>");
mysql_select_db("webcar", $connection) or die(mysql_errno() . ": " . mysql_error() . "<br>");
?>

