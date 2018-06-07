{literal}
<script type="text/javascript">
	function addtocart(){
		//DisplayFormValues();
	}
	
function calculate(){
 var opt_val_id ="", optid = "", grTotal = 0;
 var elem = document.getElementById('view_dish_pricing').elements;
 {/literal}{if $tbl_submenu_dishesinfo.sbmnu_dish_price gt 0}{literal}
    
 	grTotal = ( $('#submenu_dish_qty').val() * elemById('submenu_dish_price').value);
	 
 {/literal}{/if}{literal}
  
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
		    //alert(nodes[i]);
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