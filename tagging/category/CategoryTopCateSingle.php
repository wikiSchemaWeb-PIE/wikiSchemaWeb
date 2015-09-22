<!DOCTYPE html>
<html>
<head>
   <?php include("../../header.html") ?>
   <script src="/wikiSchemaWeb/js/jquery.min.js"></script>
   <script type="text/javascript">
   </script>
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

   <title>ICST-wikiSchema</title>
</head>
<body>

<?php include("../../toolbar.html")?>


<?php
$id = -1;
if ($_GET['id']) {
	$id = $_GET['id'];
}
include '../../php/mysql-localhost-conn.php';

mysql_select_db('wikiSchema', $con);
// get ids, lastWord
$sql = "select lastWord, idCount, EntityCoveredRough,ids from Tagging_CategoryTopType WHERE id=" . $id;
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$lw = $row[0];
$cateNr = $row[1];
$EntNr = $row[2];
$ids = $row[3];
$idArs = explode(',',$ids);

function getTitle($cid) {
mysql_select_db('JWPL_zh_050602', $con);
$sql="select name from JWPL_zh_050602.Category where id=" . $cid;
$result=mysql_query($sql);
$row = mysql_fetch_row($result);
$title=$row[0];
return $title;
}

function getIntMysql($sql, $dbName) {
	mysql_select_db($dbName, $con);
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}
$lwCount = getIntMysql("select max(id) from wikiSchema.Tagging_CategoryTopType", "wikiSchema");
//echo "total lw:" . $lwCount;

$flag = getIntMysql("select TopCate from wikiSchema.Tagging_CategoryTopType where id=$id", "wikiSchema");
$string = "标注";
if($flag == NULL) {
	$flag = -1;
}
else {
	$string = "更新标注";
	mysql_select_db("wikiSchema",$con);
	$sql1 = "select * from categoryHierarchy where superCateId=1 and cateId='$flag'";
	$result1 = mysql_query($sql1);
	$row1 = mysql_fetch_object($result1);
	$cateLabel = $row1->cateLabel;
}

?>

<div style="padding: 100px 100px 10px;">
		<div id="editHint">
		<?php
		if($_GET['alert']){
			echo $_GET['alert'];
		}
		elseif($flag>=0) {
			echo "<div class='alert alert-danger' role='alert' style='width: 100%; ";
			echo "margin-left: auto; margin-right: auto; font-size: 15px;'>";
			echo "<b>注意：当前文章您已经标注过，上次标注的类别为：$cateLabel ！</b></div>";
		}
		?>
		</div>
</div>
<div style="padding: 100px 100px 10px;">
   <div class="panel panel-warning">		
		<div class="panel-heading">
    	  <h3 class="panel-title"><?php echo $lw ?></h3>
   	</div>
   	<div style="padding: 50px 50px 10px;">
   		<table class="table table-hover table-bordered">
				<thead>
					<th >id</th> <td><?php echo $id?></td>
					<th>以 <?php echo $lw?> 结尾的类别个数:</th><td><?php echo $cateNr?></td>
	 				<th>粗略实体覆盖个数</th><td><?php echo $EntNr?></td>
				</thead>
			</table>
		</div>
   	<div style="padding: 50px 50px 10px;">
   		<table class="table table-hover table-bordered">
   			<tbody>
				<?php
					$cnt = count($idArs);
//					echo $cnt . "<br/>";
//					echo "cont:" . $content . "<br/>";
					$html = "";
					for($i = 0 ; $i < $cnt; $i ++){
						if($i % 6 == 0){
							$html = $html . "<tr>";
						}
						$html = $html . "<td><a href=\"https://zh.wikipedia.org/wiki?curid=" . $idArs[$i] . "\">" . getTitle($idArs[$i]) . "</a>" . "</td>";
						if($i % 6 == 5){
							$html = $html . "</tr>";
						}
					}
					if($cnt % 6 == 0){
						$html = $html . "</tr>";
					}
					echo $html;
				?>
				</tbody>
						
   		</table>
   	</div>
   	
   
   <div align="center">
   	<div style="padding: 50px 50px 10px;">
   		<?php echo "<form action=\"updateCateLabel.php\" class=\"form-horizontal\" method=\"get\">"; ?>
   		<div class="form-group">
   				<input class="form-control hidden" type="text" value="<?php echo $id?>"
							name="id" style="margin-bottom: 20px;">
						<label class="col-sm-2 control-label">
							一级类别
						</label>
						<div class="col-sm-7">
							<select class="form-control" name="firCateLabel" 
							style="margin-left:auto;margin-right:auto;margin-bottom:20px;">
								<option></option>
								<?php
									$sql = "SELECT * FROM categoryHierarchy where cateLevel=2 and superCateId=1";
									echo "sql:" . $sql . "<br/>";
									$result = mysql_query($sql);
									while($row = mysql_fetch_object($result)) {
										echo "<option>$row->cateLabel</option>";
									}
								?>
							</select>
						</div>
						<input class='btn btn-warning' type="submit" value="<?php echo $string?>">
			</div>
			</form>
		</div>
	</div>
   <div align="center" style="padding: 50px 50px 50px;">
		<div class="btn-group" role="group" align="center">
<!--		<?php echo "<a class='btn btn-s btn-success' role ='button' href='CategoryTopCateSingle.php?id=2'>返回上一篇文章$lwCount</a>"; ?>-->
		<?php
		$btnBase = "<a class='btn btn-s btn-success' role ='button' href='CategoryTopCateSingle.php?id=";
		if($id > 1){
			echo $btnBase . ($id-1) . "'>返回上一篇文章</a>";
		}
		echo "<a class='btn btn-s btn-success' role ='button' href='CategoryTopCate.php'>返回标注主页</a>";
		if($id < $lwCount) {
			echo $btnBase . ($id+1) .  "'>进入下一篇文章</a>";
		}
		?>
		</div>
	</div>
	</div>
</div>
</body>
</html>