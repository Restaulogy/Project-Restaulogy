{literal}
<script type="text/javascript">
	function addtocart(){
		//DisplayFormValues();
	}
	
function validAddToCart(){
	$('#add2cart_err').html('');
	if($('#txt_grtotal').html() > 0){  
		 var arr = [];
		$( ".mandotory_items" ).each(function( index ) { 
			var optid = $(this).attr('title');
			arr[optid] = 	(arr[optid] ? arr[optid]:0) + $(this).val();
			$('#dish_opt' + optid + '_err').html('');
		});
		var isErr = true; 
		for(x in arr){
			if(arr[x] > 0){
				 //..do nothing 
			}else{
				//$('#dish_opt' + x + '_err').html('Please Select At least one item');
				//isErr = false;
			}
		}
		return isErr;
	}else{
		$('#add2cart_err').html('Please Select An Item');
		return false;
	}  
}

function validatetbl_feedback(){
	$("#id_err").html("");
	$("#post_id_err").html("");
	$("#post_title_err").html("");
	$("#post_type_err").html("");
	$("#user_id_err").html("");
	$("#recomm_title_err").html("");
	$("#recomm_desc_err").html("");
	$("#recomm_rating_err").html("");
	$("#recomm_QOS_rating_err").html("");
	$("#recomm_QOF_rating_err").html("");
	$("#recomm_ambience_rating_err").html("");
	
	$('#user_name_err').html('');
	$('#user_phone_err').html('');
	/*$("#start_date_err").html("");
	$("#end_date_err").html("");*/
	var isErr = true;
	if(elemById("action").value=="update"){
		if(IsNonEmpty(elemById("id").value)==false){
			$("#id_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.id}{literal}");
			isErr = false;
		}
	}
    /*
    if(IsNonEmpty(elemById("cust_user_name").value)==false){
		$("#user_name_err").html("Please Enter Your Name");
		isErr = false;
	}
	*/
	if(IsNonEmpty(elemById("cust_user_name").value) == false){
      	//$('#recomm_email_err').html("Email should not be empty.");
    	//isErr = false;
    }else{
      	if(isEmail(elemById("cust_user_name").value) == false){
    	  	$('#user_name_err').html("Email is not proper.");
    		isErr = false;
      	}
    }

    if(IsNonEmpty(elemById("cust_user_phone").value) == false ){
    	//$('#recomm_phone_err').html("Phone should not be empty.");
    	//isErr = false;
    }else{
      	if(isPhoneNumber(elemById("cust_user_phone").value) == false){
    	  	$('#user_phone_err').html("Phone is not proper.");
    		isErr = false;
      	}
    }
	
	if(IsNonEmpty(elemById("post_id").value)==false){
		$("#post_id_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.post_id}{literal}");
		isErr = false;
	}
	if(IsNonEmpty(elemById("post_title").value)==false){
		$("#post_title_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.post_title}{literal}");
		isErr = false;
	}
	if(IsNonEmpty(elemById("post_type").value)==false){
		$("#post_type_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.post_type}{literal}");
		isErr = false;
	}
/*
	if(IsNonEmpty(elemById("user_id").value)==false){
		$("#user_id_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.user_id}{literal}");
		isErr = false;
	}
*/
	if(IsNonEmpty(elemById("recomm_title").value)==false){
		$("#recomm_title_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_title}{literal}");
		isErr = false;
	}
	if(IsNonEmpty($("#recomm_desc").val())==false){
		$("#recomm_desc_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_desc}{literal}");
		isErr = false;
	}
	if(is_gt_zero_num(elemById("recomm_rating").value)==false){
		$("#recomm_rating_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_rating}{literal}");
		isErr = false;
	}
	/*
	if(is_gt_zero_num(elemById("recomm_QOS_rating").value)==false){
		$("#recomm_QOS_rating_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_QOS_rating}{literal}");
		isErr = false;
	}
	if(is_gt_zero_num(elemById("recomm_QOF_rating").value)==false){
		$("#recomm_QOF_rating_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_QOF_rating}{literal}");
		isErr = false;
	}
	if(is_gt_zero_num(elemById("recomm_ambience_rating").value)==false){
		$("#recomm_ambience_rating_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.recomm_ambience_rating}{literal}");
		isErr = false;
	}
	*/
	/*if(IsNonEmpty(elemById("start_date").value)==false){
		$("#start_date_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.start_date}{literal}");
		isErr = false;
	}
	if(IsNonEmpty(elemById("end_date").value)==false){
		$("#end_date_err").html("{/literal}{$_lang.tbl_feedback.not_empty_msg.end_date}{literal}");
		isErr = false;
	}*/
	if(isErr == false){
		alert("{/literal}{$_lang.messages.revise_form}{literal}");
	}
	return isErr;
}//..function
	
function calculate(){
 var opt_val_id ="", optid = "", grTotal = 0;
 var elem = document.getElementById('view_dish_pricing').elements;
 $('.opt_total').val('0');
 {/literal}{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}{literal}
    
 	grTotal = ( $('#submenu_dish_qty').val() * elemById('submenu_dish_price').value);
	 
 {/literal}{/if}{literal}
 var optprice = 0;  
 for(var i = 0; i < elem.length; i++){
 	
 if(elem[i].type == "select-one"){
 	 
	 	optid = elem[i].id;
 	 	optid = optid.replace("qty_",""); 
		
	  	if(optid > 0){ 
	    	if(elemById("option_value_" + optid)){
		  		if(elemById("option_value_" + optid).type == "checkbox"){
					if( elemById("option_value_" + optid).checked ) { 
						grTotal = grTotal + calPrice(optid);
					}
		  		}else if(elemById("option_value_" + optid).type == "radio"){
			 	 var radios = document.getElementsByName(elemById("option_value_" + optid).name);
				var radio_id = ""; 
			    for( j = 0; j < radios.length; j++ ) {
					radio_id =   radios[j].id;   
					opt_val_id = radio_id.replace("option_value_","");  
			        if((optid == opt_val_id)&&(radios[j].checked)) { 
					 			grTotal = grTotal + calPrice(opt_val_id);
			        }  
			    } 
				
		  		} 
	   		}
	  	}//..if  
	}//..if select one
 }//..for 
  grTotal = grTotal.toFixed(2);
  $("#txt_grtotal").html(grTotal);
  $("#txt_grtotal").trigger("refresh");
  
}

function calPrice(optId){
     var total = 0;
   	if(optId >0 ){
		total = $('#qty_' + optId).val() * $('#price_' + optId).val();  
		
		$('#mandotory_item' + optId).val(total);
	} 
	
	return total;
 }
	
	function enableQuantity(id_to_search){ 
	  
		var opt_val_id = id_to_search;
	 	opt_val_id = opt_val_id.replace("option_value_",""); 
		if(opt_val_id > 0){
			if(elemById(id_to_search).type == "checkbox"){  
				
				if(elemById(id_to_search).checked){ 
					$('#qty_' + opt_val_id).selectmenu('enable');	
					//elemById('qty_' + opt_val_id).disabled=false; 
				}else{
					$('#qty_' + opt_val_id).selectmenu('disable');	
					//elemById('qty_' + opt_val_id).disabled=true;
				} 
			}else if(elemById(id_to_search).type == "radio"){
			 
				var radios = document.getElementsByName(elemById(id_to_search).name);
				var radio_id = ""; 
			    for( i = 0; i < radios.length; i++ ) {
					radio_id =   radios[i].id;  
					opt_val_id = radio_id.replace("option_value_","");
					$('#qty_' + opt_val_id).selectmenu('disable');	
					//elemById('qty_' + opt_val_id).disabled=true; 
			        if( radios[i].checked ) {
			           $('#qty_' + opt_val_id).selectmenu('enable');	
					//elemById('qty_' + opt_val_id).disabled=false;  
			        }
			    }
				 
			} 
			calculate();
			$('#qty_' + opt_val_id).selectmenu('refresh');
		}
			
	}
	
	function getAllvalues(){
		var info = {}; 
		 
		
		var nodes = document.getElementById('view_dish_pricing').childNodes;
		for(i=0; i<nodes.length; i+=3) {
		    alert(nodes[i]);
		}
		
	}
	
	function cancelDishOrder(submenu_dishid){
	 {/literal}
	 {if $sequence_num != ""}
	 	  var sequence_num = "{$sequence_num}";
	 {else}
	 	 var sequence_num = "";
	 {/if}
	 {literal}
	 
		if(submenu_dishid > 0 && sequence_num != ""){
			if(confirm("{/literal}{$_lang.cancel_dish_order_confirmation}{literal}")){
				window.location.href = "{/literal}{$website}{literal}/user/add2cart.php?{/literal}{$smarty.const.SES_ORDER_SEQUENCE}{literal}=" + sequence_num + "&cancelDishOrder=" + submenu_dishid; 
			}
		}else{
			alert("{/literal}{$_lang.main.cart.no_sequnce_found}{literal}");
		}	
	}
	
	function DisplayFormValues()
    {
        var str = '';
		var info = {}; 
		info['submenu_dish'] = "{/literal}{$tbl_submenu_dishesinfo.sbmnu_dish_id}{literal}";
        var elem = document.getElementById('view_dish_pricing').elements;
        for(var i = 0; i < elem.length; i++){
		  var id_to_search = elem[i].id; 
		  if(id_to_search.search("option_value_") > -1){
		 
		   	var opt_val_id = id_to_search.replace("option_value_");
			
		   	if(elemById(id_to_search).type == "checkbox"){
				 
			}else if(elemById(id_to_search).type == "radio"){
				 
			} 
		   }  
        } 
		/*for(x in info){
			alert(x + "=" + info[x]);
		}*/
        /*alert(str);*/
    }
	 
	setTimeout('calculate()',500); 

</script>
{/literal}
