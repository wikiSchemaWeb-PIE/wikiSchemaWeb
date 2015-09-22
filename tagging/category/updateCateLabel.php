<?php

$cLabel = $_GET['firCateLabel'];
$id = $_GET['id'];

include '../../php/mysql-localhost-conn.php';

// get category id from category label
mysql_select_db("wikiSchema",$con);
$sql1 = "select * from categoryHierarchy where superCateId=1 and cateLabel='$cLabel'";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_object($result1);
$cateId = $row1->cateId;

$sql = "UPDATE Tagging_CategoryTopType SET TopCate=$cateId WHERE id = $id";
$alert = "<div class='alert alert-danger' role='alert' style='width: 100%; "
			. "margin-left: auto; margin-right: auto; font-size: 15px;'>"
			. "<b>该后缀的类别已标注为:$cLabel ！</b></div>";
mysql_query($sql);
header("Location: CategoryTopCateSingle.php?id=$id&alert=$alert");
?>