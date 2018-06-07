{include file="header.tpl"}

<div class="wrapper">
  
  <div id="pendingRequests"></div>
  
  <div id="pagination">
  </div>
  
</div>

{include file="footercontent.tpl"}
{literal}
<script type="text/javascript">
function fillListing(info) { 
  strOp = "";
  
	 if(info.requestcount > 0){ 
		strOp  = strOp  + "<table class=\"listTable\">";
		strOp  = strOp  + "<tr>";
		strOp  = strOp  + "<th>Request</th>";
		strOp  = strOp  + "</tr>";
		cnt = 0;
		$.each(info.requestinfo, function(index, request) { 
		 
		strOp  = strOp  + "<tr>";
		strOp  = strOp  + "<td><b>" + info.dininginfo['number']+ " </b>&nbsp;:&nbsp;" + request['service']['name']+ " <small>" + request['service']['description']+ " <br>By <b>" + request['created_by'] + " </b> Posted <b>" +  request['friendly_created_on'] + " </b></small></td>";
		strOp  = strOp  + "</tr>";
		cnt++;
		}); 
		strOp  = strOp  + "</table>";
		 if(info.pagination){
		  	$('#pagination').html(info.pagination); 
			$('#pagination').trigger('create');
		}
	}else{
	   strOp = strOp + "<div class='error'>NO Records</div>";	
	}
	$('#pendingRequests').html(strOp);
	$('#pendingRequests').trigger('create');
		 
} 

function calldiv(){
 $.ajax({
                type: "POST",
                async: false,
                url:  website + "/ajax/myRequest.php",
				dataType:"json", 
                success: function(result) { 
                    if(result) { 
						 	
						 	//alert('x');
							fillListing(result); 
                            document.getElementById("pagination").innerHTML= result.pagination; 
						 
                        
                    }
                },
                error: function( objRequest ){
						alert("Error Occured"); 
                      //document.getElementById("results").innerHTML= objRequest.responseText;
                }
        		});
}


$(function(){ 
	calldiv();
	setInterval(function(){calldiv()}, 5000);     
 });  
</script> 
{/literal}
<link rel="stylesheet" href="{$website}/modules/eyedatagrid/table.css" />	 
</body></html> 