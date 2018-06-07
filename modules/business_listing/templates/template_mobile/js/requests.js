function Bodyload(){
	setHeaderFooter();
	setTimeout("getPendingRequest()",500);
}

 

function getRequests(report,offset){
  var info = {};
  info['action'] =  "manageRequest";
  if(report){
     info['report'] = report;
  }else{
  	 info['report'] = "all";
  }
 
  if(offset){
  	info['offset'] = offset;	
  }else{
  	info['offset'] = 0;
  } 
  info['limit'] = 2;
  
  $.ajax({     
    type     : "POST",
    url      : CONFIG.serviceurl ,
    data     : info,
    dataType : "json",
	async	 : false,
    success  : function(data) {
	 			if(data){ 
					fillListing(data);
				}else{
				$('#pendingRequests').html("<div class='error'>"+ lang.services_requests.pending_request.no_record_msg +"</div>");
			}
        	
			
	 	},
	error : function (objResponse){
		alert(objResponse.responseText);
	}
	});	 

}
	
	
	 
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
		strOp  = strOp  + "<td><b>" + request['dining']['number']+ " </b>&nbsp;:&nbsp;" + request['service']['name']+ " <small>" + request['service']['description']+ " <br>By <b>" + request['created_by'] + " </b> Posted <b>" +  request['friendly_created_on'] + " </b></small></td>";
		strOp  = strOp  + "</tr>";
		cnt++;
		}); 
		strOp  = strOp  + "</table>";
		 if(info.pagination){
		  	$('#pagination').html(info.pagination); 
			$('#pagination').trigger('create');
		}
	}else{
	   strOp = strOp + "<div class='error'>"+ lang.services_requests.pending_request.no_record_msg +"</div>";	
	}
	$('#pendingRequests').html(strOp);
	$('#pendingRequests').trigger('create');
		 
} 

 