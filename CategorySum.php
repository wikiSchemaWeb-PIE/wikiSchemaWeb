<!DOCTYPE html>
<html>
<head>
   <?php include("header.html")?>
   <script src="/wikiSchemaWeb/js/jquery.min.js"></script>
   <script src="/wikiSchemaWeb/js/CategorySum_query.js"></script>
   <script type="text/javascript">
  	$(document).on('click','tr.cid', function () {
  		alert("click cid!"+ $(this).text());
  		})
   </script>
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

   <title>ICST-wikiSchema</title>
</head>
<body>

<?php include("toolbar.html")?>

<div style="padding: 100px 100px 10px;">
   <form class="bs-example bs-example-form" role="form">
      <div class="row">
         <div class="col-lg-6 col-md-6 col-md-offset-3">
            <div class="input-group">
               <input type="text" class="form-control" placeholder="输入类别id(数字)" id="inputCid">
               <span class="input-group-btn">
                  <button class="btn btn-default" type="button" id="inputcid">
                     查询
                  </button>
               </span>
            </div><!-- /input-group -->
         </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
   </form>
</div>

<div id="loading">
<div style="padding: 100px 100px 10px;">
	<div class="panel panel-warning">		
		<div class="panel-heading">
    	  <h3 class="panel-title">基本信息</h3>
   	</div>
   	<div class="panel-body">
      	<table class="table table-striped table-bordered">
      		<tbody>
					<tr>
						<th>id</th><td id="categoryId"></td>
						<th>title</th><td id="categoryTitle"></td>  
						<th><a  id="wikipediaURL" target="_blank">中文维基百科页面</a></th>
					</tr>
      		</tbody>
      	</table>
   	</div>
	</div>
	
	<div class="panel panel-warning">		
		<div class="panel-heading">
    	  <h3 class="panel-title">上下级类别</h3>
   	</div>
   	<div class="panel-body">
      	<table class="table table-striped table-bordered">
      		<caption>父类别</caption>
      		<tbody  id="superCates">
					<tr>
						<td>id</td>
						<td>title</td> 
					</tr>
      		</tbody>
      	</table>
   	</div>
   	<div class="panel-body">
      	<table class="table table-striped table-bordered">
      		<caption>子类别</caption>
      		<tbody  id="subCates">
      		</tbody>
      	</table>
   	</div>
	</div>
	
</div>
</div>
</body>
</html>