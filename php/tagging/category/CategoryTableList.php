<?php
header("Content-Type: text/html; charset=utf-8");
// all the path is the path of CategoryTopCate.php
include("../../php/mysql-localhost-conn.php");
mysql_select_db("wikiSchema", $con);

$from = ($subPage - 1) * 25 + 1;
$to = $subPage * 25;
$sql = "SELECT id,lastWord,idCount,EntityCoveredRough,TopCate FROM Tagging_CategoryTopType WHERE id BETWEEN $from and $to";
//echo $sql;
$result=mysql_query($sql);
while($r = mysql_fetch_array($result)) {
//	echo $r[0];
//	echo "<table><td>" . $r[0] . "</td><td>" . $r[1] . "</td><td>" . $r[2] . "</td><td>" . $r[3] . "</td>" . "</tr></table>";
	echo "<tr><td>" . $r[0] . "</td><td><a href='CategoryTopCateSingle.php?id=$r[0]' class='";
	if($r[4] == 2) {
		echo "text-success'>". $r[1];
	}elseif($r[4] == 3) {
		echo "text-primary'>". $r[1];
	}elseif($r[4] == 4) {
		echo "text-info'>". $r[1];
	}elseif($r[4] == 5) {
		echo "text-muted'>". $r[1];
	}else {
		echo "text-danger'><h4>" . $r[1] . "</h4>";
	}
	echo "</a></td><td>" .  $r[3] . "</td>" . "</tr>";
//	echo "</a></td><td>" . $r[2] . "</td><td>" . $r[3] . "</td>" . "</tr>";
}
mysql_close($con);
?>