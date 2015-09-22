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
$page = 1;
if ($_GET['page']) {
	$page = $_GET['page'];
}
$subPage = $page * 4 - 3;

include '../../php/mysql-localhost-conn.php';
function getIntMysql($sql, $dbName) {
	mysql_select_db($dbName, $con);
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	return $row[0];
}
$top500edit = getIntMysql("select count(*) from wikiSchema.Tagging_CategoryTopType where id<500 and TopCate>1","wikiSchema");
$leastUnEdit = getIntMysql("select min(id) from wikiSchema.Tagging_CategoryTopType where TopCate is NULL","wikiSchema");
?>
<div style="padding: 100px 100px 10px;">
   <div class="well well-lg">
   <ul class="list-group">
   <li class="list-group-item">19万个类别名称,一共有将近4万个不同的后缀("美国篮球运动员"=>"运动员")</li>
   <li class="list-group-item">前500个后缀已经标注了<b><?php echo "<a class=\"text-danger\" href='CategoryTopCateSingle.php?id=$leastUnEdit'>$top500edit 个</a>"?></b></li>
   </ul>
   </div>
</div>


<div style="padding: 100px 100px 10px;">
   <div class="panel panel-warning">		
		<div class="panel-heading">
    	  <h3 class="panel-title">列表</h3>
   	</div>
   	<div class="row">
			<div class="col-sm-3" style="padding: 20px 20px 10px;">
   		<table class="table table-hover table-bordered">
				<thead>
					<th >id</th>
					<th >LastWord</th>
					
	 				<th>粗略实体覆盖个数</th>
				</thead>
				<tbody>
					<?php include '../../php/tagging/category/CategoryTableList.php';?>
				</tbody>
			</table>
			</div>
			<div class="col-sm-3" style="padding: 20px 20px 10px;">
   		<table class="table table-hover table-bordered">
				<thead>
					<th >id</th>
					<th >LastWord</th>
					
	 				<th>粗略实体覆盖个数</th>
				</thead>
				<tbody>
					<?php $subPage=$subPage+1;include '../../php/tagging/category/CategoryTableList.php';?>
				</tbody>
			</table>
			</div>
			<div class="col-sm-3" style="padding: 20px 20px 20px;">
   		<table class="table table-hover table-bordered">
				<thead>
					<th >id</th>
					<th >LastWord</th>
					
	 				<th>粗略实体覆盖个数</th>
				</thead>
				<tbody>
					<?php $subPage=$subPage+1;include '../../php/tagging/category/CategoryTableList.php';?>
				</tbody>
			</table>
			</div>
			<div class="col-sm-3" style="padding: 20px 20px 10px;">
   		<table class="table table-hover table-bordered">
				<thead>
					<th >id</th>
					<th >LastWord</th>
					
	 				<th>粗略实体覆盖个数</th>
				</thead>
				<tbody>
					<?php $subPage=$subPage+1;include '../../php/tagging/category/CategoryTableList.php';?>
				</tbody>
			</table>
			</div>
   	</div>
   	
   	
		<div align="center">
			<ul class="pagination">
				<?php
					$total_page = 500;
					$former = $page;
					$later = $page;
					if ($page > 1) {
						$former = $page - 1;
					}
					if ($page < $total_page) {
						$later = $page + 1;
					}
					echo "<li class='previous'><a href='CategoryTopCate.php?page=$former'>&laquo;</a></li>";
					
						if ($page <= 5 || $page >= $total_page - 4) {
							for ($i = 1; $i <= 5; $i++) {
								if ($page == $i) {
									echo "<li class='active'><a href='#'>$i</a></li>";
								} else {
									echo "<li><a href='CategoryTopCate.php?page=$i'>$i</a></li>";
								}
							}
							echo "<li><a href='#' readonly>...</a><li>";
							for ($i = $total_page - 4; $i <= $total_page; $i++) {
								if ($page == $i) {
									echo "<li class='active'><a href='#'>$i</a></li>";
								} else {
									echo "<li><a href='CategoryTopCate.php?page=$i'>$i</a></li>";
								}
							}
						} else {
							for ($i = 1; $i <= 3; $i++) {
								echo "<li><a href='CategoryTopCate.php?page=$i'>$i</a></li>";
							}
							echo "<li><a>...</a><li>";
							echo "<li><a href='CategoryTopCate.php?page=$former'>$former</a></li>";
							echo "<li class='active'><a href='#'>$page</a></li>";
							echo "<li><a href='CategoryTopCate.php?page=$later'>$later</a></li>";
							echo "<li><a>...</a><li>";
							for ($i = $total_page - 2; $i <= $total_page; $i++) {
								echo "<li><a href='CategoryTopCate.php?page=($i*4)'>$i</a></li>";
							}						
						}
					echo "<li class='next'><a href='CategoryTopCate.php?page=$later'>&raquo;</a></li>";
				?>
			</ul>
		</div>
	</div>
	
	<div class="row">
	<div class="col-md-6">
	</div>
	</div>
	
</div>


</body>
</html>