<?php
header("Content-Type: text/html; charset=utf-8");
include("mysql-localhost-39-conn.php");
//include("mysql-localhost-conn.php");
$id = $_GET["cid"];
$sql="select name from Category where id=" . $id;
//echo $sql;
$result=mysql_query($sql);
$row = mysql_fetch_row($result);
$title=$row[0];
echo $title;
mysql_close($con);
?>
