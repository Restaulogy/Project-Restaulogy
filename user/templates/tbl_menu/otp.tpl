<div data-role="popup" id="popupOTP"  data-dismissible="false" style="width:250px;" data-overlay-theme="i" data-theme="a">
    <div data-role="header" data-theme="a" class="ui-corner-top">
        <h6>OTP Validation</h6>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    </div>
    <div data-role="content" data-theme="a" class="ui-corner-bottom ui-content" style="padding:5px;">

    <div class="field-row" id="blockCustomerPhone">
        <p><label for="order_customer_name">Customer (Phone) </label></p>
        <p>
          <input type="text" name="order_customer_name" id="order_customer_name" value="{$smarty.session.nor_order_customer_name}" {if $smarty.session[$smarty.const.SES_CART].order_info.order_id gt 0  || ($sesslife && $isCustomer)} readonly="readonly"{/if}/>           
        </p>
        <br>
    </div>
    
    <div class="field-row" id="blockConfirmationMsg" style="display: none;">
    	  <p style="color:#faf25a;text-align:justify;"><br/>Confirmation code is sent to your mobile, please use that for proceeding with place order<br/><br/></p> 
    </div>
    <div class="field-row" id="blockConfirmationCode" style="display: none;">
        <p><label for="confirmation_code">Confirmation Code </label></p>
        <p><input type="text" name="confirmation_code" id="confirmation_code" value=""/></p>
        <br>
    </div>
			
			
	<div id="btnSendConfirmation" class="biz_center">
	<input data-role="button" data-icon="user" data-inline="true" data-theme="a" type="button" onclick="sendOrderConfirmationCode()" id="sub_send_confirmation" value="Send Confirmation code" />
	<input type="hidden" id="confirmation_timestamp" value=""/>
	</div>
	
	<div id="btnPlaceOrder" class="biz_center" style="display: none">
	<input data-role="button" data-icon="check" data-inline="true" data-theme="a" type="button" onclick="verifyConfirmationCode();"  value="Verify Code" />
	<input type="hidden" name="otp_dish_rdt_id" id="otp_dish_rdt_id" value=""/>	
	</div>
	
	 	

	</div>
</div>

 

{literal}
 
 <script type="text/javascript">

function sendOrderConfirmationCode(){ 
 var customerName = $('#order_customer_name').val();
 var isValid = true;
 	 if(IsNonEmpty(customerName) == false){
      	alert("Please provide Customer Phone.");
      	isValid =false; 
   }else{
      	if(isPhoneNumber(elemById("order_customer_name").value) == false){
    	  	alert("Phone number is not proper.");
      		isValid =false; 
      	}
   }
 if(isValid){ 
		info = {};
		info['customer_phone'] = $('#order_customer_name').val();  
		info['restaurant']  = {/literal}{$smarty.session[$smarty.const.SES_RESTAURANT]}{literal};  
		info['action']  = 'SEND';
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/ajax/orderConfirmationCode.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) {	 								
                if(data){
                	 $('#popupOnlineOrderMsg').hide();
                	 $('#confirmation_timestamp').val(data.timestamp);
                	 $('#btnSendConfirmation,#blockCustomerPhone,#order_note_row').hide();
					 $('#btnPlaceOrder,#blockConfirmationCode,#blockConfirmationMsg').show();	 
                }
            },
            error: function( objRequest ){
            	alert("Error occured" + objRequest.responseText);
            }
      });  
  }  
} 

function verifyConfirmationCode(){ 
 var confirmCode = $('#confirmation_code').val();
 var isValid = true;
 if(IsNonEmpty(confirmCode) == false){
    	alert("Please provide Confirmation Code.");
    	isValid =false; 
 } 
 if(isValid){
		info = {};
		info['customer_phone'] = $('#order_customer_name').val();  
		info['restaurant']  = {/literal}{$smarty.session[$smarty.const.SES_RESTAURANT]}{literal};  
		info['code']  = confirmCode;  
		info['timestamp']  = $('#confirmation_timestamp').val(); 
		info['action']  = 'ORD_VERIFY';
		$.ajax({     
            type     : "POST",
            url      : "{/literal}{$website}{literal}/ajax/orderConfirmationCode.php",
            data     : info,
            dataType : "json",
			async	 : false,
            success  : function(data) { 
                if(data){ 
                	  //$('#frm_place_order').submit(); 
                	  $('#popupOTP').popup('close');
                	  newOrder($("#otp_dish_rdt_id").val());
                	  $("#otp_dish_rdt_id").val('');                	  
                }else{									    	
                	alert("Please provide Valid Confirmation Code.");  
                }
            },
            error: function( objRequest ){
            	alert("Error occured" + objRequest.responseText);
            }
      });
   }   
} 

 </script>
{/literal}
