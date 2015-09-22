<?php
header("Content-Type: text/html; charset=utf-8");
//include("mysql-localhost-conn.php");
include("mysql-localhost-39-conn.php");
$id = $_GET["cid"];
$mode = $_GET["m"]; # mode = '1'(father) or '2' (son)
$sql = "";
$hie = "Categories"; 
switch($mode) {
	case 1:
		$sql = "select ci.inLinks id, ca.name title from category_inlinks ci left join Category ca  on ci.inLinks=ca.id  where ci.id=" . $id; 
		break;
	case 2:
		$sql = "select ci.id id, ca.name title from category_inlinks ci left join Category ca  on ci.id=ca.id  where ci.inLinks=" . $id; 
		break;
}
//echo "sql:" . $sql . "<br/>";
$result=mysql_query("$sql");
class idTitle{
	public $id;
	public $title;
}
if($result){
	$cates=array(); 
	while($row=mysql_fetch_array($result)){
		$cate = new idTitle();
		$cate->id = $row['id'];
		$cate->title = $row['title'];
//		echo $cate->id  . ' ' . $cate->title . " row:" . $row . "<br/>";
		$cates[]=$cate;
	}
	echo (json_encode(array($hie=>$cates))); 
}
?>
