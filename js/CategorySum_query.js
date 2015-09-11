
$(document).ready(function(){
	$("#loading").hide();
	$("button").click(update);
  
  	
});
function update(){
    var tcid=$("#inputCid").val();
    
	$.ajax({
		type: "GET",
		url:"/wikiSchemaWeb/php/Category_JWPL.php",
		data:'cid=' + tcid,
		success:function(data){
			$("#categoryTitle").text(data);
			$("#categoryId").text(tcid);
			$("#wikipediaURL").attr("href","https://zh.wikipedia.org/wiki?curid="+tcid);
			$("#loading").show();
			insertSuperCates(tcid, '1', '#superCates');
			insertSuperCates(tcid, '2', '#subCates');
			updateIdLinks();
		},
		error:function(e){ alert('ajax hava an error');
		alert(XMLHttpRequest.status);
                        alert(XMLHttpRequest.readyState);
                        alert(textStatus);}
		});
  } 
  function updateIdLinks(){
  	$(document).on('click','td.cid', function () {
//  		alert("click cid!"+ $(this).text());
            	$("#inputCid").val($(this).text());
            	update();
  		})
    /*$('.table td').each(function(){
        $(this).css('cursor','pointer').hover(
            function(){ 
                $(this).addClass('active'); 
            }
            ,  
            function(){ 
                $(this).removeClass('active'); 
            }).click( function(){ 
            alert("click!"+ $(this).text());
            	$("#inputCid").val($(this).text());
            	update();
            }
        );
    });*/
   }
  function insertSuperCates(cid, mode, targetId) {
  	$.ajax({
  		url:'/wikiSchemaWeb/php/CategoryInLinks_JWPL.php',
  		data:'cid=' + cid + "&m=" + mode,
  		dataType:"JSON",
  		success:function(json){
  			var cates=json.Categories;
  			var html="<tr>";
  			for(var i=0; i < cates.length; i ++){
  				if (i % 4 == 0 && i != 0) {
  					html += "</tr><tr>";
  				}
  				html += ("<td class=\"cid text-info\" >" + cates[i].id + "</td><td>" + cates[i].title + "</td>");
  			}
  			html += "</tr>";
  			$(targetId).html(html);
  		}
  		
  	})
  }